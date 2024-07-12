
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Welcome to RAM IA!") }}
        </h2>
    </x-slot>

  <div class="py-4"> <!-- Ajustar el padding vertical -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 bg-or">
                {{ __("HOY!") }}
                <p class="text-sm text-gray-600">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
            </div>
        </div>
    </div>
</div>
<div class="py-4"> <!-- Ajustar el padding vertical -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Avances del Proyecto de Sheyla</h3>
                    <p class="text-gray-700">Algunos avances en el proyecto de sheyla como el modal y las tareas</p>
                </div>
                <div class="flex items-center ml-4">
                    <input type="checkbox" id="completed" class="form-checkbox h-5 w-5 text-blue-600">
                    <label for="completed" class="ml-2 text-gray-700">Completada</label>
                </div>
            </div>
            <div>
                <p class="text-sm text-gray-600">11-07-2024</p>
            </div>
        </div>
    </div>
</div>

    <!-- Botón para abrir la nueva pantalla -->
    <div data-dial-init class="fixed end-6 bottom-6 group" data-reference="#">
        <a href="{{ route('tareas.create') }}" class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
            <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
            </svg>
            <span class="sr-only">Open actions menu</span>
        </a>
    </div>
</x-app-layout>
