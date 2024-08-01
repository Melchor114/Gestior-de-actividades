<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActividadesRequest;
use App\Models\Event;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller

{
    /**
     * Apply the auth middleware to all routes in this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $allevents =  Event::where('user_id', Auth::id())->get();
        $events = $allevents->map(function ($event) {
            return [
                'title' => $event->event,
                'start' => $event->start_date,
                'end' => $event->end_date,
            ];
        });

        return view('actividades.index', compact('events'));
    }

    public function create() : View
    {
        return view('actividades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActividadesRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        // Combinar fecha y hora si están presentes
        if ($request->fecha && $request->hora) {
            $validatedData['fecha_hora'] = $request->fecha . ' ' . $request->hora;
        }

        $validatedData['user_id'] = Auth::id();

        // Crear la tarea con los datos combinados
        Event::create($validatedData);

        return redirect()->route('actividades.index')
            ->withSuccess('Nueva Tarea agregada.');
    }

}
