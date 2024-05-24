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
                <div class="inn">
                    <div class="rhs">

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

                            @if($profile->horoscope_url)
    <a href='{{ $profile->horoscope_url }}'>{{$user->name}} Horoscope</a>
@else
    <p style="font-size: 1rem;" class="text-danger"> * Please upload your Horoscope</p>
@endif


<iframe src="{{ $profile->horoscope_url ?? '' }}" height="100%" width="100%" style="{{ $profile->horoscope_url ? 'height: 100rem; border: none;' : 'display: none;' }}"></iframe>







                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
