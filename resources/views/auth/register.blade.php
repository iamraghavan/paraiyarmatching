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

                                    {{-- <input type="text" id="phone" name="phone" placeholder="Phone Number" required>
                                    <input type="email" id="email" name="email" placeholder="Email" required>
                                    <button type="button" id="send-otp-btn">Send OTP</button>
                                    <div id="otp-verification" style="display: none;">
                                        <input type="text" id="otp" name="otp" placeholder="Enter OTP">
                                        <button type="button" id="verify-otp-btn">Verify OTP</button>
                                    </div> --}}

                                    <div class="form-group">
                                        <label class="lb" for="email">Email:</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="lb" for="phone">Phone:</label>
                                        <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Enter phone number" name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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

                                    {{-- <button type="button" id="sendOtpButton" class="btn btn-primary">Send OTP</button> --}}

                                    <button type="submit" id="registerButton" class="btn btn-primary">Create Account</button>
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

<!-- Form validation and regex -->
<script>
    const emailRegex = /^[a-zA-Z0-9._%+-]+@(gmail|outlook|hotmail)\.[a-zA-Z]{2,}$/;
    const phoneRegex = /^\d{10}$/;
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    const aadhaarRegex = /^\d{4} \d{4} \d{4}$/;

    function formatAadhaar(aadhaar) {
        return aadhaar.replace(/(\d{4})(\d{4})(\d{4})/, '$1 $2 $3');
    }

    function validateEmail(emailInput) {
        const email = emailInput.value.trim().toLowerCase();
        if (!emailRegex.test(email)) {
            emailInput.classList.add('is-invalid');
            return false;
        } else {
            emailInput.classList.remove('is-invalid');
            return true;
        }
    }

    function validatePhone(phoneInput) {
        const phone = phoneInput.value.trim();
        if (!phoneRegex.test(phone)) {
            phoneInput.classList.add('is-invalid');
            return false;
        } else {
            phoneInput.classList.remove('is-invalid');
            return true;
        }
    }

    function validateAadhaarNumber(aadhaarNumberInput) {
        let aadhaarNumber = aadhaarNumberInput.value.replace(/\s+/g, '');
        aadhaarNumber = aadhaarNumber.replace(/(.{4})/g, '$1 ').trim();
        aadhaarNumberInput.value = aadhaarNumber;
        if (!aadhaarRegex.test(aadhaarNumber)) {
            aadhaarNumberInput.classList.add('is-invalid');
            return false;
        } else {
            aadhaarNumberInput.classList.remove('is-invalid');
            return true;
        }
    }

    function validatePassword(passwordInput) {
        const password = passwordInput.value;
        if (!passwordRegex.test(password)) {
            passwordInput.classList.add('is-invalid');
            return false;
        } else {
            passwordInput.classList.remove('is-invalid');
            return true;
        }
    }

    function validateForm() {
        const emailInput = document.getElementById('email');
        const phoneInput = document.getElementById('phone');
        const aadhaarNumberInput = document.getElementById('aadhaar_number');
        const passwordInput = document.getElementById('password');
        const submitBtn = document.getElementById('registerButton');

        const isEmailValid = validateEmail(emailInput);
        const isPhoneValid = validatePhone(phoneInput);
        const isAadhaarNumberValid = validateAadhaarNumber(aadhaarNumberInput);
        const isPasswordValid = validatePassword(passwordInput);

        submitBtn.disabled =!(isEmailValid && isPhoneValid && isAadhaarNumberValid && isPasswordValid);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const emailInput = document.getElementById('email');
        const phoneInput = document.getElementById('phone');
        const aadhaarNumberInput = document.getElementById('aadhaar_number');
        const passwordInput = document.getElementById('password');

        emailInput.addEventListener('input', validateForm);
        phoneInput.addEventListener('input', validateForm);
        aadhaarNumberInput.addEventListener('input', validateForm);
        passwordInput.addEventListener('input', validateForm);
    });
</script>

<!-- Auto-complete and password suggestion -->
<script>
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    emailInput.autocomplete = 'email';
    passwordInput.autocomplete = 'new-password';

    // Add password suggestion
    passwordInput.addEventListener('input', function() {
        const password = passwordInput.value;
        const suggestions = [];
        if (password.length > 3) {
            suggestions.push(`Strong password: ${password}!`);
            suggestions.push(`Try a variation: ${password}123`);
        }
        passwordInput.dataset.suggestions = suggestions.join('\n');
    });
</script>

<!-- Tesseract OCR -->
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
                    const aadhaarNumber = matches? matches[0] : 'Not found';

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
<!-- Your existing form elements -->




<style>
/* Custom Modal CSS */
.modal {
  display: none;
  position: fixed;
  z-index: 1050;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  outline: 0;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-dialog {
  position: relative;
  width: auto;
  margin: 1.75rem auto;
  pointer-events: none;
  max-width: 500px;
}

.modal-content {
  position: relative;
  display: flex;
  flex-direction: column;
  width: 100%;
  pointer-events: auto;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 0.3rem;
  outline: 0;
}

.modal-header,
.modal-body,
.modal-footer {
  padding: 1rem;
}

.modal-header {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  border-bottom: 1px solid #e9ecef;
  border-top-left-radius: 0.3rem;
  border-top-right-radius: 0.3rem;
}

.modal-title {
  margin-bottom: 0;
  line-height: 1.5;
}

.modal-body {
  position: relative;
  flex: 1 1 auto;
}

.modal-footer {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  border-top: 1px solid #e9ecef;
  border-bottom-right-radius: 0.3rem;
  border-bottom-left-radius: 0.3rem;
}

.modal-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #000;
  opacity: 0.5;
  z-index: 1040;
}

.close {
  float: right;
  font-size: 1.5rem;
  font-weight: 700;
  line-height: 1;
  color: #000;
  text-shadow: 0 1px 0 #fff;
  opacity: 0.5;
  background: none;
  border: none;
}

.close:focus,
.close:hover {
  color: #000;
  text-decoration: none;
  opacity: 0.75;
}

.green-tick {
  width: 50px;
  height: 50px;
  background-image: url('/images/icons8-tick.gif');
  background-size: cover;
  display: none;
}

</style>


<!-- Custom OTP Modal -->
<div id="otpModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="otpModalLabel">OTP Verification</h5>
                <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>OTP sent to your registered email ID: <span id="emailId"></span>. Please check the mail in your inbox or spam folder.</p>
                <div class="form-group">
                    <label for="otp">Enter OTP:</label>
                    <input type="text" class="form-control" id="otp" placeholder="Enter OTP">
                </div>
                <div id="otpError" class="text-danger" style="display: none;"></div>
                <div class="green-tick"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                <button type="button" id="verifyOtpButton" class="btn btn-primary">Verify OTP</button>
            </div>
        </div>
    </div>
</div>



    @endsection
