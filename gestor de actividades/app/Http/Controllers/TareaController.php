<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateTareaRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('tareas.index', [
            'tareas' => Tarea::latest()->paginate(4)
        ]);
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

        // Crear la tarea con los datos combinados
        Tarea::create($validatedData);

        return redirect()->route('dashboard')
            ->withSuccess('Nueva Tarea agregada.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea) : View
    {
        return view('tareas.show', compact('tarea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea) : View
    {
        return view('tareas.edit', compact('tarea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTareaRequest $request, Tarea $tarea) : RedirectResponse
    {
        $tarea->update($request->validated());

        return redirect()->back()
                ->withSuccess('Tarea is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea) : JsonResponse
    {
        $tarea->delete();
    
        return response()->json(['message' => 'Tarea eliminada correctamente']);
    }

    public function eliminar_tarea($id){
        //eliminamos un registro de la bd
        Tarea::where(['id_tarea'=>$id])->delete();
        return redirect()->route('dashboard')
        ->withSuccess('Tarea Eliminada.');;     
}
    
}
