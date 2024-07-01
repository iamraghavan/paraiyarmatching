@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- LOGIN -->
<section>
    <div class="login mt-40">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div id="uploadForm">
                        <form id="uploadForm" style="margin-top: 2rem;" enctype="multipart/form-data">
                            @csrf
                            <input type="file" id="imageInput" accept=".jpg, .jpeg, .png" onchange="uploadImage(event)">
                        </form>
                    </div>
                    <div id="resultContainer" style="display: none;">
                        <div id="progressBar" class="progress" style="display: none;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div id="result"></div>
                        <div id="uploadedImageContainer" style="margin-top: 1rem;">
                            <img id="uploadedImage" src="#" alt="Uploaded Image" style="max-width: 100%; height: auto; display: none;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->

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

<script src="https://cdn.jsdelivr.net/npm/tesseract.js@5/dist/tesseract.min.js"></script>
<script>
    function uploadImage(event) {
        const input = event.target;
        const file = input.files[0];

        if (!file) {
            alert('Please select an image file.');
            return;
        }

        // Display progress bar
        const progressBar = document.getElementById('progressBar');
        progressBar.style.display = 'block';

        // Clear previous results
        document.getElementById('result').innerHTML = '';
        document.getElementById('uploadedImage').style.display = 'none'; // Hide previous uploaded image

        // Read the file as base64 data URL
        const reader = new FileReader();
        reader.onload = function(event) {
            const imageBase64 = event.target.result;

            // Display uploaded image
            document.getElementById('uploadedImage').src = imageBase64;
            document.getElementById('uploadedImage').style.display = 'block';

            // Run Tesseract OCR on the image
            Tesseract.recognize(
                imageBase64,
                'eng', // Language - you can change to other languages as needed
                { logger: m => console.log(m) } // Optional logger function
            ).then(({ data: { text } }) => {
                // Extract Aadhaar number from OCR result
                const regex = /\d{4}\s\d{4}\s\d{4}/;
                const matches = text.match(regex);
                const aadhaarNumber = matches ? matches[0] : 'Not found';

                // Update the UI with the extracted Aadhaar number
                document.getElementById('result').innerText = 'Aadhaar Number: ' + aadhaarNumber;

                // Hide progress bar
                progressBar.style.display = 'none';

                // Show result container
                document.getElementById('resultContainer').style.display = 'block';
            }).catch(error => {
                console.error('Error during OCR:', error);
                document.getElementById('result').innerText = 'Error during OCR. Please try again.';
                progressBar.style.display = 'none'; // Hide progress bar on error
            });
        };

        reader.readAsDataURL(file);
    }
</script>

<style>
    /* Custom CSS for responsive design */
    .login {
        text-align: center;
    }

    #uploadForm {
        margin-top: 2rem;
    }

    #uploadedImageContainer {
        margin-top: 1rem;
    }

    #uploadedImage {
        max-width: 100%;
        height: auto;
        display: none; /* Initially hide the uploaded image */
    }

    @media (max-width: 768px) {
        .col-md-6.offset-md-3 {
            max-width: 100%;
            flex: 0 0 100%;
            padding: 0 15px;
        }
    }
</style>

@endsection
