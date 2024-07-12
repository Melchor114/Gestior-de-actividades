<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de TAREAS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    @session('success')
                        <div class="alert alert-success" role="alert">
                            {{ $value }}
                        </div>
                    @endsession


                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <div class="bg-gray-100 px-4 py-2 font-semibold text-gray-700">
                            Lista de Tareas
                        </div>

                        <div class="p-4">
                            <a href="{{ route('tareas.create') }}"
                                class="inline-flex items-center px-3 py-2 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 transition duration-150 my-2">
                                <i class="bi bi-plus-circle mr-1"></i> Add New Tarea
                            </a>
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                S#</th>
                                            <th scope="col"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                nombre</th>
                                            <th scope="col"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Descripcion</th>
                                            <th scope="col"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Fecha</th>
                                            <th scope="col"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Hora</th>
                                                <th scope="col"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Prioridad</th>
                                            <th scope="col"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse ($tareas as $product)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->nombre }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->descripcion }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->fecha }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->hora }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($product->prioridad, 0) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <form action="{{ route('tareas.destroy', $product->id_tarea) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('tareas.show', $product->id_tarea) }}"
                                                            class="inline-flex items-center px-2 py-1 bg-yellow-500 text-white text-xs font-medium rounded hover:bg-yellow-600 transition duration-150">
                                                            <i class="bi bi-eye mr-1"></i> Show
                                                        </a>
                                                        <a href="{{ route('tareas.edit', $product->id_tarea) }}"
                                                            class="inline-flex items-center px-2 py-1 bg-blue-500 text-white text-xs font-medium rounded hover:bg-blue-600 transition duration-150">
                                                            <i class="bi bi-pencil-square mr-1"></i> Edit
                                                        </a>
                                                        <button type="submit"
                                                            class="inline-flex items-center px-2 py-1 bg-red-500 text-white text-xs font-medium rounded hover:bg-red-600 transition duration-150"
                                                            onclick="return confirm('Do you want to delete this Tarea?');">
                                                            <i class="bi bi-trash mr-1"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center">
                                                    <span class="text-red-500 font-semibold">
                                                        No Tarea Found!
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- <div class="mt-4">
                                {{ $products->links() }}
                            </div> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>











<div class="py-4"> <!-- Ajustar el padding vertical -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Avances del Proyecto de Sheyla</h3>
                    <p class="text-gray-700">Algunos avances en el proyecto de Sheyla como el modal y las tareas</p>
                </div>
                <div class="flex items-center ml-4">
                    <input type="checkbox" id="completed" class="form-checkbox h-5 w-5 text-blue-600">
                    <label for="completed" class="ml-2 text-gray-700">Completada</label>
                </div>
            </div>
            <div>
                <p class="text-sm text-gray-600">11-07-2024</p>
            </div>
            <!-- Aquí incluyes tu tabla -->
            <div class="overflow-x-auto mt-4">
                <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                S#
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                nombre
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Descripcion
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Hora
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Prioridad
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($tareas as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->nombre }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->descripcion }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->fecha }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->hora }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($product->prioridad, 0) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('tareas.destroy', $product->id_tarea) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('tareas.show', $product->id_tarea) }}" class="inline-flex items-center px-2 py-1 bg-yellow-500 text-white text-xs font-medium rounded hover:bg-yellow-600 transition duration-150">
                                            <i class="bi bi-eye mr-1"></i> Show
                                        </a>
                                        <a href="{{ route('tareas.edit', $product->id_tarea) }}" class="inline-flex items-center px-2 py-1 bg-blue-500 text-white text-xs font-medium rounded hover:bg-blue-600 transition duration-150">
                                            <i class="bi bi-pencil-square mr-1"></i> Edit
                                        </a>
                                        <button type="submit" class="inline-flex items-center px-2 py-1 bg-red-500 text-white text-xs font-medium rounded hover:bg-red-600 transition duration-150" onclick="return confirm('Do you want to delete this Tarea?');">
                                            <i class="bi bi-trash mr-1"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="text-red-500 font-semibold">
                                        No Tarea Found!
                                    </span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Fin de la tabla -->
        </div>
    </div>
</div>
