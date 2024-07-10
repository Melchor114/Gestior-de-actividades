<div class="bg-[#2E2736] flex justify-center items-center min-h-screen">
    <x-guest-layout class="w-full h-full flex justify-center items-center">

    <form method="POST" action="{{ route('register') }}" class="w-full max-w-lg p-6 bg-white rounded-lg shadow-lg">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('¿Cómo planeas usar RAM-IA?') }}
            </h2>
        </x-slot>

        <div class="mt-4">
            <div class="flex justify-center mb-6">
                <img src="{{ asset('img/logoDos.png') }}" alt="Placeholder Image" class="object-cover w-32 h-32">
            </div>
            {{ __("Welcome to RAM IA!") }}
        </div>

        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Selecciona el uso:</label>
            <div class="flex flex-wrap">
                <div class="mr-4 mb-2">
                    <input type="radio" id="uso_personal" name="uso_ram_ia" value="personal" class="rounded mr-2">
                    <label for="uso_personal">Personal</label>
                </div>
                <div class="mr-4 mb-2">
                    <input type="radio" id="uso_trabajo" name="uso_ram_ia" value="trabajo" class="rounded mr-2">
                    <label for="uso_trabajo">Trabajo</label>
                </div>
                <div class="mr-4 mb-2">
                    <input type="radio" id="uso_educacion" name="uso_ram_ia" value="educacion" class="rounded mr-2">
                    <label for="uso_educacion">Educación</label>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    </x-guest-layout>
</div>
