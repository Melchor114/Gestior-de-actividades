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

    public function getEventsForLastYear()
    {
        $user = auth()->user();
        $refreshToken = $user->google_refresh_token;
        $accessToken = $this->generateAccessTokenFromRefreshToken($refreshToken);

        try {
            // Configura el cliente de Google
            $client = new Google_Client();
            $client->setAccessToken($accessToken);
            $service = new Google_Service_Calendar($client);

            $calendarId = 'primary';

            // Define el rango de fechas (último año)
            $now = new \DateTime();
            $lastYear = (new \DateTime())->modify('-1 year');

            // Parámetros para la consulta
            $optParams = [
                'timeMin' => $lastYear->format(\DateTime::RFC3339),
                'timeMax' => $now->format(\DateTime::RFC3339),
                'orderBy' => 'startTime',
                'singleEvents' => true,
            ];

            // Obtén los eventos
            $events = $service->events->listEvents($calendarId, $optParams);

            $eventData = [];
            foreach ($events->getItems() as $event) {
                $eventData[] = [
                    'summary' => $event->getSummary(),
                    'start' => $event->getStart()->getDateTime(),
                    'end' => $event->getEnd()->getDateTime(),
                    'description' => $event->getDescription(),
                    'location' => $event->getLocation(),
                ];
            }

            return $eventData;
        } catch (\Exception $ex) {
            return response()->json(['error' => 'Unable to fetch events.'], 500);
        }
    }

    public function showCalendarSummary()
    {
        // Verificar si los eventos ya están en la sesión
        if (!session()->has('events_loaded')) {
            // Obtener los eventos si no están en la sesión
            $events = $this->getEventsForLastYear();

            // Guardar los eventos en la sesión
            session(['events' => $events, 'events_loaded' => true]);
        }

        // Obtener los eventos de la sesión
        $events = session('events');

        // Inicializar variables para el cálculo de tiempo
        $totalMinutes = 0;
        $categories = [
            'Clases y estudios' => 0,
            'Eventos y reuniones' => 0,
            'Salidas' => 0,
            'Exámenes' => 0,
            'Laboratorios' => 0,
            'Casa' => 0,
            'Otros' => 0,
        ];
        $otrosTitulos = [];

        // Calcular el tiempo total dedicado a cada categoría
        foreach ($events as $event) {
            $start = new \DateTime($event['start']);
            $end = new \DateTime($event['end']);
            $duration = $start->diff($end)->i + ($start->diff($end)->h * 60);

            $totalMinutes += $duration;

            // Asignar categorías automáticamente
            $summary = strtolower($event['summary']);
            if (
                strpos($summary, 'programacion orientada a objetos') !== false ||
                strpos($summary, 'base de datos') !== false ||
                strpos($summary, 'sistemas operativos') !== false ||
                strpos($summary, 'matematica para ingenieros ii') !== false ||
                strpos($summary, 'álgebra lineal') !== false ||
                strpos($summary, 'fundamentos de la computación cuántica') !== false ||
                strpos($summary, 'analogía clásica - cuántica') !== false ||
                strpos($summary, 'algoritmos cuánticos') !== false ||
                strpos($summary, 'uso de hardware cuántico') !== false ||
                strpos($summary, 'qiskit runtime') !== false ||
                strpos($summary, 'estimación de fase cuántica') !== false ||
                strpos($summary, 'transformada de fourier cuántica') !== false ||
                strpos($summary, 'algoritmo de grover') !== false ||
                strpos($summary, 'algoritmo de shor') !== false ||
                strpos($summary, 'información cuántica') !== false ||
                strpos($summary, 'programación web') !== false ||
                strpos($summary, 'formulación de proyectos de tecnologías de la información') !== false ||
                strpos($summary, 'ingeniería de requisitos') !== false ||
                strpos($summary, 'lenguajes y autómatas') !== false ||
                strpos($summary, 'liderazgo de equipos de alto desempeño') !== false
            ) {
                $categories['Clases y estudios'] += $duration;
            } elseif (
                strpos($summary, 'reunión') !== false ||
                strpos($summary, 'congreso') !== false ||
                strpos($summary, 'presentaciones') !== false ||
                strpos($summary, 'ceremonia') !== false ||
                strpos($summary, 'conferencia') !== false ||
                strpos($summary, 'sesión preguntas/respuestas') !== false ||
                strpos($summary, 'entrevista') !== false ||
                strpos($summary, 'hackathon') !== false ||
                strpos($summary, 'registro') !== false ||
                strpos($summary, 'inauguración') !== false ||
                strpos($summary, 'clausura') !== false ||
                strpos($summary, 'bienvenida') !== false ||
                strpos($summary, 'entrega de presentes') !== false ||
                strpos($summary, 'publicación') !== false ||
                strpos($summary, 'encuentro') !== false ||
                strpos($summary, 'ponencia') !== false ||
                strpos($summary, 'talent insight session') !== false ||
                strpos($summary, 'fisch bowl') !== false ||
                strpos($summary, 'mensaje certiprof') !== false ||
                strpos($summary, 'casos reales de okr') !== false ||
                strpos($summary, 'reunion pej') !== false ||
                strpos($summary, 'reu fmj') !== false ||
                strpos($summary, 'reu cic-ipn') !== false ||
                strpos($summary, 'rv: como forjar una vision innovadora en el ambito cientifico y tecnologico') !== false ||
                strpos($summary, 'apertura cdcp 2024') !== false ||
                strpos($summary, 'cdecp') !== false ||
                strpos($summary, 'planeación académica') !== false ||
                strpos($summary, 'sesión surf') !== false
            ) {
                $categories['Eventos y reuniones'] += $duration;
            } elseif (
                strpos($summary, 'vuelo') !== false ||
                strpos($summary, 'flight') !== false ||
                strpos($summary, 'bus') !== false
            ) {
                $categories['Salidas'] += $duration;
            } elseif (strpos($summary, 'examen') !== false) {
                $categories['Exámenes'] += $duration;
            } elseif (strpos($summary, 'laboratorio') !== false) {
                $categories['Laboratorios'] += $duration;
            } elseif (strpos($summary, 'okr') !== false) {
                $categories['Casa'] += $duration;
            } else {
                $categories['Otros'] += $duration;
                $otrosTitulos[] = $event['summary'];
            }
        }

        // Calcular porcentajes
        $distribution = [];
        foreach ($categories as $category => $minutes) {
            $hours = $minutes / 60;
            $percentage = ($minutes / $totalMinutes) * 100;
            $distribution[$category] = [
                'hours' => round($hours, 1),
                'percentage' => round($percentage, 1)
            ];
        }
        // Porcentajes ideales ajustados
        $idealPercentages = [
            'Clases y estudios' => 45.0,
            'Eventos y reuniones' => 25.0,
            'Salidas' => 7.5,
            'Exámenes' => 7.5,
            'Laboratorios' => 7.5,
            'Casa' => 2.5,
            'Otros' => 5.0,
        ];
        // Generar sugerencias
        $suggestions = [];
        foreach ($categories as $category => $minutes) {
            if (isset($distribution[$category])) {
                $actualPercentage = $distribution[$category]['percentage'];
                $idealPercentage = $idealPercentages[$category] ?? 0;

                if ($actualPercentage < $idealPercentage) {
                    $suggestions[] = "Considera dedicar más tiempo a $category. Actualmente estás dedicando $actualPercentage%, que es menor que el ideal de $idealPercentage%.";
                } elseif ($actualPercentage > $idealPercentage) {
                    $suggestions[] = "Considera reducir el tiempo dedicado a $category. Actualmente estás dedicando $actualPercentage%, que es mayor que el ideal de $idealPercentage%.";
                }
            } else {
                $suggestions[] = "La categoría $category no tiene datos suficientes para comparar.";
            }
        }

        // Asegurar que siempre haya una sugerencia o comentario positivo
        if (empty($suggestions)) {
            $suggestions[] = "¡Estás gestionando tu tiempo de manera excelente! Sigue así.";
        } elseif (count($suggestions) > 5) {
            $suggestions[] = "Tienes varias áreas que podrían mejorar. Considera revisar tus prioridades para lograr un equilibrio óptimo.";
        }

        // Lista de citas motivacionales
        $quotes = [
            "El éxito es la suma de pequeños esfuerzos repetidos día tras día.",
            "No es lo que haces de vez en cuando, es lo que haces consistentemente.",
            "La única forma de hacer un gran trabajo es amar lo que haces.",
            "Haz de cada día tu obra maestra.",
            "No cuentes los días, haz que los días cuenten."
        ];

        // Seleccionar una cita aleatoria
        $motivationalQuote = $quotes[array_rand($quotes)];

        // Mostrar la vista del dashboard con la cita motivacional
        return view('Auth.dashboard', [
            'events' => $events,
            'distribution' => $distribution,
            'otrosTitulos' => $otrosTitulos,
            'suggestions' => $suggestions,
            'motivationalQuote' => $motivationalQuote
        ]);
    }
}
