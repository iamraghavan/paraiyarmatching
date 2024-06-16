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
                            <img src="{{asset('images/login-couple.png')}}" alt="PMAT01">
                        </div>
                        <div class="log-bg">&nbsp;</div>
                    </div>
                    <div class="rhs">
                        <div>
                            <div class="form-tit">
                                <h4>Start for free</h4>
                                <h1>Sign up to Matrimony</h1>
                                <p>Already a member? <a href="{{url('/app/login')}}">Login</a></p>
                            </div>
                            <div class="form-login">
                                <form method="POST" action="{{ route('register') }}">
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

                                    <div class="form-group">
                                        <label class="lb" for="email">Email:</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="invalid-feedback" id="email-error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="lb" for="phone">Phone:</label>
                                        <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Enter phone number" name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="invalid-feedback" id="phone-error"></span>
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

                                    {{-- <div class="form-group">
                                        <x-turnstile
                                            data-action="login"
                                            data-cdata="sessionid-123456789"
                                            data-callback="callback"
                                            data-expired-callback="expiredCallback"
                                            data-error-callback="errorCallback"
                                            data-theme="light"
                                            data-tabindex="1"
                                        />
                                    </div> --}}

                                    <button type="submit" class="btn btn-primary">Create Account</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const passwordInput = document.getElementById('password');
    const submitBtn = document.getElementById('submit-btn');

    const emailError = document.getElementById('email-error');
    const phoneError = document.getElementById('phone-error');
    const passwordError = document.getElementById('password-error');

    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const phoneRegex = /^\d{10}$/;
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    function validateEmail() {
        const email = emailInput.value;
        if (!emailRegex.test(email)) {
            emailError.textContent = 'Please enter a valid email address.';
            emailInput.classList.add('is-invalid');
            return false;
        } else {
            emailError.textContent = '';
            emailInput.classList.remove('is-invalid');
            return true;
        }
    }

    function validatePhone() {
        const phone = phoneInput.value;
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
        const isPasswordValid = validatePassword();
        submitBtn.disabled = !(isEmailValid && isPhoneValid && isPasswordValid);
    }

    emailInput.addEventListener('input', validateForm);
    phoneInput.addEventListener('input', validateForm);
    passwordInput.addEventListener('input', validateForm);
});

</script>

@endsection
