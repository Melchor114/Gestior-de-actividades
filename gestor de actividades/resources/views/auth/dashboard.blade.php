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
    <!-- Notificación de tareas pendientes para hoy -->
    @if ($hayTareasPendientes)
    <div class="toast-container">
        <div class="toast">
            <div class="toast-icon">
                <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 2C6.48 2 2 6.48 2 12c0 5.52 4.48 10 10 10 5.52 0 10-4.48 10-10 0-5.52-4.48-10-10-10zM11 15h2v2h-2v-2zm0-8h2v6h-2V7z" />
                </svg>
            </div>
            <div class="toast-content">
                <div class="font-semibold">Tienes tareas pendientes para hoy</div>
                <div class="text-sm text-gray-600">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
            </div>
            <div class="toast-close" onclick="closeToast()">
                <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
    </div>
    @endif
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
                                <svg class="w-8 h-8 mr-2" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M48.3309 49.55C48.2401 50.5284 48.0076 51.4884 47.6409 52.4L45.5009 57.74C45.3533 58.1106 45.0983 58.4285 44.7687 58.653C44.439 58.8776 44.0497 58.9984 43.6509 59H20.3509C19.952 58.9984 19.5628 58.8776 19.2331 58.653C18.9034 58.4285 18.6485 58.1106 18.5009 57.74L17.4309 55.07L16.6009 53L16.3609 52.4C15.9975 51.5018 15.7683 50.555 15.6809 49.59C15.5607 48.2148 15.7241 46.8295 16.1609 45.52L20.0909 33.74C20.2379 33.2948 20.4612 32.8786 20.7509 32.51C21.1254 32.0391 21.6014 31.6588 22.1433 31.3973C22.6853 31.1359 23.2792 31.0001 23.8809 31H40.1209C40.7237 30.9997 41.3187 31.1363 41.8609 31.3996C42.4031 31.6629 42.8784 32.0461 43.2509 32.52C43.542 32.884 43.7655 33.2972 43.9109 33.74L47.8409 45.52C48.2711 46.8173 48.4377 48.1874 48.3309 49.55V49.55Z" fill="#E0D7D7"></path>
                                    <path d="M41 37H23V49H41V37Z" fill="#33A4DB"></path>
                                    <path d="M31 45.9998C30.7348 45.9998 30.4805 45.8944 30.293 45.7068L28.586 43.9998H23V41.9998H29C29.2652 41.9999 29.5195 42.1053 29.707 42.2928L30.726 43.3118L32.1 40.5528C32.1709 40.4114 32.2744 40.2888 32.4019 40.1951C32.5294 40.1014 32.6774 40.0393 32.8336 40.0139C32.9897 39.9885 33.1497 40.0006 33.3003 40.0491C33.451 40.0976 33.5879 40.1811 33.7 40.2928L35.414 41.9998H41V43.9998H35C34.7348 43.9998 34.4805 43.8944 34.293 43.7068L33.274 42.6878L31.9 45.4468C31.8291 45.5887 31.7254 45.7116 31.5976 45.8055C31.4698 45.8994 31.3216 45.9615 31.165 45.9868C31.1105 45.9959 31.0553 46.0002 31 45.9998V45.9998Z" fill="#ED6A30"></path>
                                    <path d="M20.7499 32.5097C20.4603 32.8783 20.2369 33.2945 20.0899 33.7397L16.1599 45.5197C15.7231 46.8292 15.5597 48.2144 15.6799 49.5897C15.3308 49.5549 14.9879 49.4742 14.6599 49.3497C14.595 49.3308 14.5316 49.3074 14.4699 49.2797C14.1528 49.144 13.8538 48.9693 13.5799 48.7597C11.2599 46.9797 10.7399 42.7397 12.4799 38.6397C13.8999 35.3197 16.4299 33.0097 18.8799 32.4997C19.0482 32.4633 19.2185 32.4366 19.3899 32.4197C19.7896 32.3794 20.1927 32.3895 20.5899 32.4497L20.7499 32.5097Z" fill="#CCCCCC"></path>
                                    <path d="M19.7499 32.5099C19.4603 32.8786 19.2369 33.2948 19.0899 33.7399L15.1599 45.5199C14.7513 46.7532 14.5816 48.0531 14.6599 49.3499C14.595 49.331 14.5316 49.3076 14.4699 49.2799C14.1528 49.1442 13.8538 48.9696 13.5799 48.7599C11.2599 46.9799 10.7399 42.7399 12.4799 38.6399C13.8999 35.3199 16.4299 33.0099 18.8799 32.4999C19.0482 32.4635 19.2185 32.4368 19.3899 32.4199L19.5899 32.4499L19.7499 32.5099Z" fill="#E0D7D7"></path>
                                    <path d="M49.609 49.2695C49.529 49.2995 49.459 49.3295 49.379 49.3595C49.0558 49.475 48.7202 49.5522 48.379 49.5895L48.369 49.5495C48.4739 48.1855 48.3004 46.8144 47.859 45.5195L43.869 33.7595C43.7237 33.3167 43.5001 32.9035 43.209 32.5395L43.409 32.4695C43.812 32.3995 44.2231 32.3894 44.629 32.4395H44.639C47.229 32.7195 49.999 35.0895 51.539 38.6195C53.509 43.1895 52.639 47.9595 49.609 49.2695Z" fill="#CCCCCC"></path>
                                    <path d="M49.609 49.2704C49.529 49.3004 49.459 49.3304 49.379 49.3604C49.4555 48.0589 49.2789 46.7548 48.859 45.5204L44.869 33.7604C44.7237 33.3176 44.5001 32.9044 44.209 32.5404L44.409 32.4704L44.629 32.4404H44.639C47.229 32.7204 49.999 35.0904 51.539 38.6204C53.509 43.1904 52.639 47.9604 49.609 49.2704Z" fill="#E0D7D7"></path>
                                    <path d="M49 14V19C49 21.1217 48.1571 23.1566 46.6569 24.6569C45.1566 26.1571 43.1217 27 41 27H23C20.8783 27 18.8434 26.1571 17.3431 24.6569C15.8429 23.1566 15 21.1217 15 19V11C15 8.87827 15.8429 6.84344 17.3431 5.34315C18.8434 3.84285 20.8783 3 23 3H41C43.1217 3 45.1566 3.84285 46.6569 5.34315C48.1571 6.84344 49 8.87827 49 11V14Z" fill="#E0D7D7"></path>
                                    <path d="M37 3H27C22.5817 3 19 6.58172 19 11V15C19 19.4183 22.5817 23 27 23H37C41.4183 23 45 19.4183 45 15V11C45 6.58172 41.4183 3 37 3Z" fill="#33A4DB"></path>
                                    <path d="M37 27H27V31H37V27Z" fill="#CCCCCC"></path>
                                    <path d="M28 14C29.1046 14 30 13.1046 30 12C30 10.8954 29.1046 10 28 10C26.8954 10 26 10.8954 26 12C26 13.1046 26.8954 14 28 14Z" fill="#F28D4E"></path>
                                    <path d="M36 14C37.1046 14 38 13.1046 38 12C38 10.8954 37.1046 10 36 10C34.8954 10 34 10.8954 34 12C34 13.1046 34.8954 14 36 14Z" fill="#F28D4E"></path>
                                    <path d="M37 27H27V28H37V27Z" fill="#BFBFBF"></path>
                                    <path d="M24 52H28C28.5304 52 29.0391 52.2107 29.4142 52.5858C29.7893 52.9609 30 53.4696 30 54V59H22V54C22 53.4696 22.2107 52.9609 22.5858 52.5858C22.9609 52.2107 23.4696 52 24 52V52Z" fill="#C6C4C4"></path>
                                    <path d="M36 52H40C40.5304 52 41.0391 52.2107 41.4142 52.5858C41.7893 52.9609 42 53.4696 42 54V59H34V54C34 53.4696 34.2107 52.9609 34.5858 52.5858C34.9609 52.2107 35.4696 52 36 52Z" fill="#C6C4C4"></path>
                                    <path d="M28 53H24C23.4477 53 23 53.4477 23 54V60C23 60.5523 23.4477 61 24 61H28C28.5523 61 29 60.5523 29 60V54C29 53.4477 28.5523 53 28 53Z" fill="#8E8E8E"></path>
                                    <path d="M27 53H25V56H27V53Z" fill="#666666"></path>
                                    <path d="M27 58H25V61H27V58Z" fill="#666666"></path>
                                    <path d="M40 53H36C35.4477 53 35 53.4477 35 54V60C35 60.5523 35.4477 61 36 61H40C40.5523 61 41 60.5523 41 60V54C41 53.4477 40.5523 53 40 53Z" fill="#8E8E8E"></path>
                                    <path d="M39 53H37V56H39V53Z" fill="#666666"></path>
                                    <path d="M39 58H37V61H39V58Z" fill="#666666"></path>
                                    <path d="M25 12C25 12.5933 25.1759 13.1734 25.5056 13.6667C25.8352 14.1601 26.3038 14.5446 26.8519 14.7716C27.4001 14.9987 28.0033 15.0581 28.5853 14.9424C29.1672 14.8266 29.7018 14.5409 30.1213 14.1213C30.5409 13.7018 30.8266 13.1672 30.9424 12.5853C31.0581 12.0033 30.9987 11.4001 30.7716 10.8519C30.5446 10.3038 30.1601 9.83524 29.6667 9.50559C29.1734 9.17595 28.5933 9 28 9C27.2044 9 26.4413 9.31607 25.8787 9.87868C25.3161 10.4413 25 11.2044 25 12V12ZM28 11C28.1978 11 28.3911 11.0586 28.5556 11.1685C28.72 11.2784 28.8482 11.4346 28.9239 11.6173C28.9996 11.8 29.0194 12.0011 28.9808 12.1951C28.9422 12.3891 28.847 12.5673 28.7071 12.7071C28.5673 12.847 28.3891 12.9422 28.1951 12.9808C28.0011 13.0194 27.8 12.9996 27.6173 12.9239C27.4346 12.8482 27.2784 12.72 27.1685 12.5556C27.0586 12.3911 27 12.1978 27 12C27 11.7348 27.1054 11.4804 27.2929 11.2929C27.4804 11.1054 27.7348 11 28 11Z" fill="black"></path>
                                    <path d="M36 15C36.5933 15 37.1734 14.8241 37.6667 14.4944C38.1601 14.1648 38.5446 13.6962 38.7716 13.1481C38.9987 12.5999 39.0581 11.9967 38.9424 11.4147C38.8266 10.8328 38.5409 10.2982 38.1213 9.87868C37.7018 9.45912 37.1672 9.1734 36.5853 9.05765C36.0033 8.94189 35.4001 9.0013 34.852 9.22836C34.3038 9.45543 33.8352 9.83994 33.5056 10.3333C33.1759 10.8266 33 11.4067 33 12C33 12.7957 33.3161 13.5587 33.8787 14.1213C34.4413 14.6839 35.2044 15 36 15ZM36 11C36.1978 11 36.3911 11.0587 36.5556 11.1685C36.72 11.2784 36.8482 11.4346 36.9239 11.6173C36.9996 11.8 37.0194 12.0011 36.9808 12.1951C36.9422 12.3891 36.847 12.5673 36.7071 12.7071C36.5673 12.847 36.3891 12.9422 36.1951 12.9808C36.0011 13.0194 35.8 12.9996 35.6173 12.9239C35.4346 12.8482 35.2784 12.72 35.1685 12.5556C35.0586 12.3911 35 12.1978 35 12C35 11.7348 35.1054 11.4804 35.2929 11.2929C35.4804 11.1054 35.7348 11 36 11Z" fill="black"></path>
                                    <path d="M14.0725 50.2C14.3073 50.3 14.5493 50.3822 14.7965 50.446C14.9215 51.2437 15.1345 52.0251 15.4315 52.776L15.6715 53.376L17.5275 52.632L17.2885 52.032C16.4992 50.0555 16.4347 47.8635 17.1065 45.844L21.0365 34.054C21.2351 33.4562 21.6169 32.936 22.1277 32.5674C22.6386 32.1987 23.2525 32.0002 23.8825 32H40.1165C40.7461 32 41.3597 32.1981 41.8705 32.5662C42.3813 32.9343 42.7633 33.4537 42.9625 34.051L46.8925 45.841C47.5642 47.8605 47.4997 50.0525 46.7105 52.029L44.5735 57.371C44.5 57.557 44.3722 57.7166 44.2066 57.8288C44.041 57.941 43.8455 58.0007 43.6455 58H41.9995V54C41.9995 53.4696 41.7887 52.9609 41.4137 52.5858C41.0386 52.2107 40.5299 52 39.9995 52H35.9995C35.469 52 34.9603 52.2107 34.5852 52.5858C34.2102 52.9609 33.9995 53.4696 33.9995 54V58H29.9995V54C29.9995 53.4696 29.7887 52.9609 29.4137 52.5858C29.0386 52.2107 28.5299 52 27.9995 52H23.9995C23.469 52 22.9603 52.2107 22.5852 52.5858C22.2102 52.9609 21.9995 53.4696 21.9995 54V58H20.3535C20.1538 58 19.9586 57.9401 19.7932 57.8282C19.6278 57.7163 19.4998 57.5574 19.4255 57.372L18.3565 54.7L16.4995 55.442L17.5675 58.115C17.7888 58.6727 18.173 59.1507 18.6699 59.487C19.1668 59.8232 19.7535 60.0019 20.3535 60H21.9995C21.9995 60.5304 22.2102 61.0391 22.5852 61.4142C22.9603 61.7893 23.469 62 23.9995 62H27.9995C28.5299 62 29.0386 61.7893 29.4137 61.4142C29.7887 61.0391 29.9995 60.5304 29.9995 60H33.9995C33.9995 60.5304 34.2102 61.0391 34.5852 61.4142C34.9603 61.7893 35.469 62 35.9995 62H39.9995C40.5299 62 41.0386 61.7893 41.4137 61.4142C41.7887 61.0391 41.9995 60.5304 41.9995 60H43.6455C44.2456 60.0019 44.8323 59.8229 45.3292 59.4865C45.8262 59.1501 46.2103 58.6718 46.4315 58.114L48.5675 52.772C48.8628 52.0236 49.0748 51.2449 49.1995 50.45C49.4581 50.3857 49.7112 50.3011 49.9565 50.197C50.8923 49.7482 51.6999 49.0706 52.3043 48.2268C52.9088 47.3831 53.2906 46.4005 53.4145 45.37C53.797 42.9555 53.4683 40.4818 52.4685 38.251C50.6125 33.905 46.9285 31.101 43.6145 31.428C42.6805 30.5123 41.4245 29.9995 40.1165 30H37.9995V28H40.9995C43.3855 27.9971 45.673 27.0479 47.3602 25.3607C49.0474 23.6735 49.9966 21.3861 49.9995 19V14H47.9995V19C47.9973 20.8559 47.2592 22.6351 45.9469 23.9474C44.6346 25.2597 42.8553 25.9979 40.9995 26H22.9995C21.1436 25.9979 19.3643 25.2597 18.0521 23.9474C16.7398 22.6351 16.0016 20.8559 15.9995 19V11C16.0019 9.4891 16.4923 8.01941 17.3978 6.80991C18.3033 5.6004 19.5754 4.71584 21.0245 4.288C20.0742 5.1292 19.3132 6.16242 18.7918 7.31943C18.2704 8.47644 18.0003 9.73091 17.9995 11V15C18.0024 17.3861 18.9515 19.6735 20.6387 21.3607C22.3259 23.0479 24.6134 23.9971 26.9995 24H36.9995C39.3855 23.9971 41.673 23.0479 43.3602 21.3607C45.0474 19.6735 45.9966 17.3861 45.9995 15V11C45.9986 9.73091 45.7286 8.47644 45.2071 7.31943C44.6857 6.16242 43.9247 5.1292 42.9745 4.288C44.4235 4.71584 45.6956 5.6004 46.6011 6.80991C47.5066 8.01941 47.9971 9.4891 47.9995 11V12H49.9995V11C49.9966 8.61395 49.0474 6.32645 47.3602 4.63925C45.673 2.95206 43.3855 2.00291 40.9995 2H22.9995C20.6134 2.00291 18.3259 2.95206 16.6387 4.63925C14.9515 6.32645 14.0024 8.61395 13.9995 11V19C14.0024 21.3861 14.9515 23.6735 16.6387 25.3607C18.3259 27.0479 20.6134 27.9971 22.9995 28H25.9995V30H23.8825C22.5758 29.9991 21.321 30.5107 20.3875 31.425C17.0695 31.116 13.4125 33.919 11.5615 38.251C9.35946 43.408 10.4625 48.655 14.0725 50.2ZM26.9995 60V58H24.9995V60H23.9995V54H24.9995V56H26.9995V54H27.9995V60H26.9995ZM38.9995 60V58H36.9995V60H35.9995V54H36.9995V56H38.9995V54H39.9995V60H38.9995ZM50.6295 39.037C51.4755 40.903 51.7604 42.9749 51.4495 45C51.3758 45.6713 51.1467 46.3162 50.7803 46.8835C50.4138 47.4508 49.9201 47.9249 49.3385 48.268C49.3016 47.2262 49.1171 46.1949 48.7905 45.205L44.8765 33.467C47.0385 33.875 49.3495 36.039 50.6295 39.037ZM36.9995 4C38.8553 4.00212 40.6346 4.7403 41.9469 6.05259C43.2592 7.36489 43.9973 9.14413 43.9995 11V15C43.9973 16.8559 43.2592 18.6351 41.9469 19.9474C40.6346 21.2597 38.8553 21.9979 36.9995 22H26.9995C25.1436 21.9979 23.3643 21.2597 22.0521 19.9474C20.7398 18.6351 20.0016 16.8559 19.9995 15V11C20.0016 9.14413 20.7398 7.36489 22.0521 6.05259C23.3643 4.7403 25.1436 4.00212 26.9995 4H36.9995ZM27.9995 28H35.9995V30H27.9995V28ZM13.3995 39.037C14.6735 36.054 16.9665 33.898 19.1195 33.473L15.2085 45.209C14.8837 46.1928 14.6995 47.2176 14.6615 48.253C12.3365 47.049 11.7455 42.915 13.3995 39.037Z" fill="black"></path>
                                    <path d="M41 50C41.2652 50 41.5196 49.8946 41.7071 49.7071C41.8946 49.5196 42 49.2652 42 49V37C42 36.7348 41.8946 36.4804 41.7071 36.2929C41.5196 36.1054 41.2652 36 41 36H23C22.7348 36 22.4804 36.1054 22.2929 36.2929C22.1054 36.4804 22 36.7348 22 37V49C22 49.2652 22.1054 49.5196 22.2929 49.7071C22.4804 49.8946 22.7348 50 23 50H41ZM24 38H40V42H35.414L33.707 40.293C33.5949 40.1813 33.458 40.0977 33.3073 40.0493C33.1567 40.0008 32.9967 39.9887 32.8406 40.0141C32.6844 40.0395 32.5364 40.1016 32.4089 40.1953C32.2814 40.2889 32.1779 40.4115 32.107 40.553L30.728 43.312L29.709 42.293C29.6159 42.1999 29.5054 42.1261 29.3837 42.0758C29.262 42.0255 29.1316 41.9998 29 42H24V38ZM24 44H28.586L30.293 45.707C30.4805 45.8946 30.7348 45.9999 31 46C31.0536 46.0001 31.1071 45.9958 31.16 45.987C31.3166 45.9617 31.4648 45.8996 31.5926 45.8057C31.7204 45.7118 31.8241 45.5888 31.895 45.447L33.274 42.688L34.293 43.707C34.4805 43.8946 34.7348 43.9999 35 44H40V48H24V44Z" fill="black"></path>
                                </svg>
                                <span id="recomendacion" class="text-gray-900 dark:text-white">Obtener una recomendación personalizada de RAM-IA(IA)</span>
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
                                <span id="prioridad" class="text-gray-900 dark:text-white">Prioridad 1</span>
                            </div>
                        </div>
                        <div class="flex space-x-4"> <!-- Ajuste de espacio entre botones -->
                            <button type="button" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-4">Recordatorios</button>
                            <button type="button" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 mr-4">Etiquetas</button>
                        </div>
                        <textarea class="mt-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 placeholder-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Añade un comentario"></textarea>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Botón para abrir el modal -->
    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="fixed end-6 bottom-6 flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
        <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
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
                                    <label for="fecha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Inicio</label>
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

</x-app-layout>
<script>
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