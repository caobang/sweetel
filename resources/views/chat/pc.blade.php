<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token 
        <meta name="csrf-token" content="{{ csrf_token() }}">-->
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Styles 
        <link href="{{ mix('css/home.css') }}" rel="stylesheet">-->
    </head>
    <body>
        <div id="app"></div>
        <!-- Scripts -->
        <script src="{{ mix('js/chat/pc.js') }}"></script>
    </body>
</html>