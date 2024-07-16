<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Welcome to RAM IA!") }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id='calendar'></div>
        </div>

        @push('styles')
        <style>
            /* Change the color of the calendar text */
            #calendar {
                color: rgb(0, 0, 0); /* Change this to your desired color */
            }
            /* Additional customization */
            .fc .fc-daygrid-event {
                color: rgb(0, 0, 0); /* Change event text color */
            }
            .fc .fc-daygrid-day-number {
                color: rgb(0, 0, 0); /* Change day number color */
            }
        </style>
        @endpush

        @push('scripts')
        <!-- Include tippy.js for tooltips -->
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const calendarEl = document.getElementById('calendar');
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    slotMinTime: '00:00:00',
                    slotMaxTime: '24:00:00',
                    events: @json($events),
                    eventDidMount: function(info) {
                        // Use tippy.js to create tooltips
                        tippy(info.el, {
                            content: info.event.title, // Use the event's title as tooltip content
                        });
                    }
                });
                calendar.render();
            });
        </script>
        @endpush
    </div>
    <div data-dial-init class="fixed end-6 bottom-6 group" data-reference="#">
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="fixed end-6 bottom-6 flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
            <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
            </svg>
            <span class="sr-only">Open actions menu</span>
        </button>
    </div>
    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 justify-center items-center">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Contenido del modal -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Header del modal -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Agregar Nuevo Evento
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
                    <form action="{{ route('actividades.store') }}" method="post">
                        @csrf
                        <div class="grid gap-4 mb-4">
                            <div>
                                <label for="event" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título del Evento</label>
                                <input type="text"  id="event" name="event" value="{{ old('event') }}" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                @error('event')
                                    <span class="invalid-feedback text-dark" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha y Hora de Inicio</label>
                                <input type="datetime-local" id="start_date" name="start_date" value="{{ old('start_date') }}" rows="4" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                @error('start_date')
                                    <span class="invalid-feedback text-dark" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha y Hora de Fin</label>
                                <input type="datetime-local" id="end_date" name="end_date" value="{{ old('end_date') }}" rows="4" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                @error('end_date')
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
