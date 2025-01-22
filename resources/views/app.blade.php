<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title inertia>{{ config('app.name', 'Capital Creative') }}</title>
        <link rel="icon" href="/images/logo-white.png">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
        <script src="/js/three.min2.js"></script>
        <script src="/js/LoaderSupport.js"></script>
        <script src="/js/OBJLoader2.js"></script>
        <script src="/js/OrbitControls.js"></script>
    </body>
</html>
