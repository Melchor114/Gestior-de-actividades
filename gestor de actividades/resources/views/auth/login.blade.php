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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container img.logo {
            width: 100px;
            margin-bottom: 1rem;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .login-container h1 {
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            color: #333333;
        }

        .login-container .form-group {
            margin-bottom: 1.5rem;
        }

        .login-container label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #555555;
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 1rem;
            box-sizing: border-box;
            margin-top: 0.25rem;
        }

        .login-container button {
            width: 100%;
            padding: 0.75rem;
            background-color: #6d1641;
            /* Color del botón actualizado */
            border: none;
            border-radius: 4px;
            color: #ffffff;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 1rem;
        }

        .login-container button:hover {
            background-color: #4a0e2a;
            /* Color de fondo en hover para contraste */
        }

        .login-container .register-link {
            margin-top: 1rem;
            font-size: 0.875rem;
        }

        .login-container .register-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-container .register-link a:hover {
            text-decoration: underline;
        }

        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }

        .container {
            text-align: center;
        }

        .google-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 190px;
            padding: 8px 10px;
            background-color: #f5f5f5;
            color: black;
            border: none;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .google-btn:hover {
            background-color: white;
        }

        .google-btn .google-icon {
            width: 20px;
            height: 20px;
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Logo -->
        <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name', 'Laravel') }} Logo" class="logo">

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">{{ __('Correo') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">{{ __('Contraseña') }}</label>
                <input id="password" type="password" name="password" required>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="container">
                <a href="{{ url('auth/redirect') }}" class="google-btn">
                    <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo" class="google-icon">
                    Iniciar sesión con Google
                </a>
            </div>

            <button type="submit">{{ __('Iniciar sesión') }}</button>

            @if (Route::has('register'))
            <div class="register-link">
                <span>{{ __('¿No tienes una cuenta?') }} <a href="{{ route('register') }}">{{ __('Registrarme') }}</a></span>
            </div>
            @endif
        </form>
    </div>
</body>

</html>