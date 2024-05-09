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
                <div class="inn">
                    <div class="rhs">
                        <form action="{{ route('gallery.upload') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="images[]" multiple accept="image/*">
                            <button type="submit">Upload</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <div class="login pro-edit-update">
    <div class="container">
        <div class="row">
            <div class="inn">
                <div class="rhs">
                    <!-- Image Grid -->
                    <div class="image-grid">
                        <!-- Image 1 -->
                        @foreach($images as $image)
                        <div class="image-container">
                            <img src="{{ url($image->image_url) }}" alt="Image 1">
                            <a onclick="return confirm('Are you sure you want to Delete ?')" href="{{ route('gallery.delete', $image->id) }}">
                                <button class="btn btn-danger delete-btn"><i class="fa fa-trash"></i> Delete</button>
                            </a>
                        </div>
                        @endforeach
                        <!-- Repeat for Image 2, Image 3, and Image 4 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>






@endsection
