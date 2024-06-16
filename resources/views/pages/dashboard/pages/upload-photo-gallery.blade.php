@extends('pages.dashboard.layouts.app')
@section('dashboard-content')


<style>

button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    text-align: center;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}


button[type="submit"]:hover {
    background-color: #45a049;
}


/* Image Grid */
.login .container .row .inn .rhs .image-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

/* Image Container */
.login .container .row .inn .rhs .image-container {
    position: relative; /* Required for absolute positioning */
    width: 48%; /* Adjust the width of each image container */
    margin-bottom: 20px; /* Adjust the space between images */
}

/* Image */
.login .container .row .inn .rhs .image-container img {
    width: 100%; /* Ensure images fill their container */
    height: auto; /* Maintain aspect ratio */
    display: block; /* Remove default inline display */
}

/* Delete Button */
.login .container .row .inn .rhs .image-container .delete-btn {
    position: absolute;
    bottom: 10px; /* Adjust the distance from the bottom */
    left: 50%; /* Align button to the center horizontally */
    transform: translateX(-50%); /* Center the button */
    background-color: #dc3545; /* Red background color */
    color: #fff; /* White text color */
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

/* Media Query for Mobile Devices */
@media (max-width: 768px) {
    .login .container .row .inn .rhs .image-container {
        width: 100%; /* Make each image take full width on smaller screens */
    }
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
                                <li><a href="{{url('/')}}"><i class="fa fa-money" aria-hidden="true"></i>Plan</a></li>
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
                        <div class="col-md-12 db-sec-com">
                            {{-- <h2 class="db-tit">Profile settings</h2> --}}
                            <div class="col7 fol-set-rhs">
                                <form action="{{ route('gallery.upload') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="formFileMultiple" class="form-label">Upload Photos</label>
                                        <input class="form-control" type="file" id="formFileMultiple" name="images[]" accept="image/*">
                                      </div>
                                      <button type="submit" class="full-width-button">Upload</button>
                                </form>


                            </div>
                        </div>


                    </div>

                    <div class="row">

                        @foreach($images as $image)
                        <div class="col-lg-6">

                                <div class="image-container">
                                    <img src="{{ url($image->image_url) }}" alt="Image">
                                    <a onclick="return confirm('Are you sure you want to Delete ?')" href="{{ route('gallery.delete', $image->id) }}">
                                        <button class="btn btn-danger delete-btn"><i class="fa fa-trash"></i> Delete</button>
                                    </a>
                                </div>

                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>




</section>



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


@endsection
