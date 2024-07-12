<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Tarea') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <div class="float-start">
                            Agregar Nueva Tarea
                        </div>
                        <div class="float-end">
                            <a href="{{ route('tareas.index') }}" class="btn btn-light btn-sm">&larr; Atrás</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tareas.store') }}" method="post">
                            @csrf

                            <div class="mb-3 row">
                                <label for="nombre" class="col-md-3 col-form-label text-md-end text-dark">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}">
                                    @error('nombre')
                                        <span class="invalid-feedback text-dark" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="descripcion" class="col-md-3 col-form-label text-md-end text-dark">Descripción</label>
                                <div class="col-md-9">
                                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="4">{{ old('descripcion') }}</textarea>
                                    @error('descripcion')
                                        <span class="invalid-feedback text-dark" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="fecha" class="col-md-3 col-form-label text-md-end text-dark">Fecha</label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" value="{{ old('fecha') }}">
                                    @error('fecha')
                                        <span class="invalid-feedback text-dark" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="hora" class="col-md-3 col-form-label text-md-end text-dark">Hora</label>
                                <div class="col-md-9">
                                    <input type="time" class="form-control @error('hora') is-invalid @enderror" id="hora" name="hora" value="{{ old('hora') }}">
                                    @error('hora')
                                        <span class="invalid-feedback text-dark" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="prioridad" class="col-md-3 col-form-label text-md-end text-dark">Prioridad</label>
                                <div class="col-md-9">
                                    <select class="form-control @error('prioridad') is-invalid @enderror" id="prioridad" name="prioridad">
                                        <option value="3" {{ old('prioridad') == 'baja' ? 'selected' : '' }}>Baja</option>
                                        <option value="2" {{ old('prioridad') == 'media' ? 'selected' : '' }}>Media</option>
                                        <option value="1" {{ old('prioridad') == 'alta' ? 'selected' : '' }}>Alta</option>
                                    </select>
                                    @error('prioridad')
                                        <span class="invalid-feedback text-dark" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-9 offset-md-3">
                                    <button type="submit" class="btn btn-primary">Agregar Tarea</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
