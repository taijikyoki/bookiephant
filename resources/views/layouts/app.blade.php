<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet">

        <title>@yield('title')</title>
        
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        
    </head>
    <body>
        @include('includes.header')
        <div class='grid h-screen place-items-center'>
            @yield('content')
        </div>
        @include('includes.footer')
    </body>
</html>
