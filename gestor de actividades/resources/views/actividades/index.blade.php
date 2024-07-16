<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Welcome to RAM IA!") }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 bg-or">
                    {{ __("HOY!") }}
                    <p class="text-sm text-gray-600">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
                </div>
            </div>
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
        <a href="{{ route('actividades.create') }}" class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
            <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
            </svg>
            <span class="sr-only">Open actions menu</span>
        </a>
    </div>
</x-app-layout>
