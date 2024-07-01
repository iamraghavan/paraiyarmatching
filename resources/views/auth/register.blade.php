@extends('layouts.app')
@section('content')

<!-- REGISTER -->
<section>
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="inn">
                    <div class="lhs">
                        <div class="tit">
                            <h2>Now <b>Find your life partner</b> Easy and fast.</h2>
                        </div>
                        <div class="im">
                            <img src="{{ asset('images/login-couple.png') }}" alt="PMAT01">
                        </div>
                        <div class="log-bg">&nbsp;</div>
                    </div>
                    <div class="rhs">
                        <div>
                            <div class="form-tit">
                                <h4>Start for free</h4>
                                <h1>Sign up to Matrimony</h1>
                                <p>Already a member? <a href="{{ url('/app/login') }}">Login</a></p>
                            </div>
                            <div class="form-login">
                                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                    @csrf

                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label class="lb" for="name">Name:</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter your full name" name="name" value="{{ old('name') }}" required autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="lb">Gender</label>
                                        <div class="gender-icons">
                                            <label for="male">
                                                <input type="radio" id="male" name="gender" value="male" class="@error('gender') is-invalid @enderror" style="display: none;" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                                <img src="https://cdn-icons-png.flaticon.com/512/9220/9220623.png" alt="Male" title="Male"> <p>male</p>
                                            </label>
                                            <label for="female">
                                                <input type="radio" id="female" name="gender" value="female" class="@error('gender') is-invalid @enderror" style="display: none;" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                                <img src="https://cdn-icons-png.flaticon.com/512/1019/1019173.png" alt="Female" title="Female"> <p>female</p>
                                            </label>
                                        </div>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <input type="text" id="phone" name="phone" placeholder="Phone Number" required>
                                    <input type="email" id="email" name="email" placeholder="Email" required>
                                    <button type="button" id="send-otp-btn">Send OTP</button>
                                    <div id="otp-verification" style="display: none;">
                                        <input type="text" id="otp" name="otp" placeholder="Enter OTP">
                                        <button type="button" id="verify-otp-btn">Verify OTP</button>
                                    </div>

                                    <div class="form-group">
                                        <label class="lb" for="aadhar_image">Upload Aadhar Card: <span style="color:red">*Aadhar Front Photo / Image</span></label>
                                        <input required type="file" id="imageInput" accept=".jpg, .jpeg, .png" onchange="uploadImage(event)" class="form-control @error('aadhar_image') is-invalid @enderror" name="aadhar_image" value="{{ old('aadhar_image') }}" required maxlength="14">
                                        @error('aadhar_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="invalid-feedback" id="aadhaar-number-error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="lb" for="aadhaar_number">Aadhaar Number:</label>
                                        <input type="text" class="form-control @error('aadhaar_number') is-invalid @enderror" id="aadhaar_number" placeholder="Enter Aadhaar number" name="aadhaar_number" value="{{ old('aadhaar_number') }}" required maxlength="14">
                                        @error('aadhaar_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="invalid-feedback" id="aadhaar-number-error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="lb" for="password">Password:</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter password" name="password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="invalid-feedback" id="password-error"></span>
                                    </div>

                                    <div class="form-group form-check">
                                        <input style="height: 1.1rem !important;" class="form-check-input @error('agree') is-invalid @enderror" type="checkbox" name="agree" id="agree" {{ old('agree') ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="agree">
                                            <a href="#!">Terms of Service</a>, Privacy Policy,
                                        </label>
                                        @error('agree')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <button type="submit" id="submit-btn" class="btn btn-primary" disabled>Create Account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="https://cdn.jsdelivr.net/npm/tesseract.js@5/dist/tesseract.min.js"></script>
<script>
    function uploadImage(event) {
        const input = event.target;
        const file = input.files[0];

        if (!file) {
            alert('Please select an image file.');
            return;
        }

        const reader = new FileReader();

        reader.onload = function(event) {
            const image = new Image();
            image.onload = function() {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');

                // Determine canvas dimensions based on image orientation
                if (image.width > image.height) {
                    canvas.width = 800; // Landscape image width
                    canvas.height = (image.height / image.width) * 800;
                } else {
                    canvas.width = 800; // Portrait image height
                    canvas.height = (image.height / image.width) * 800;
                }

                // Draw image on canvas
                ctx.drawImage(image, 0, 0, canvas.width, canvas.height);

                // Convert canvas to base64 data URL
                const imageBase64 = canvas.toDataURL('image/jpeg');

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
                    const aadhaarNumberInput = document.getElementById('aadhaar_number');
                    if (aadhaarNumberInput) {
                        if (aadhaarNumber === 'Not found') {
                            Swal.fire({
                                icon: 'info',
                                title: 'Aadhaar Number Not Detected',
                                text: 'Please upload a horizontally aligned top photo/image of your Aadhaar card.',
                                imageUrl: '{{ asset('images/aadhaar-instruction.webp') }}',
                                imageWidth: 700,
                                imageHeight: 200,
                                imageAlt: 'Aadhaar Instructions'
                            });
                        } else {
                            aadhaarNumberInput.value = aadhaarNumber;
                        }
                    }

                }).catch(error => {
                    console.error('Error during OCR:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to extract Aadhaar number. Please try again.'
                    });
                });
            };

            // Load the selected image
            image.src = event.target.result;
        };

        reader.readAsDataURL(file);
    }
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const emailInput = document.getElementById('email');
        const phoneInput = document.getElementById('phone');
        const passwordInput = document.getElementById('password');
        const aadhaarNumberInput = document.getElementById('aadhaar_number');
        const submitBtn = document.getElementById('submit-btn');

        const emailError = document.getElementById('email-error');
        const phoneError = document.getElementById('phone-error');
        const passwordError = document.getElementById('password-error');
        const aadhaarNumberError = document.getElementById('aadhaar-number-error');

        const emailRegex = /^[a-zA-Z0-9._%+-]+@(gmail|outlook|hotmail)\.[a-zA-Z]{2,}$/; // Only allow gmail, outlook, hotmail domains
        const phoneRegex = /^\d{10}$/; // Exactly 10 digits
        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/; // Minimum 8 characters, include a letter, a number, and a special character
        const aadhaarRegex = /^\d{4} \d{4} \d{4}$/; // Format: 1111 1111 1111

        function formatAadhaar(aadhaar) {
            return aadhaar.replace(/(\d{4})(\d{4})(\d{4})/, '$1 $2 $3');
        }

        function validateEmail() {
            const email = emailInput.value.trim().toLowerCase(); // Trim whitespace and convert to lowercase
            if (!emailRegex.test(email)) {
                emailError.textContent = 'Please enter a valid Gmail, Outlook, or Hotmail email address.';
                emailInput.classList.add('is-invalid');
                return false;
            } else {
                emailError.textContent = '';
                emailInput.classList.remove('is-invalid');
                return true;
            }
        }

        function validatePhone() {
            const phone = phoneInput.value.trim(); // Trim whitespace
            if (!phoneRegex.test(phone)) {
                phoneError.textContent = 'Please enter a valid 10-digit phone number.';
                phoneInput.classList.add('is-invalid');
                return false;
            } else {
                phoneError.textContent = '';
                phoneInput.classList.remove('is-invalid');
                return true;
            }
        }

        function validateAadhaarNumber() {
            let aadhaarNumber = aadhaarNumberInput.value.replace(/\s+/g, ''); // Remove spaces
            aadhaarNumber = aadhaarNumber.replace(/(.{4})/g, '$1 ').trim(); // Add spaces every 4 digits
            aadhaarNumberInput.value = aadhaarNumber; // Format Aadhaar number
            if (!aadhaarRegex.test(aadhaarNumber)) {
                aadhaarNumberError.textContent = 'Please enter a valid Aadhaar number in the format: 1111 1111 1111.';
                aadhaarNumberInput.classList.add('is-invalid');
                return false;
            } else {
                aadhaarNumberError.textContent = '';
                aadhaarNumberInput.classList.remove('is-invalid');
                return true;
            }
        }

        function validatePassword() {
            const password = passwordInput.value;
            if (!passwordRegex.test(password)) {
                passwordError.textContent = 'Password must be at least 8 characters long, include a letter, a number, and a special character.';
                passwordInput.classList.add('is-invalid');
                return false;
            } else {
                passwordError.textContent = '';
                passwordInput.classList.remove('is-invalid');
                return true;
            }
        }

        function validateForm() {
            const isEmailValid = validateEmail();
            const isPhoneValid = validatePhone();
            const isAadhaarNumberValid = validateAadhaarNumber();
            const isPasswordValid = validatePassword();
            submitBtn.disabled = !(isEmailValid && isPhoneValid && isAadhaarNumberValid && isPasswordValid);
        }

        emailInput.addEventListener('blur', validateEmail);
        phoneInput.addEventListener('blur', validatePhone);
        aadhaarNumberInput.addEventListener('blur', validateAadhaarNumber);
        passwordInput.addEventListener('blur', validatePassword);

        emailInput.addEventListener('input', validateForm);
        phoneInput.addEventListener('input', validateForm);
        aadhaarNumberInput.addEventListener('input', validateForm);
        passwordInput.addEventListener('input', validateForm);
    });
