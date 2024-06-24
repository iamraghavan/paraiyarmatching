<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="index, follow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#404040">
        <meta name="apple-mobile-web-app-title" content="Paraiyar Matching">
        <meta name="application-name" content="Paraiyar Matching">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="theme-color" content="#ffffff">
        {{-- <title>Paraiyar Matching - Matchfinder is a matchmaking portal for brides and grooms </title> --}}

        <link rel="stylesheet" crossorigin href="{{ asset("/admin/assets/compiled/css/app.css") }}">
        <link rel="stylesheet" crossorigin href="{{ asset("/admin/assets/compiled/css/app-dark.css") }}">
        <link rel="stylesheet" crossorigin href="{{ asset("/admin/assets/compiled/css/iconly.css") }}">
        <link rel="stylesheet" crossorigin href="{{ asset("/admin/assets/compiled/css/auth.css") }}">

          <script src="{{ asset("/admin/assets/static/js/initTheme.js") }}"></script>


    {{-- Style & Link CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">





    </head>
    <body>



        @yield('ac-content')


        <script src="{{ asset("/admin/assets/static/js/components/dark.js") }}"></script>
        <script src="{{ asset("/admin/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js") }}"></script>


        <script src="{{ asset("/admin/assets/compiled/js/app.js") }}"></script>



    <!-- Need: Apexcharts -->
    <script src="{{ asset("/admin/assets/extensions/apexcharts/apexcharts.min.js") }}"></script>
    <script src="{{ asset("/admin/assets/static/js/pages/dashboard.js") }}"></script>

    </body>
</html>
