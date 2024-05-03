<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $user->name }} - {{ $user->pmid }} - Paraiyar Matching - Matchfinder for brides and grooms </title>

        {{-- Link & Style --}}

    <link rel="stylesheet" href="{{ asset("/css/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("/css/font-awesome.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/css/animate.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/css/style.css") }}">

    {{-- Style & Link CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">




    </head>
    <body>


        <x-loader />
        <x-header-top />



        @yield('dashboard-content')




        {{-- Script CDN --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- Script --}}
        <script src="{{ asset("/js/jquery.min.js") }}"></script>
        <script src="{{ asset("/js/popper.min.js") }}"></script>
        <script src="{{ asset("/js/bootstrap.min.js") }}"></script>
        <script src="{{ asset("/js/select-opt.js") }}"></script>
        <script src="{{ asset("/js/slick.js") }}"></script>
        <script src="{{ asset("/js/custom.js") }}"></script>
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

        <script>
            // Get the elements
            const dobInput = document.getElementById('dob');
            const ageInput = document.getElementById('age');

            // Add event listener for date of birth change
            dobInput.addEventListener('change', function() {
                // Calculate age
                const dob = new Date(this.value);
                const today = new Date();
                const age = today.getFullYear() - dob.getFullYear();

                // Check if the birthday hasn't occurred yet this year
                if (today.getMonth() < dob.getMonth() || (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
                    age--;
                }

                // Update the age input value
                ageInput.value = age;

                // Check if the user is below 18 years old
                if (age < 18) {
                    // Show a confirmation message before logout
                    Swal.fire({
                        title: 'You are below 18 years old.',
                        text: 'You will be logged out in 2 seconds | You are not allowed to continue with your profile.',
                        icon: 'warning',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        willClose: () => {
                            // Perform logout after confirmation message is closed
                            window.location.href = '/app/logout';
                        }
                    });
                }
            });
        </script>


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