</script>




<script>
    // Function to check and update OTP request count
    function canSendOTP() {
        const otpRequests = localStorage.getItem('otpRequests') || '[]';
        const requests = JSON.parse(otpRequests);
        const today = new Date().toISOString().split('T')[0];

        // Filter out requests that are not from today
        const todayRequests = requests.filter(request => request.date === today);

        if (todayRequests.length >= 2) {
            return false;
        }

        // Update local storage with the new request
        todayRequests.push({ date: today });
        localStorage.setItem('otpRequests', JSON.stringify(todayRequests));
        return true;
    }

    // Event listener for send OTP button
    document.getElementById('send-otp-btn').addEventListener('click', function() {
        if (!canSendOTP()) {
            alert('You have reached the maximum OTP requests for today.');
            return;
        }

        const phone = document.getElementById('phone').value;
        const email = document.getElementById('email').value;

        fetch('/send-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ phone, email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.email_response && data.whatsapp_response) {
                document.getElementById('otp-verification').style.display = 'block';
                alert('OTP sent to your email and WhatsApp.');
            } else {
                alert('Failed to send OTP.');
            }
        });
    });

    // Event listener for verify OTP button
    document.getElementById('verify-otp-btn').addEventListener('click', function() {
        const otp = document.getElementById('otp').value;

        fetch('/verify-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ otp })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('OTP verified successfully.');
                document.getElementById('phone').disabled = true;
                document.getElementById('email').disabled = true;
                document.getElementById('otp-verification').style.display = 'none';
                document.getElementById('send-otp-btn').style.display = 'none';

                // Clear local storage after successful OTP verification
                localStorage.removeItem('otpRequests');
            } else {
                alert(data.message);
            }
        });
    });
</script>





    @endsection
