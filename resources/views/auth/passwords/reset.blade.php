@extends('layouts.app')

@section('content')
<style>
    .error { color: red; }
    .valid { color: green; }
    .suggestions { margin-top: 10px; }
    .suggestions ul { list-style-type: none; padding: 0; }
    .suggestions li { margin-bottom: 5px; }
</style>

<section>
    <div class="login">
        <div class="container">
            <div class="row">

                <div class="inn">
                    <div class="lhs">
                        <div class="tit">
                            <h2>Enter your Strong Password.</h2>
                        </div>
                        {{-- <div class="im">
                            <img src="images/login-couple.png" alt="">
                        </div> --}}
                        <div class="log-bg">&nbsp;</div>
                    </div>
                    <div class="rhs">
                        <div>
                            <div class="form-tit">
                                <h4>Reset Your Password</h4>
                                <h1>Create a New Password</h1>
                                <p>Remembered your password? <a href="{{url('/app/login')}}">Sign in now</a></p>
                            </div>


                            @if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

                            <div class="form-login">
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $email ?? old('email') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        <small id="passwordHelp" class="form-text"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">Confirm Password</label>
                                        <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required>
                                        <small id="passwordMatchHelp" class="form-text"></small>
                                    </div>

                                    <div class="suggestions">
                                        <h4>Password must include:</h4>
                                        <ul id="passwordSuggestions">
                                            <li id="uppercase" class="error">An uppercase letter</li>
                                            <li id="lowercase" class="error">A lowercase letter</li>
                                            <li id="number" class="error">A number</li>
                                            <li id="symbol" class="error">A symbol</li>
                                        </ul>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Reset Password</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<script>
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password-confirm');
    const passwordHelp = document.getElementById('passwordHelp');
    const passwordMatchHelp = document.getElementById('passwordMatchHelp');
    const suggestions = {
        uppercase: document.getElementById('uppercase'),
        lowercase: document.getElementById('lowercase'),
        number: document.getElementById('number'),
        symbol: document.getElementById('symbol')
    };

    passwordInput.addEventListener('input', validatePassword);
    passwordConfirmInput.addEventListener('input', matchPassword);

    function validatePassword() {
        const password = passwordInput.value;
        let valid = true;

        if (/[A-Z]/.test(password)) {
            suggestions.uppercase.className = 'valid';
        } else {
            suggestions.uppercase.className = 'error';
            valid = false;
        }

        if (/[a-z]/.test(password)) {
            suggestions.lowercase.className = 'valid';
        } else {
            suggestions.lowercase.className = 'error';
            valid = false;
        }

        if (/[0-9]/.test(password)) {
            suggestions.number.className = 'valid';
        } else {
            suggestions.number.className = 'error';
            valid = false;
        }

        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            suggestions.symbol.className = 'valid';
        } else {
            suggestions.symbol.className = 'error';
            valid = false;
        }

        if (valid) {
            passwordHelp.textContent = 'Password is strong.';
            passwordHelp.className = 'valid';
        } else {
            passwordHelp.textContent = 'Password must include the above requirements.';
            passwordHelp.className = 'error';
        }
    }

    function matchPassword() {
        const password = passwordInput.value;
        const confirmPassword = passwordConfirmInput.value;

        if (password === confirmPassword) {
            passwordMatchHelp.textContent = 'Passwords match.';
            passwordMatchHelp.className = 'valid';
        } else {
            passwordMatchHelp.textContent = 'Passwords do not match.';
            passwordMatchHelp.className = 'error';
        }
    }
</script>

@endsection
