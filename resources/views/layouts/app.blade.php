<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Paraiyar Matching - Matchfinder is a matchmaking portal for brides and grooms </title>

    <link rel="stylesheet" href="{{ asset("/css/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("/css/font-awesome.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/css/animate.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/css/style.css") }}">


    </head>
    <body>


        <x-loader />

        <x-header-top />



        @yield('content')


        <script src="{{ asset("/js/jquery.min.js") }}"></script>
        <script src="{{ asset("/js/popper.min.js") }}"></script>
        <script src="{{ asset("/js/bootstrap.min.js") }}"></script>
        <script src="{{ asset("/js/select-opt.js") }}"></script>
        <script src="{{ asset("/js/slick.js") }}"></script>
        <script src="{{ asset("/js/custom.js") }}"></script>

    </body>
</html>
