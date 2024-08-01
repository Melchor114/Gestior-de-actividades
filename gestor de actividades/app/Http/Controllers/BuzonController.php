<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Tarea;
use Illuminate\Support\Facades\Auth;

class BuzonController extends Controller
{
    public function index()
    {
        $tareas = Tarea::where('user_id', Auth::id())->get();
        $hoy = Carbon::now()->startOfDay();
        $mañana = Carbon::now()->addDay()->startOfDay();
    
        $tareasHoy = $tareas->filter(function ($tarea) use ($hoy) {
            return Carbon::parse($tarea->fecha)->isSameDay($hoy);
        });
    
        $tareasMañana = $tareas->filter(function ($tarea) use ($mañana) {
            return Carbon::parse($tarea->fecha)->isSameDay($mañana);
        });
    
        $tareasFuturas = $tareas->filter(function ($tarea) use ($mañana) {
            return Carbon::parse($tarea->fecha)->gt($mañana);
        });
        $tareasPasadas = $tareas->filter(function ($tarea) use ($hoy, $mañana) {
            $fechaTarea = Carbon::parse($tarea->fecha);
            return $fechaTarea->lt($hoy) && !$fechaTarea->isSameDay($hoy) && !$fechaTarea->isSameDay($mañana);
        });
    
        $hayTareasPasadas = $tareasPasadas->isNotEmpty();

        return view('buzon.index', compact('tareasHoy', 'tareasMañana', 'tareasPasadas', 'tareasFuturas', 'hayTareasPasadas', 'hoy', 'mañana'));
    }
}
