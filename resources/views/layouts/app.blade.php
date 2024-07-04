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

            {{ seo()->render() }}
            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


            <script type="application/ld+json">
                {
                  "@context": "https://schema.org",
                  "@type": "Organization",
                  "name": "Paraiyar Matching",
                  "logo": "{{asset('images/logo-b.png')}}",
                  "description": "Paraiyar Matching: No. 1 site for Tamil Brides & Grooms. Trusted globally. Register free!",
                  "contactPoint": {
                    "@type": "ContactPoint",
                    "telephone": "918667090188",
                    "email": "info@paraiyarmatching.com"
                  }
                }
                </script>


                <script type="application/ld+json">
                    {
                        "@context": "http://schema.org/",
                        "@type": "LocalBusiness",
                        "name": "Paraiyar Matching",
                        "image": "{{asset('images/logo-b.png')}}",
                        "priceRange": "3000",
                        "telephone": "918667090188",
                        "url": "Request::path()",
                        "address": {
                            "@type": "PostalAddress",
                            "streetAddress": "Ambattur Industrial Estate",
                            "addressLocality": "Chennai",
                            "addressRegion": "Tamil Nadu",
                            "postalCode": "600053",
                            "addressCountry": "IN"
                        },
                        "openingHoursSpecification": [
                            {
                                "@type": "OpeningHoursSpecification",
                                "dayOfWeek": ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                                "opens": "00:00",
                                "closes": "12:00"
                            },
                            {
                                "@type": "OpeningHoursSpecification",
                                "dayOfWeek": [],
                                "opens": "",
                                "closes": ""
                            }
                        ]
                    }
                    </script>

        <link rel="stylesheet" href="{{ asset("/css/bootstrap.css") }}">
        <link rel="stylesheet" href="{{ asset("/css/font-awesome.min.css") }}">
        <link rel="stylesheet" href="{{ asset("/css/animate.min.css") }}">
        <link rel="stylesheet" href="{{ asset("/css/style.css") }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">

    <style>
          .cta {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            margin-top: 10px;
        }
        .cta:hover {
            background-color: #0056b3;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            text-align: center;
            border-radius: 8px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
    </style>

    {{-- <script src="{{ asset('js/inactivity-logout.js') }}" defer></script> --}}
    <style>
        /* Hide the block on mobile devices */
@media (max-width: 768px) {
    .desktop-view {
        display: none;
    }
}

    </style>



    </head>
    <body>


        <x-loader />
        <x-header-top />



        @yield('content')


        @if(session('alert'))
        <div class="alert alert-warning">
            {{ session('alert') }}
        </div>
    @endif




@if(session('success'))
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session('success') }}',
        icon: 'success',
        buttons: false,
        timer: 3000,
        showConfirmButton: false,
        showCloseButton: true,
        animation: true
    });
</script>

@endif


@if(session('error'))
<script>
    Swal.fire({
        title: 'Error!',
        text: '{{ session('error') }}',
        icon: 'error',
        buttons: false,
        timer: 3000,
        showConfirmButton: false,
        showCloseButton: true,
        animation: true
    });
</script>
@endif



<!-- Modal HTML -->



<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="{{ asset("/js/jquery.min.js") }}"></script>
        <script src="{{ asset("/js/popper.min.js") }}"></script>
        <script src="{{ asset("/js/bootstrap.min.js") }}"></script>
        <script src="{{ asset("/js/select-opt.js") }}"></script>
        <script src="{{ asset("/js/slick.js") }}"></script>
        <script src="{{ asset("/js/custom.min.js") }}"></script>



 @turnstileScripts()

    </body>
</html>
