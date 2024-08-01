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

        Event::create([
            'event' => $validatedData['nombre'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'user_id' => $validatedData['user_id'],
        ]);

        return redirect()->back()
            ->withSuccess('Nueva Tarea agregada.');
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
