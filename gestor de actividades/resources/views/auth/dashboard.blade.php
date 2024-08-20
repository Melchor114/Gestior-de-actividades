<x-app-layout>

    @php
    $tareas = \App\Models\Tarea::where('user_id', Auth::id())->get();
    // Verificar si hay tareas pendientes para hoy
    $hoy = \Carbon\Carbon::now()->format('Y-m-d');
    $hayTareasPendientes = false;
    foreach ($tareas as $tarea) {
    if ($tarea->fecha == $hoy) {
    $hayTareasPendientes = true;
    break;
    }
    }
    @endphp
    <style>
        /* Estilos actualizados para la notificación */
        .toast-container {
            position: fixed;
            top: 1rem;
            /* Ajusta la distancia desde la parte superior */
            right: 1rem;
            /* Ajusta la distancia desde la derecha */
            z-index: 1000;
            /* Asegura que esté sobre otros elementos */
        }

        .toast {
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            padding: 1rem;
            max-width: 300px;
            /* Ancho máximo para la notificación */
            display: flex;
            align-items: center;
        }

        .toast-icon {
            flex-shrink: 0;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ffcccc;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 1rem;
        }

        .toast-content {
            flex-grow: 1;
            color: #333;
            /* Color de texto negro */
        }

        .toast-close {
            cursor: pointer;
            margin-left: 1rem;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Notificación de tareas pendientes para hoy -->
    @if ($hayTareasPendientes)
    <div class="toast-container">
        <div class="toast cursor-pointer">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <div class="toast-icon">
                    <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 2C6.48 2 2 6.48 2 12c0 5.52 4.48 10 10 10 5.52 0 10-4.48 10-10 0-5.52-4.48-10-10-10zM11 15h2v2h-2v-2zm0-8h2v6h-2V7z" />
                    </svg>
                </div>
                <div class="toast-content ml-2">
                    <div class="font-semibold">Tienes tareas pendientes para hoy</div>
                    <div class="text-sm text-gray-600">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
                </div>
            </a>
            <div class="toast-close" onclick="event.stopPropagation(); closeToast();">
                <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
    </div>
    @endif

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h1 class="text-2xl font-semibold text-gray-800">
                    {{ __("Hola, ") . Auth::user()->name }}
                </h1>
                <p class="text-lg text-gray-600">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
            </div>
        </div>
    </div>

    @php
    $tareasDeHoy = $tareas->filter(function ($tarea) {
    return $tarea->fecha == \Carbon\Carbon::today()->format('Y-m-d');
    });
    @endphp
    <style>
        .btn-morado {
            background-color: purple;
            /* Cambia el color de fondo a morado */
        }

        .contenedor:hover {
            cursor: pointer;
        }
    </style>



    @foreach ($tareasDeHoy as $tarea)
    <div class="py-4" id="tarea-{{$tarea->id_tarea}}" data-tarea="{{ json_encode($tarea) }}"> <!-- Ajustar el padding vertical -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 contenedor">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{$tarea->nombre}}</h3>
                        <p class="text-gray-700">{{$tarea->descripcion}}</p>
                    </div>
                    <div class="flex items-center ml-4">
                        <a href="{{ route('eliminar_tarea',['id'=>$tarea->id_tarea]) }}" id="btn-completada-{{$tarea->id_tarea}}" style="background-color: white; border: 2px solid black; width: 20px; height: 20px; border-radius: 50%;">
                            <svg class="h-4 w-4 text-black stroke-current pointer-events-none">
                            </svg>
                        </a>
                        <span id="completada-{{$tarea->id_tarea}}" class="ml-2 text-gray-700">Completada</span>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const btn {
                                    {
                                        $tarea - > id_tarea
                                    }
                                } = document.getElementById('btn-completada-{{$tarea->id_tarea}}');

                                btn {
                                    {
                                        $tarea - > id_tarea
                                    }
                                }.addEventListener('click', function(event) {
                                    event.preventDefault(); // Evitar que el enlace redirija
                                    event.stopPropagation();

                                    // Cambiar el color a morado y agregar la clase
                                    btn {
                                        {
                                            $tarea - > id_tarea
                                        }
                                    }.style.backgroundColor = 'purple';
                                    btn {
                                        {
                                            $tarea - > id_tarea
                                        }
                                    }.classList.add('btn-morado');

                                    // Eliminar la tarea al hacer clic en "Completada"
                                    window.location.href = "{{ route('eliminar_tarea',['id'=>$tarea->id_tarea]) }}";
                                });
                            });
                        </script>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-600">{{$tarea->fecha}} - {{$tarea->hora}}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach

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
                    <form>
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
                                            <path class="fil1" d="M307 296l-246 0c-5,0 -9,-4 -9,-9 0,-4 4,-8 9,-8l246 0c5,0 9,4 9,8 0,5 -4,9 -9,9z"></path>
                                            <path class="fil1" d="M307 359l-246 0c-5,0 -9,-4 -9,-9 0,-5 4,-9 9,-9l246 0c5,0 9,4 9,9 0,5 -4,9 -9,9z"></path>
                                            <path class="fil1" d="M307 421l-246 0c-5,0 -9,-4 -9,-8 0,-5 4,-9 9,-9l246 0c5,0 9,4 9,9 0,4 -4,8 -9,8z"></path>
                                        </g>
                                        <g id="_526717616">
                                            <path class="fil2" d="M503 259c-5,0 -8,-4 -8,-9l0 -80 -40 0c-5,0 -9,-4 -9,-9 0,-4 4,-8 9,-8l48 0c5,0 9,4 9,8l0 89c0,5 -4,9 -9,9z"></path>
                                            <path class="fil3" d="M390 153l0 -40c0,-24 18,-36 37,-36 18,0 36,12 36,36l0 40 -73 0z"></path>
                                            <path class="fil2" d="M427 435c-3,0 -7,-2 -8,-5l-29 -70c0,0 0,0 0,-1l73 0c0,1 0,1 0,1l-28 70c-1,3 -4,5 -8,5 0,0 0,0 0,0z"></path>
                                            <path class="fil1" d="M427 435c-3,0 -7,-2 -8,-5l-12 -28 39 0 -11 28c-1,3 -4,5 -8,5 0,0 0,0 0,0z"></path>
                                            <path class="fil4" d="M390 359c0,0 0,-1 0,-2l0 -204 73 0 0 204c0,1 0,2 0,2l-73 0z"></path>
                                            <rect class="fil5" x="390" y="139" width="73.89" height="13.8284"></rect>
                                        </g>
                                    </g>
                                </svg>
                                <span id="descripcion" class="text-gray-900 dark:text-white">Descripción Tarea</span>
                            </div>

                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24">
                                    <g fill="currentColor" fill-rule="evenodd">
                                        <path fill-rule="nonzero" d="M6 4h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H6zm1 3h10a.5.5 0 1 1 0 1H7a.5.5 0 0 1 0-1z"></path><text font-family="-apple-system, system-ui, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'" font-size="9" transform="translate(4 2)" font-weight="500">
                                            <tspan x="8" y="15" text-anchor="middle">16</tspan>
                                        </text>
                                    </g>
                                </svg>
                                <span id="dia" class="text-gray-900 dark:text-white">Hoy, Mañana, 15 Junio</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-2" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 59.39 59.39" style="enable-background:new 0 0 59.39 59.39;" xml:space="preserve">
                                    <g>
                                        <g>
                                            <circle style="fill:#ECF0F1;" cx="29" cy="29.695" r="29"></circle>
                                            <path style="fill:#545E73;" d="M29,4.695c13.785,0,25,11.215,25,25s-11.215,25-25,25s-25-11.215-25-25S15.215,4.695,29,4.695 M29,0.695c-16.016,0-29,12.984-29,29s12.984,29,29,29s29-12.984,29-29S45.016,0.695,29,0.695L29,0.695z"></path>
                                            <g>
                                                <path style="fill:#8697CB;" d="M29,6.573c-0.552,0-1,0.447-1,1v1c0,0.553,0.448,1,1,1s1-0.447,1-1v-1 C30,7.021,29.552,6.573,29,6.573z"></path>
                                                <path style="fill:#8697CB;" d="M29,49.573c-0.552,0-1,0.447-1,1v1c0,0.553,0.448,1,1,1s1-0.447,1-1v-1 C30,50.021,29.552,49.573,29,49.573z"></path>
                                                <path style="fill:#8697CB;" d="M51,28.573h-1c-0.552,0-1,0.447-1,1s0.448,1,1,1h1c0.552,0,1-0.447,1-1S51.552,28.573,51,28.573z"></path>
                                                <path style="fill:#8697CB;" d="M8,28.573H7c-0.552,0-1,0.447-1,1s0.448,1,1,1h1c0.552,0,1-0.447,1-1S8.552,28.573,8,28.573z"></path>
                                                <path style="fill:#8697CB;" d="M43.849,13.31l-0.707,0.707c-0.391,0.391-0.391,1.023,0,1.414 c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293l0.707-0.707c0.391-0.391,0.391-1.023,0-1.414 S44.24,12.919,43.849,13.31z"></path>
                                                <path style="fill:#8697CB;" d="M13.444,43.716l-0.707,0.707c-0.391,0.391-0.391,1.023,0,1.414 c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293l0.707-0.707c0.391-0.391,0.391-1.023,0-1.414 S13.834,43.325,13.444,43.716z"></path>
                                                <path style="fill:#8697CB;" d="M44.556,43.716c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414l0.707,0.707 c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293c0.391-0.391,0.391-1.023,0-1.414L44.556,43.716z"></path>
                                                <path style="fill:#8697CB;" d="M14.151,13.31c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414l0.707,0.707 c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293c0.391-0.391,0.391-1.023,0-1.414L14.151,13.31z"></path>
                                            </g>
                                            <path style="fill:#545E73;" d="M26,30.574h-8c-0.552,0-1-0.447-1-1s0.448-1,1-1h8c0.552,0,1,0.447,1,1S26.552,30.574,26,30.574z"></path>
                                            <path style="fill:#545E73;" d="M29,27.574c-0.552,0-1-0.447-1-1v-11c0-0.553,0.448-1,1-1s1,0.447,1,1v11 C30,27.126,29.552,27.574,29,27.574z"></path>
                                            <path style="fill:#545E73;" d="M29,33.574c-2.206,0-4-1.794-4-4s1.794-4,4-4s4,1.794,4,4S31.206,33.574,29,33.574z M29,27.574 c-1.103,0-2,0.897-2,2s0.897,2,2,2s2-0.897,2-2S30.103,27.574,29,27.574z"></path>
                                        </g>
                                        <g>
                                            <circle style="fill:#26B999;" cx="47.39" cy="46.695" r="12"></circle>
                                            <path style="fill:#FFFFFF;" d="M53.961,40.874c-0.455-0.316-1.077-0.204-1.392,0.25l-5.596,8.04l-3.949-3.242 c-0.426-0.351-1.057-0.288-1.407,0.139c-0.351,0.427-0.289,1.057,0.139,1.407l4.786,3.929c0.18,0.147,0.404,0.227,0.634,0.227 c0.045,0,0.091-0.003,0.137-0.009c0.276-0.039,0.524-0.19,0.684-0.419l6.214-8.929C54.526,41.813,54.414,41.189,53.961,40.874z"></path>
                                        </g>
                                    </g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                </svg>
                                <span id="hora" class="text-gray-900 dark:text-white">hora</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 16 16" class="g1pQExb" data-icon-name="priority-icon" data-priority="4">
                                    <path fill="currentColor" fill-rule="evenodd" d="M2 3a.5.5 0 0 1 .276-.447C3.025 2.179 4.096 2 5.5 2c.901 0 1.485.135 2.658.526C9.235 2.885 9.735 3 10.5 3c1.263 0 2.192-.155 2.776-.447A.5.5 0 0 1 14 3v6.5a.5.5 0 0 1-.276.447c-.749.375-1.82.553-3.224.553-.901 0-1.485-.135-2.658-.526C6.765 9.615 6.265 9.5 5.5 9.5c-1.08 0-1.915.113-2.5.329V13.5a.5.5 0 0 1-1 0V3Zm1 5.779v-5.45C3.585 3.113 4.42 3 5.5 3c.765 0 1.265.115 2.342.474C9.015 3.865 9.599 4 10.5 4c1.002 0 1.834-.09 2.5-.279v5.45c-.585.216-1.42.329-2.5.329-.765 0-1.265-.115-2.342-.474C6.985 8.635 6.401 8.5 5.5 8.5c-1.001 0-1.834.09-2.5.279Z" clip-rule="evenodd"></path>
                                </svg>
                                <span id="prioridad" class="text-gray-900 dark:text-white">Prioridad</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Botón para abrir el modal de crear -->
    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="fixed end-6 bottom-6 flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
        <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
        </svg>
        <span class="sr-only">Open actions menu</span>
    </button>

    <!-- Contenedor del modal crear-->
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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                                    <label for="fecha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha final</label>
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
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Agregar Tarea
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-center">
        <h2>Resumen del Último Año</h2>

        <!-- Gráfico de Distribución del Tiempo -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <canvas id="timeDistributionChart"></canvas>
            </div>
        </div>
        <!-- Sugerencias -->
        <div class="row justify-content-center" style="margin-top: 2em;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @foreach ($suggestions as $suggestion)
                        <div class="alert alert-info">
                            {{ $suggestion }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Cita Motivacional -->
        <div class="row justify-content-center" style="margin-top: 2em;">
            <div class="col-md-8">
                <blockquote class="blockquote">
                    <p class="mb-0">{{ $motivationalQuote }}</p>
                    <footer class="blockquote-footer">¡Sigue adelante y nunca te detengas!</footer>
                </blockquote>
            </div>
        </div>

    </div>

</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('timeDistributionChart').getContext('2d');
        var data = @json($distribution); // Pasa los datos desde Laravel

        var labels = Object.keys(data);
        var hours = labels.map(label => data[label]['hours']);
        var percentages = labels.map(label => data[label]['percentage']);

        var timeDistributionChart = new Chart(ctx, {
            type: 'bar', // Cambia el tipo si prefieres otro (por ejemplo, 'bar' o 'doughnut')
            data: {
                labels: labels,
                datasets: [{
                    label: 'Distribución del Tiempo',
                    data: hours, // O usa percentages si prefieres
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 71, 0.2)',
                        'rgba(60, 179, 113, 0.2)',
                        'rgba(123, 104, 238, 0.2)',
                        'rgba(255, 215, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 71, 1)',
                        'rgba(60, 179, 113, 1)',
                        'rgba(123, 104, 238, 1)',
                        'rgba(255, 215, 0, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.label}: ${tooltipItem.raw} horas`;
                            }
                        }
                    }
                }
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const openModalBtn = document.querySelector('[data-modal-toggle="crud-modal"]');
        const closeModalBtn = document.getElementById('close-modal');
        const modal = document.getElementById('crud-modal');

        openModalBtn.addEventListener('click', function() {
            modal.classList.remove('hidden');
            modal.classList.add('flex'); // Asegura que el modal se muestre centrado
        });

        closeModalBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });

        // Event listener to close the modal when clicking outside of it
        window.addEventListener('click', function(e) {
            if (e.target == modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tareas = document.querySelectorAll('.py-4');

        tareas.forEach(tarea => {
            tarea.addEventListener('click', function() {
                const tareaData = JSON.parse(tarea.getAttribute('data-tarea'));

                // Lógica para abrir el modal y mostrar la información de la tarea
                const modal = document.getElementById('crud-modales');
                const nombreTarea = document.getElementById('tarea');
                const descripcionTarea = document.getElementById('descripcion');

                const diaTarea = document.getElementById('dia');
                const horaTarea = document.getElementById('hora');
                const prioridadTarea = document.getElementById('prioridad');

                nombreTarea.textContent = tareaData.nombre;
                descripcionTarea.textContent = tareaData.descripcion;
                diaTarea.textContent = tareaData.fecha;
                horaTarea.textContent = tareaData.hora;
                prioridadTarea.textContent = "Prioridad " + tareaData.prioridad;


                modal.classList.remove('hidden');
            });
        });

        // Cerrar el modal al hacer clic en el botón de cerrar
        const closeModalBtn = document.getElementById('close-modal');
        closeModalBtn.addEventListener('click', function() {
            const modal = document.getElementById('crud-modales');
            modal.classList.add('hidden');
        });
    });
</script>
<script>
    function closeToast() {
        var toastContainer = document.querySelector('.toast-container');
        toastContainer.style.display = 'none';
    }
</script>