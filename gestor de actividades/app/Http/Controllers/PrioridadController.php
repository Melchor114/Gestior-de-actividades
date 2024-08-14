<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateTareaRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Tarea;

class PrioridadController extends Controller
{
    public function index() : View
    {
        $tareas_baja = Tarea::where('user_id', Auth::id())->where('prioridad', '3.0')->get();
        $tareas_media = Tarea::where('user_id', Auth::id())->where('prioridad', '2.0')->get();
        $tareas_alta = Tarea::where('user_id', Auth::id())->where('prioridad', '1.0')->get();
        return view('prioridad.index', compact('tareas_baja','tareas_media','tareas_alta'));
    }

}
