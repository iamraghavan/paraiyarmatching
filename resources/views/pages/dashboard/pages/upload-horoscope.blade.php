@extends('pages.dashboard.layouts.app')
@section('dashboard-content')

<style>
    /* Style for the form container */
.form-container {
    max-width: 400px;
    margin: 0 auto;
}

/* Style for the form input fields */
.form-container input[type="text"],
.form-container input[type="file"],
.form-container button {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Style for the submit button */
.form-container button {
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
}

/* Style for the file input label */
.file-label {
    display: block;
    margin-bottom: 10px;
}

/* Style for the file input */
.file-input {
    display: none;
}

/* Style for the file input button */
.file-input + label {
    background-color: #3498db;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
}

/* Style for the file input button on hover */
.file-input + label:hover {
    background-color: #2980b9;
}



</style>


<section>
    <div class="login pro-edit-update">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="db-nav">
                        <div class="db-nav-pro"><img src="{{url($profile->profile_image)}}" class="img-fluid" alt=""></div>
                        <div class="db-nav-list">
                            <ul>
                                <li><a href="{{url('/app/profile/dashboard')}}" class="act"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a></li>

                                <li><a href="{{url('/app/gallery/upload')}}"><i class="fa fa-upload" aria-hidden="true"></i>Upload Gallery</a></li>
                                <li><a href="{{url('/app/horoscope/upload')}}"><i class="fa fa-upload" aria-hidden="true"></i>Upload Horoscope</a></li>
                                <li><a href="{{url('/app/f/'. $user->pmid .'/membership-plan')}}"><i class="fa fa-money" aria-hidden="true"></i>Plan</a></li>
                                    @php
                                    function generateRandomString($length = 100) {
                                        return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', $length)), 0, $length);
                                    }

                                    $randomString = generateRandomString(); // Creates a long random alphanumeric string
                                    $salt = 'pmat'; // You can generate a more secure salt or use a constant
                                    $saltedString = $randomString . $salt;
                                    $hashedString = hash('sha256', $saltedString); // Hash the salted string using SHA-256
                                @endphp

                                <li>
                                    <a href="{{ url('/app/profile/user-profile-edit/' . $user->pmid . '/' . $hashedString) }}">
                                        <i class="fa fa-cog" aria-hidden="true"></i>Edit Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/app/profile/edit-personal-data/' . $user->pmid . '/' . $hashedString) }}">
                                        <i class="fa fa-cog" aria-hidden="true"></i>Edit Personal Data
                                    </a>
                                </li>


                                <li><a onclick="confirmLogout()"><i class="fa fa-sign-out" aria-hidden="true"></i>Log out</a></li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-9">
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <h2 class="db-tit">Profile settings</h2> --}}
                            <div class="form-container">
                                <form action="{{ route('horoscope.uploads') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="user_pmid" value="{{$user->pmid}}" name="user_pmid" required>

                                    <!-- File input container -->
                                    <div class="file-label">
                                        <input type="file" id="horoscope" name="horoscope" accept="application/pdf" class="file-input" required>
                                        <label for="horoscope" class="file-button">Choose Horoscope PDF</label>
                                    </div>

                                    <!-- Submit button -->
                                    <button type="submit">Upload</button>
                                </form>
                            </div>




                                <br>



                        </div>


                    </div>

                    <div class="row">


                        <div class="col-lg-12">

                            @if($profile->horoscope_url)
                            <a href='{{ $profile->horoscope_url }}'><h4 class="mt-4 mb-4 text-center">{{$user->name}} Horoscope</h4></a>



                        @else
                            <p style="font-size: 1rem;" class="text-danger"> * Please upload your Horoscope</p>
                        @endif

                        <div class="iframe-div">
                            <iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url={{ urlencode($profile->horoscope_url ?? '') }}#toolbar=0&scrollbar=0" frameborder="0" scrolling="auto" height="100%" width="100%" style="
                        height: 100rem !important;
                    "></iframe>
                        {{-- <iframe src="" height="100%" width="100%" style="{{ $profile->horoscope_url ? 'height: 100rem; border: none;' : 'display: none;' }}"></iframe> --}}



                            </div>

                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>




</section>


<style>
    .iframe-div {
    width: 100%;
    max-width: 100%;
}

/* Set the iframe to fill the container and adjust height accordingly */
iframe {
    width: 100%;
    height: 100vh; /* Adjust as needed */
    border: none; /* Remove border */
    overflow: auto; /* Allow scrolling */
}
</style>
<style>
    .full-width-button {
        width: 100%;
        background-color: #007bff !important;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .image-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
    .full-width-button:hover {
        background-color: #0056b3 !important;
    }


.image-container img {
    width: 100%;
    margin-bottom: 10px;
    object-fit: cover; /* Ensures the image covers the container */
}

.delete-link {
    width: 100%;
    text-align: center;
}

.delete-btn {
    width: 100%;
    background-color: #dc3545; /* Bootstrap danger color */
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.delete-btn i {
    margin-right: 5px;
}

.delete-btn:hover {
    background-color: #c82333; /* Darker shade for hover effect */
}

</style>

<script>
     document.addEventListener('DOMContentLoaded', function () {
        // Get the file input element
        const fileInput = document.getElementById('horoscope');

        // Get the file input label
        const fileLabel = document.querySelector('.file-button');

        // Add event listener for file input change
        fileInput.addEventListener('change', function (event) {
            // Get the selected file
            const file = event.target.files[0];

            // Check if file is selected
            if (file) {
                // Set the file name to the file input label
                fileLabel.textContent = file.name;
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        // Get the file input element
        const fileInput = document.getElementById('horoscope');

        // Add event listener for file input change
        fileInput.addEventListener('change', function (event) {
            // Get the selected file
            const file = event.target.files[0];

            // Check if file size is less than 2MB
            if (file.size > 2 * 1024 * 1024) { // 2MB in bytes
                // Show SweetAlert error message
                Swal.fire({
                    icon: 'error',
                    title: 'File Size Exceeded',
                    text: 'The selected file exceeds the maximum allowed size of 2MB. Please compress your PDF file using the link provided.',
                    footer: '<a href="https://www.adobe.com/in/acrobat/online/compress-pdf.html" target="_blank">Compress PDF</a>'
                });

                // Clear the file input
                fileInput.value = '';
            }
        });
    });
</script>
@endsection
