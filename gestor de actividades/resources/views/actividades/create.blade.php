<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Evento') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <div class="float-start">
                            Agregar Nuevo Evento
                        </div>
                        <div class="float-end">
                            <a href="{{ route('actividades.index') }}" class="btn btn-light btn-sm">&larr; Atrás</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('actividades.store') }}" method="post">
                            @csrf

                            <div class="mb-3 row">
                                <label for="event" class="col-md-3 col-form-label text-md-end text-dark">Título del Evento</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control @error('event') is-invalid @enderror" id="event" name="event" value="{{ old('event') }}">
                                    @error('event')
                                        <span class="invalid-feedback text-dark" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="start_date" class="col-md-3 col-form-label text-md-end text-dark">Fecha y Hora de Inicio</label>
                                <div class="col-md-9">
                                    <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}">
                                    @error('start_date')
                                        <span class="invalid-feedback text-dark" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="end_date" class="col-md-3 col-form-label text-md-end text-dark">Fecha y Hora de Fin</label>
                                <div class="col-md-9">
                                    <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}">
                                    @error('end_date')
                                        <span class="invalid-feedback text-dark" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-9 offset-md-3">
                                    <button type="submit" class="btn btn-primary">Agregar Evento</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
