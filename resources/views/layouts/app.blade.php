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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">




    </head>
    <body>


        <x-loader />
        <x-header-top />



        @yield('content')



@if(session('success'))
<script>
    swal({
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
    swal({
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="{{ asset("/js/jquery.min.js") }}"></script>
        <script src="{{ asset("/js/popper.min.js") }}"></script>
        <script src="{{ asset("/js/bootstrap.min.js") }}"></script>
        <script src="{{ asset("/js/select-opt.js") }}"></script>
        <script src="{{ asset("/js/slick.js") }}"></script>
        <script src="{{ asset("/js/custom.js") }}"></script>


        <script>
            // Function to handle logout click event
            function confirmLogout() {
                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure you want to logout?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, logout',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    // Handle confirmation result
                    if (result.isConfirmed) {
                        window.location.href = '/app/logout'; // Redirect to logout URL
                    }
                });
            }
        </script>


    </body>
</html>
