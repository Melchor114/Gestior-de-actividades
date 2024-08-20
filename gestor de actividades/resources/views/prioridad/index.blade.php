<x-app-layout>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex gap-6">
                <div class="priority-box bg-blue-50 border border-blue-200 p-6 rounded-lg shadow-md flex-1">
                    <h3 class="text-lg font-semibold text-blue-900 mb-4">Prioridad Baja</h3>
                    @foreach ($tareas_baja as $tarea)
                    <div class="flex items-center space-x-4 mb-4">
                        <a href="{{ route('eliminar_tarea',['id'=>$tarea->id_tarea]) }}" id="btn-completada-{{$tarea->id_tarea}}" class="bg-blue-600 border-2 border-blue-700 w-10 h-10 rounded-full flex items-center justify-center transition-colors hover:bg-blue-700">
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                        <p class="text-gray-800">{{ $tarea->nombre }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="priority-box bg-yellow-50 border border-yellow-200 p-6 rounded-lg shadow-md flex-1">
                    <h3 class="text-lg font-semibold text-yellow-900 mb-4">Prioridad Media</h3>
                    @foreach ($tareas_media as $tarea)
                    <div class="flex items-center space-x-4 mb-4">
                        <a href="{{ route('eliminar_tarea',['id'=>$tarea->id_tarea]) }}" id="btn-completada-{{$tarea->id_tarea}}" class="bg-orange-600 border-2 border-orange-700 w-10 h-10 rounded-full flex items-center justify-center transition-colors hover:bg-ye900">
                        </a>
                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        </a>
                        <p class="text-gray-800">{{ $tarea->nombre }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="priority-box bg-red-50 border border-red-200 p-6 rounded-lg shadow-md flex-1">
                    <h3 class="text-lg font-semibold text-red-900 mb-4">Prioridad Alta</h3>
                    @foreach ($tareas_alta as $tarea)
                    <div class="flex items-center space-x-4 mb-4">
                        <a href="{{ route('eliminar_tarea',['id'=>$tarea->id_tarea]) }}" id="btn-completada-{{$tarea->id_tarea}}" class="bg-red-600 border-2 border-red-700 w-10 h-10 rounded-full flex items-center justify-center transition-colors hover:bg-red-700">
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                        <p class="text-gray-800">{{ $tarea->nombre }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Botón para abrir el modal -->
    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white rounded-full p-4 shadow-lg focus:outline-none transition-colors">
        <svg class="w-8 h-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span class="sr-only">Open actions menu</span>
    </button>

    <!-- Modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="relative w-full max-w-lg bg-white rounded-lg shadow-lg">
            <!-- Header del modal -->
            <div class="flex items-center justify-between p-6 border-b rounded-t-lg">
                <h3 class="text-lg font-semibold text-gray-900">Agregar Nueva Tarea</h3>
                <button type="button" id="close-modal" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Body del modal -->
            <div class="p-6">
                <form action="{{ route('tareas.store') }}" method="post">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-900">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="block w-full mt-1 p-3 border border-gray-300 rounded-lg" value="{{ old('nombre') }}" placeholder="Ingrese el nombre" required>
                            @error('nombre')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="descripcion" class="block text-sm font-medium text-gray-900">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="4" class="block w-full mt-1 p-3 border border-gray-300 rounded-lg" placeholder="Ingrese la descripción" required>{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex gap-6">
                            <div class="w-1/2">
                                <label for="fecha" class="block text-sm font-medium text-gray-900">Fecha</label>
                                <input type="date" name="fecha" id="fecha" class="block w-full mt-1 p-3 border border-gray-300 rounded-lg" value="{{ old('fecha') }}" required>
                                @error('fecha')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-1/2">
                                <label for="hora" class="block text-sm font-medium text-gray-900">Hora</label>
                                <input type="time" name="hora" id="hora" class="block w-full mt-1 p-3 border border-gray-300 rounded-lg" value="{{ old('hora') }}" required>
                                @error('hora')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="prioridad" class="block text-sm font-medium text-gray-900">Prioridad</label>
                            <select name="prioridad" id="prioridad" class="block w-full mt-1 p-3 border border-gray-300 rounded-lg" required>
                                <option value="3" {{ old('prioridad') == 'baja' ? 'selected' : '' }}>Baja</option>
                                <option value="2" {{ old('prioridad') == 'media' ? 'selected' : '' }}>Media</option>
                                <option value="1" {{ old('prioridad') == 'alta' ? 'selected' : '' }}>Alta</option>
                            </select>
                            @error('prioridad')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg px-6 py-3">Agregar Tarea</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const openModalBtn = document.querySelector('[data-modal-toggle="crud-modal"]');
        const closeModalBtn = document.getElementById('close-modal');
        const modal = document.getElementById('crud-modal');

        openModalBtn.addEventListener('click', function() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        closeModalBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });

        window.addEventListener('click', function(e) {
            if (e.target == modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    });
</script>