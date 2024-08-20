<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RAM IA') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @yield('css')
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:400,500,600%7CTeko:300,400,500%7CMaven+Pro:500">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased" style="background-color: #f5f5f5;">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="section page-header">
            <div class="rd-navbar-wrap">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main class="text-black">

            @yield('content')
            @session('success')
            <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                <span class="font-medium">
                    {{ $value }}
                </span>
            </div>
            @endsession

            {{ $slot }}
        </main>
    </div>
    <!-- Footer -->
    <footer class="footer bg-light">
        <div class="container">
            <div class="row text-center text-md-left">
                <!-- About Us Section -->
                <div class="col-md-4 mb-4">
                    <h5 class="footer-title">About Us</h5>
                    <p class="footer-text">We are dedicated to providing high-quality software solutions and services to meet the needs of businesses and individuals alike. Our team is committed to innovation and excellence.</p>
                </div>
                <!-- Contact Us Section -->
                <div class="col-md-4 mb-4">
                    <h5 class="footer-title">Contact Us</h5>
                    <ul class="footer-contact-list list-unstyled">
                        <li><i class="material-icons">phone</i><a href="tel:+1234567890">+1 (234) 567-890</a></li>
                        <li><i class="material-icons">email</i><a href="mailto:info@example.com">info@example.com</a></li>
                        <li><i class="material-icons">location_on</i><a href="#">123 Main Street, Anytown, USA</a></li>
                    </ul>
                </div>
                <!-- Follow Us Section -->
                <div class="col-md-4 mb-4">
                    <h5 class="footer-title">Follow Us</h5>
                    <ul class="footer-social-list list-inline">
                        <li class="list-inline-item"><a class="footer-social-link" href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a class="footer-social-link" href="#"><i class="fab fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a class="footer-social-link" href="#"><i class="fab fa-x"></i></a></li>
                    </ul>
                </div>

            </div>
            <!-- Footer Bottom -->
            <div class="footer-bottom text-center mt-4">
                <p class="footer-bottom-text">&copy; 2024 Your Company Name. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- Include Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles for the footer -->
    <style>
        .footer {
            padding: 40px 0;
            background-color: #f5f5f5;
        }

        .footer-title {
            font-size: 1.25rem;
            font-weight: 500;
            margin-bottom: 15px;
            color: #333;
        }

        .footer-text {
            font-size: 0.875rem;
            color: #666;
        }

        .footer-contact-list li {
            margin-bottom: 10px;
            font-size: 0.875rem;
            color: #666;
        }

        .footer-contact-list i {
            font-size: 1.25rem;
            margin-right: 8px;
            vertical-align: middle;
            color: #6d1641;
        }

        .footer-social-list {
            padding-left: 0;
        }

        .footer-social-link {
            font-size: 1.5rem;
            color: #6d1641;
            margin: 0 8px;
            transition: color 0.3s;
        }

        .footer-social-link:hover {
            color: #0056b3;
        }

        .footer-bottom {
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }

        .footer-bottom-text {
            font-size: 0.75rem;
            color: #888;
        }
    </style>
    @stack('scripts')
</body>

</html>