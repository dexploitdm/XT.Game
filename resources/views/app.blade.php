<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Продажа игр для xbox через Турцию">
        <meta name="theme-color" content="#2bb673"/>
        <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
        <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
        <link rel="manifest" href="{{ asset('/manifest.json') }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @routes
        @vite('resources/js/app.js')
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function () {
                navigator.serviceWorker.register('/sw.js');
            });
        }
    </script>
</html>
