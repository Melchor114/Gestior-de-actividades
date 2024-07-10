<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="bg-[#2E2736] flex justify-center items-center h-screen">
            <!-- Left: Image -->
            <div class="w-1/2 h-screen hidden lg:block">
                <img src="{{ asset('img/fondo.jpeg') }}" alt="Placeholder Image" class="object-cover w-full h-full">
            </div>
            <!-- Right: Login Form -->
            <div class="p-8 w-full lg:w-1/2 flex items-center justify-end">
                <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <div class="flex justify-center items-center">
                        <img src="{{ asset('img/logoDos.png') }}" alt="Placeholder Image" class="object-cover"  style="width: 9.0rem; height: 9.0rem;">
                    </div>
                 <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
        
                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" href="{{ route('register') }}">
                                    {{ __('Registrarse') }}
                                </a>
                            @endif
        
                            <x-primary-button class="ml-3">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>        
    </body>
</html>