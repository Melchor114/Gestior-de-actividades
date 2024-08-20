<x-app-layout>
    <div class="container mx-auto py-4 px-6 lg:px-8">
        <div id="calendar" class="calendar"></div>
    </div>

    <!-- Modal de contenido -->
    <div id="crud-modales" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Contenido del modal -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Header del modal -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 id="tarea" class="text-lg font-semibold text-gray-900 dark:text-white">
                        Nombre de Tarea
                    </h3>
                    <button type="button" id="close-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-6 h-6 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Body del modal -->
                <div class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" class="w-6 h-6 mr-2" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 512 512" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs>
                                    <style type="text/css">
                                        .fil1 {
                                            fill: #333333
                                        }

                                        .fil5 {
                                            fill: #EDEDED
                                        }

                                        .fil2 {
                                            fill: #FF3131
                                        }

                                        .fil3 {
                                            fill: #FF871B
                                        }

                                        .fil4 {
                                            fill: #FFA721
                                        }

                                        .fil0 {
                                            fill: #FFE4AF
                                        }
                                    </style>
                                </defs>
                                <g id="Layer_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                    <path class="fil0" d="M360 486l-351 0c-5,0 -9,-4 -9,-8l0 -444c0,-4 4,-8 9,-8l351 0c5,0 8,4 8,8l0 444c0,4 -3,8 -8,8z"></path>
                                    <g id="_526718528">
                                        <path class="fil1" d="M307 108l-246 0c-5,0 -9,-4 -9,-9 0,-4 4,-8 9,-8l246 0c5,0 9,4 9,8 0,5 -4,9 -9,9z"></path>
                                        <path class="fil1" d="M307 171l-246 0c-5,0 -9,-4 -9,-9 0,-5 4,-9 9,-9l246 0c5,0 9,4 9,9 0,5 -4,9 -9,9z"></path>
                                        <path class="fil1" d="M307 233l-246 0c-5,0 -9,-4 -9,-8 0,-5 4,-9 9,-9l246 0c5,0 9,4 9,9 0,4 -4,8 -9,8z"></path>
                                    </g>
                                </g>
                            </svg>
                            <span id="eventDescription" class="text-gray-900 dark:text-white"></span>
                        </div>
                        <div class="flex items-center">
                            <span id="dia" class="text-gray-900 dark:text-white"></span>
                        </div>
                        <div class="flex items-center">
                            <span id="hora" class="text-gray-900 dark:text-white"></span>
                        </div>
                        <div class="flex items-center">
                            <span id="prioridad" class="text-gray-900 dark:text-white"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        #calendar {
            color: rgb(0, 0, 0);
        }

        .fc .fc-daygrid-event {
            color: rgb(0, 0, 0);
        }

        .fc .fc-daygrid-day-number {
            color: rgb(0, 0, 0);
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var events = @json($events);

            var formattedEvents = events.map(function(event) {
                return {
                    title: event.summary,
                    start: event.start,
                    end: event.end,
                    description: event.descripcion || 'No hay descripción disponible',
                    fecha: event.fecha || 'Fecha no disponible',
                    hora: event.hora || 'Hora no disponible',
                    prioridad: event.prioridad || 'Prioridad no disponible'
                };
            });

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: formattedEvents,
                dateClick: function(info) {
                    // Mostrar modal para agregar una tarea en la fecha seleccionada
                    document.getElementById('crud-modal').classList.remove('hidden');
                    document.getElementById('crud-modal').classList.add('flex');

                    // Opcionalmente, puedes establecer la fecha predeterminada en el modal
                    document.getElementById('start_date').value = info.dateStr + 'T00:00';
                    document.getElementById('end_date').value = info.dateStr + 'T23:59';
                },
                eventClick: function(info) {
                    // Mostrar detalles del evento en el modal
                    document.getElementById('tarea').innerText = info.event.title;
                    document.getElementById('eventDescription').innerText = info.event.extendedProps.description;
                    document.getElementById('dia').innerText = info.event.extendedProps.fecha;
                    document.getElementById('hora').innerText = info.event.extendedProps.hora;
                    document.getElementById('prioridad').innerText = "Prioridad " + info.event.extendedProps.prioridad;
                    document.getElementById('crud-modales').classList.remove('hidden');
                }
            });

            calendar.render();

            // Cerrar el modal
            document.getElementById('close-modal').addEventListener('click', function() {
                document.getElementById('crud-modales').classList.add('hidden');
                document.getElementById('crud-modal').classList.add('hidden');
                document.getElementById('crud-modal').classList.remove('flex');
            });

            window.addEventListener('click', function(e) {
                if (e.target === document.getElementById('crud-modales')) {
                    document.getElementById('crud-modales').classList.add('hidden');
                }
                if (e.target === document.getElementById('crud-modal')) {
                    document.getElementById('crud-modal').classList.add('hidden');
                    document.getElementById('crud-modal').classList.remove('flex');
                }
            });
        });
    </script>
    @endpush

    <!-- Modal para agregar nuevo evento -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 justify-center items-center bg-black bg-opacity-50">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-center justify-between p-4 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Agregar Nuevo Evento
                    </h3>
                    <button type="button" id="close-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-6 h-6 inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4">
                    <form action="{{ route('events.store') }}" method="post">
                        @csrf
                        <div class="grid gap-4 mb-4">
                            <div>
                                <label for="event" class="block mb-2 text-sm font-medium text-gray-900">Título del Evento</label>
                                <input type="text" id="event" name="event" value="{{ old('event') }}" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" required>
                                @error('event')
                                <span class="text-red-500" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div>
                                <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">Fecha y Hora de Inicio</label>
                                <input type="datetime-local" id="start_date" name="start_date" value="{{ old('start_date') }}" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" required>
                                @error('start_date')
                                <span class="text-red-500" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div>
                                <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">Fecha y Hora de Fin</label>
                                <input type="datetime-local" id="end_date" name="end_date" value="{{ old('end_date') }}" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" required>
                                @error('end_date')
                                <span class="text-red-500" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 rounded-lg text-sm px-5 py-2.5">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Agregar Tarea
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>