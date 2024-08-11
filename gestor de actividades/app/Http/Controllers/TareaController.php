<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Event;
use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateTareaRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Google_Service_Calendar;
use Google_Client;
use Illuminate\Support\Facades\Http;


class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $tareas = Tarea::where('user_id', Auth::id())->get();
        return view('tareas.index', compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('tareas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTareaRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        // Combinar fecha y hora si están presentes
        if ($request->fecha && $request->hora) {
            $validatedData['fecha_hora'] = $request->fecha . ' ' . $request->hora;
        }

        $validatedData['user_id'] = Auth::id();

        // Crear la tarea con los datos combinados
        Tarea::create($validatedData);

        // Crear un evento en el calendario
        $startDate = $validatedData['fecha_hora'];
        $endDate = $request->fecha . ' 23:59:59'; // Fin del día

        $user = auth()->user();
        $refreshToken = $user->google_refresh_token;
        $accessToken = $this->generateAccessTokenFromRefreshToken($refreshToken);

        try {
            $client = new Google_Client();
            $client->setAccessToken($accessToken);
            $service = new Google_Service_Calendar($client);

            $event = new \Google_Service_Calendar_Event([
                'summary' => $request->input('nombre'),
                'start' => [
                    'dateTime' => \Carbon\Carbon::parse($startDate)->toRfc3339String(),
                    'timeZone' => 'America/Monterrey',
                ],
                'end' => [
                    'dateTime' => \Carbon\Carbon::parse($endDate)->toRfc3339String(),
                    'timeZone' => 'America/Monterrey',
                ],
            ]);

            $calendarId = 'primary';
            $service->events->insert($calendarId, $event);

            return redirect()->back()->with('success', 'Nueva Tarea agregada con éxito.');
        } catch (\Google_Service_Exception $e) {
            \Log::error('Google Calendar error: ', ['exception' => $e]);
            return redirect()->back()->withErrors('Google Calendar error: ' . $e->getMessage());
        } catch (\Exception $e) {
            \Log::error('General error: ', ['exception' => $e]);
            return redirect()->back()->withErrors('General error: ' . $e->getMessage());
        }

        return redirect()->back()
            ->withSuccess('Nueva Tarea agregada.');
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

    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea) : View
    {
        if ($tarea->user_id !== Auth::id()) {
            abort(403, 'No autorizado.');
        }
        return view('tareas.show', compact('tarea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea) : View
    {
        if ($tarea->user_id !== Auth::id()) {
            abort(403, 'No autorizado.');
        }
        return view('tareas.edit', compact('tarea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTareaRequest $request, Tarea $tarea) : RedirectResponse
    {
        if ($tarea->user_id !== Auth::id()) {
            abort(403, 'No autorizado.');
        }

        $tarea->update($request->validated());

        return redirect()->back()
                ->withSuccess('Tarea is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea) : JsonResponse
    {
        if ($tarea->user_id !== Auth::id()) {
            abort(403, 'No autorizado.');
        }
        $tarea->delete();
    
        return response()->json(['message' => 'Tarea eliminada correctamente']);
    }

    public function eliminar_tarea($id){
        //eliminamos un registro de la bd
        Tarea::where(['id_tarea'=>$id])->delete();
        return redirect()->back()
        ->withSuccess('Tarea Eliminada.');;     
    }
    
}
