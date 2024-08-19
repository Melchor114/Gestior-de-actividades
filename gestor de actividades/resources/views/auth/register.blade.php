<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Inline Styles for simplicity -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            /* Background color */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            /* Adjust max width as needed */
            text-align: center;
        }

        .form-container img {
            width: 100px;
            /* Adjust as needed */
            margin-bottom: 1rem;
            display: block;
            /* Ensure the image is treated as a block element */
            margin-left: auto;
            margin-right: auto;
        }

        .form-container h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #333333;
        }

        .form-container .form-group {
            margin-bottom: 1.5rem;
        }

        .form-container label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #555555;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 1rem;
            box-sizing: border-box;
            margin-top: 0.25rem;
        }

        .form-container button {
            width: 100%;
            padding: 0.75rem;
            background-color: #6d1641;
            /* Button color */
            border: none;
            border-radius: 4px;
            color: #ffffff;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 1rem;
        }

        .form-container button:hover {
            background-color: #4a0e2a;
            /* Button hover color */
        }

        .form-container .register-link {
            margin-top: 1rem;
            font-size: 0.875rem;
        }

        .form-container .register-link a {
            color: #007bff;
            text-decoration: none;
        }

        .form-container .register-link a:hover {
            text-decoration: underline;
        }

        .form-container .radio-group {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .form-container .radio-group div {
            margin-right: 1rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .form-container .radio-group input {
            margin-right: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <!-- Logo -->
        <img src="{{ asset('img/logoDos.png') }}" alt="{{ config('app.name', 'Laravel') }} Logo">

        <!-- Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">{{ __('Nombre') }}</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">{{ __('Correo') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">{{ __('Contraseña') }}</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">{{ __('Confirma tu contraseña') }}</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <button type="submit">{{ __('Registrarme') }}</button>

            <!-- Login Link -->
            <div class="register-link">
                <a href="{{ route('login') }}">{{ __('¿Ya tienes una cuenta?') }}</a>
            </div>
        </form>
    </div>
</body>

</html>