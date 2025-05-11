<!DOCTYPE html>
<html data-wf-page="68152a2ec418651a6f726115" data-wf-site="68152a2ec418651a6f7260fd">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Capital Kreatives') }}</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Webflow" name="generator">

    <!-- Styles -->
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/webflow.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/makomboreros-beautiful-site.webflow.css') }}" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">WebFont.load({  google: {    families: ["Montserrat:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic","Bebas Neue:regular"]  }});</script>

    <style>
        html, body {
            overflow-x: hidden; /* Prevent horizontal scroll at document level */
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        .fl-wrapper{
            z-index: 105086!important;
        }
    </style>

    <!-- Livewire Styles - Only for form pages -->
    @livewireStyles
</head>
<body class="body">
<!-- Header -->
@include('partials.header')

<!-- Main Content -->
<main>
    @yield('content')
</main>

<!-- Footer -->
@include('partials.footer')

<!-- Scripts -->
<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=68152a2ec418651a6f7260fd" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="{{ asset('js/webflow.js') }}" type="text/javascript"></script>

<!-- Livewire Scripts - Only for form pages -->
@livewireScripts
</body>
</html>
