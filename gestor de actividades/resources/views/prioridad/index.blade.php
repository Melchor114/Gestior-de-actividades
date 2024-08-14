<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Welcome to RAM IA!") }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="priority-container">
                <div class="priority-box">
                    <h3>Prioridad Baja</h3>
                    @foreach ($tareas_baja as $tarea)
                    <div style="display: flex; align-items: center;">
                        <a href="{{ route('eliminar_tarea',['id'=>$tarea->id_tarea]) }}" id="btn-completada-{{$tarea->id_tarea}}" style="background-color: #06011f; border: 2px solid rgb(53, 52, 52); width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 2px;">
                            <svg class="h-4 w-4 text-black stroke-current pointer-events-none">
                            </svg>
                        </a>
                        <p>{{$tarea->nombre}}</p>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const btn{{$tarea->id_tarea}} = document.getElementById('btn-completada-{{$tarea->id_tarea}}');

                            btn{{$tarea->id_tarea}}.addEventListener('click', function (event) {
                                event.preventDefault(); // Evitar que el enlace redirija
                                event.stopPropagation();

                                // Cambiar el color a morado y agregar la clase
                                btn{{$tarea->id_tarea}}.style.backgroundColor = 'purple';
                                btn{{$tarea->id_tarea}}.classList.add('btn-morado');

                                // Eliminar la tarea al hacer clic en "Completada"
                                window.location.href = "{{ route('eliminar_tarea',['id'=>$tarea->id_tarea]) }}";
                            });
                        });
                    </script>
                    @endforeach                
                </div>
                <div class="priority-box">
                    <h3>Prioridad Media</h3>
                    @foreach ($tareas_media as $tarea)
                    <div style="display: flex; align-items: center;">
                        <a href="{{ route('eliminar_tarea',['id'=>$tarea->id_tarea]) }}" id="btn-completada-{{$tarea->id_tarea}}" style="background-color: #06011f; border: 2px solid rgb(53, 52, 52); width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 2px;">
                            <svg class="h-4 w-4 text-black stroke-current pointer-events-none">
                            </svg>
                        </a>
                        <p>{{$tarea->nombre}}</p>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const btn{{$tarea->id_tarea}} = document.getElementById('btn-completada-{{$tarea->id_tarea}}');

                            btn{{$tarea->id_tarea}}.addEventListener('click', function (event) {
                                event.preventDefault(); // Evitar que el enlace redirija
                                event.stopPropagation();

                                // Cambiar el color a morado y agregar la clase
                                btn{{$tarea->id_tarea}}.style.backgroundColor = 'purple';
                                btn{{$tarea->id_tarea}}.classList.add('btn-morado');

                                // Eliminar la tarea al hacer clic en "Completada"
                                window.location.href = "{{ route('eliminar_tarea',['id'=>$tarea->id_tarea]) }}";
                            });
                        });
                    </script>
                    @endforeach   
                </div>
                <div class="priority-box">
                    <h3>Prioridad Alta</h3>
                    @foreach ($tareas_alta as $tarea)
                    <div style="display: flex; align-items: center;">
                        <a href="{{ route('eliminar_tarea',['id'=>$tarea->id_tarea]) }}" id="btn-completada-{{$tarea->id_tarea}}" style="background-color: #06011f; border: 2px solid rgb(53, 52, 52); width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 2px;">
                            <svg class="h-4 w-4 text-black stroke-current pointer-events-none">
                            </svg>
                        </a>
                        <p>{{$tarea->nombre}}</p>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const btn{{$tarea->id_tarea}} = document.getElementById('btn-completada-{{$tarea->id_tarea}}');

                            btn{{$tarea->id_tarea}}.addEventListener('click', function (event) {
                                event.preventDefault(); // Evitar que el enlace redirija
                                event.stopPropagation();

                                // Cambiar el color a morado y agregar la clase
                                btn{{$tarea->id_tarea}}.style.backgroundColor = 'purple';
                                btn{{$tarea->id_tarea}}.classList.add('btn-morado');

                                // Eliminar la tarea al hacer clic en "Completada"
                                window.location.href = "{{ route('eliminar_tarea',['id'=>$tarea->id_tarea]) }}";
                            });
                        });
                    </script>
                    @endforeach   
                </div>
            </div>
        </div>
    </div>
    <style>
        .priority-container {
            display: flex;
            width: 100%;
            justify-content: space-around;
            padding: 20px;
            border-radius: 10px;
            height: 500px;
        }
            .priority-box {
        flex: 1;
        margin: 0 10px;
        background-color: #06011f;
        padding: 15px;
        border-radius: 8px;
        text-align: left; 
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .priority-box h3 {
        margin: 0;
        margin-bottom: 10px;
    }

    .priority-box p {
        margin: 0; 
        color: white;
        padding: 10px;
        border-radius: 5px;
        cursor: default;
    }
        </style>
<!-- Botón para abrir el modal -->
<button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="fixed end-6 bottom-6 flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
    <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
    </svg>
    <span class="sr-only">Open actions menu</span>
</button>

<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 justify-center items-center">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Contenido del modal -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Header del modal -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Agregar Nueva Tarea
                </h3>
                <button type="button" id="close-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-6 h-6 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Body del modal -->
            <div class="p-4 md:p-5">
                <form action="{{ route('tareas.store') }}" method="post">
                    @csrf
                    <div class="grid gap-4 mb-4">
                        <div>
                            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old('nombre') }}" placeholder="Ingrese el nombre" required>
                            @error('nombre')
                                <span class="invalid-feedback text-dark" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="4" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ingrese la descripción" required>{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <span class="invalid-feedback text-dark" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- Contenedor para fecha y hora -->
                        <div class="flex space-x-4">
                            <div class="w-1/2">
                                <label for="fecha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha</label>
                                <input type="date" name="fecha" id="fecha" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old('fecha') }}" required>
                                @error('fecha')
                                    <span class="invalid-feedback text-dark" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="w-1/2">
                                <label for="hora" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora</label>
                                <input type="time" name="hora" id="hora" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old('hora') }}" required>
                                @error('hora')
                                    <span class="invalid-feedback text-dark" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="prioridad" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prioridad</label>
                            <select name="prioridad" id="prioridad" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
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
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Agregar Tarea
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const openModalBtn = document.querySelector('[data-modal-toggle="crud-modal"]');
        const closeModalBtn = document.getElementById('close-modal');
        const modal = document.getElementById('crud-modal');

        openModalBtn.addEventListener('click', function () {
            modal.classList.remove('hidden');
            modal.classList.add('flex'); // Asegura que el modal se muestre centrado
        });

        closeModalBtn.addEventListener('click', function () {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });

        // Event listener to close the modal when clicking outside of it
        window.addEventListener('click', function (e) {
            if (e.target == modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    });
</script>