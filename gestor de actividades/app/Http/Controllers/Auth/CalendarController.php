<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Google_Service_Calendar;

class CalendarController extends Controller
{
    public function storeEvent(Request $request)
    {
        $user = auth()->user();
        $refreshToken = $user->google_refresh_token;
        $accessToken = $this->generateAccessTokenFromRefreshToken($refreshToken);

        try {
            $client = new Google_Client();
            $client->setAccessToken($accessToken);
            $service = new Google_Service_Calendar($client);

            $event = new \Google_Service_Calendar_Event(array(
                'summary' => $request->input('event'),
                'start' => array(
                    'dateTime' => $request->input('start_date'),
                    'timeZone' => 'America/Monterrey',
                ),
                'end' => array(
                    'dateTime' => $request->input('end_date'),
                    'timeZone' => 'America/Monterrey',
                ),
            ));

            $calendarId = 'primary';
            $service->events->insert($calendarId, $event);

            return redirect()->back()->with('success', 'Evento agregado con éxito.');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors('No se pudo completar la solicitud debido al siguiente error: ' . $ex->getMessage());
        }
    }

    public function openCalendar(){
        $user = auth()->user();
        $refreshToken = $user->google_refresh_token;
        $accessToken = $this->generateAccessTokenFromRefreshToken($refreshToken);

        try {
            $client = new Google_Client();
            $client->setAccessToken($accessToken);

            $service = new Google_Service_Calendar($client);
            $calendarId = 'primary';
            $events = $service->events->listEvents($calendarId);

            // Convertir los eventos a una colección de Laravel
            $events = collect($events->getItems())->map(function ($event) {
                return [
                    'summary' => $event->getSummary(),
                    'start' => $event->getStart()->getDateTime(),
                    'end' => $event->getEnd()->getDateTime(),
                ];
            });

            return view('auth.calendar.index', compact('events'));
        } catch (\Exception $ex) {
            return back()->withErrors('Unable to complete the request, due to this error: ' . $ex->getMessage());
        }
    }

    private function generateAccessTokenFromRefreshToken($refreshToken){
        $newAccessToken = null;
        $googleClientId = config('services.google.client_id');
        $googleClientSecret = config('services.google.client_secret');

        $response = Http::asForm()
            ->timeout(30) // Tiempo de espera para la respuesta
            ->connectTimeout(30) // Tiempo de espera para la conexión
            ->post('https://oauth2.googleapis.com/token', [
                'grant_type' => 'refresh_token',
                'client_id' => $googleClientId,
                'client_secret' => $googleClientSecret,
                'refresh_token' => $refreshToken,
            ]);

        if ($response->successful()) {
            $data = $response->json();
            $newAccessToken = $data['access_token'];
            $newRefreshToken = $data['refresh_token'] ?? $refreshToken;
        } else {
            $error = $response->json();
        }
        return $newAccessToken;
    }
}
