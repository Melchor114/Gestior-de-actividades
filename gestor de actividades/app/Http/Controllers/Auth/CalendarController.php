<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Google_Service_Calendar;
use Illuminate\Support\Facades\Auth;
use DateTimeZone;
use DateTime;
use DateInterval;


class CalendarController extends Controller
{
    public function getEventDetails($id)
    {
        $user = auth()->user();
        $refreshToken = $user->google_refresh_token;
        $accessToken = $this->generateAccessTokenFromRefreshToken($refreshToken);

        try {
            $client = new Google_Client();
            $client->setAccessToken($accessToken);

            $service = new Google_Service_Calendar($client);
            $calendarId = 'primary';
            $event = $service->events->get($calendarId, $id);

            return response()->json([
                'summary' => $event->getSummary(),
                'start' => $event->getStart()->getDateTime(),
                'end' => $event->getEnd()->getDateTime(),
                'description' => $event->getDescription(),
                'location' => $event->getLocation(),
            ]);
        } catch (\Exception $ex) {
            return response()->json(['error' => 'Unable to fetch event details.'], 500);
        }
    }

    public function storeEvent(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'event' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:now',
            'end_date' => 'required|date|after:start_date',
        ]);

        /*Imprime los datos del request para depuración
        dd([
            'event' => $request->input('event'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'user' => auth()->user(),
        ]);*/

        $user = auth()->user();
        $refreshToken = $user->google_refresh_token;
        $accessToken = $this->generateAccessTokenFromRefreshToken($refreshToken);

        try {
            $client = new Google_Client();
            $client->setAccessToken($accessToken);
            $service = new Google_Service_Calendar($client);

            $event = new \Google_Service_Calendar_Event([
                'summary' => $request->input('event'),
                'start' => [
                    'dateTime' => \Carbon\Carbon::parse($request->input('start_date'))->toRfc3339String(),
                    'timeZone' => 'America/Monterrey',
                ],
                'end' => [
                    'dateTime' => \Carbon\Carbon::parse($request->input('end_date'))->toRfc3339String(),
                    'timeZone' => 'America/Monterrey',
                ],
            ]);

            $calendarId = 'primary';
            $service->events->insert($calendarId, $event);

            return redirect()->back()->with('success', 'Evento agregado con éxito.');
        } catch (\Google_Service_Exception $e) {
            \Log::error('Google Calendar error: ', ['exception' => $e]);
            return redirect()->back()->withErrors('Google Calendar error: ' . $e->getMessage());
        } catch (\Exception $e) {
            \Log::error('General error: ', ['exception' => $e]);
            return redirect()->back()->withErrors('General error: ' . $e->getMessage());
        }
    }


    public function openCalendar()
    {
        $user = Auth::user();
        $refreshToken = $user->google_refresh_token;

        // Configura el cliente de Google
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->setAccessToken($user->google_access_token);

        // Verifica si el token de acceso ha expirado
        if ($client->isAccessTokenExpired()) {
            if ($refreshToken) {
                $client->fetchAccessTokenWithRefreshToken($refreshToken);
                $newAccessToken = $client->getAccessToken();

                // Actualiza el token de acceso en la base de datos
                $user->google_access_token = $newAccessToken['access_token'];
                $user->save();
            } else {
                return back()->withErrors('No refresh token available.');
            }
        }

        try {
            $service = new Google_Service_Calendar($client);
            $calendarId = 'primary';

            // Define el rango de fechas
            $now = new \DateTime();
            $oneYearAgo = (clone $now)->sub(new \DateInterval('P1Y'));
            $future = (clone $now)->add(new \DateInterval('P1Y')); // Un año en el futuro

            // Convierte las fechas a formato RFC3339
            $timeMin = $oneYearAgo->format(\DateTime::RFC3339);
            $timeMax = $future->format(\DateTime::RFC3339);

            $events = [];
            $pageToken = null;

            // Manejo de paginación para obtener todos los eventos
            do {
                $response = $service->events->listEvents($calendarId, [
                    'maxResults' => 2500, // Ajusta según sea necesario
                    'orderBy' => 'startTime',
                    'singleEvents' => true,
                    'timeMin' => $timeMin,
                    'timeMax' => $timeMax,
                    'pageToken' => $pageToken
                ]);

                $events = array_merge($events, $response->getItems());
                $pageToken = $response->getNextPageToken();
            } while ($pageToken);

            // Convertir los eventos a una colección de Laravel
            $events = collect($events)->map(function ($event) {
                // Obtener las fechas de inicio y fin
                $start = $event->getStart();
                $end = $event->getEnd();

                return [
                    'summary' => $event->getSummary(),
                    'start' => $start ? $start->getDateTime() : 'No start time',
                    'end' => $end ? $end->getDateTime() : 'No end time',
                ];
            });

            return view('auth.calendar.index', compact('events'));
        } catch (\Exception $ex) {
            return back()->withErrors('Unable to complete the request, due to this error: ' . $ex->getMessage());
        }
    }

    private function generateAccessTokenFromRefreshToken($refreshToken)
    {
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
