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
                            <img src="images/login-couple.png" alt="">
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
                                        <label class="lb" for="password">Password:</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter password" name="password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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


                                    <div class="form-group">
                                        <x-turnstile
                                        data-action="login"
                                        data-cdata="sessionid-123456789"
                                        data-callback="callback"
                                        data-expired-callback="expiredCallback"
                                        data-error-callback="errorCallback"
                                        data-theme="light"
                                        data-tabindex="1"
                                    />
                                    </div>

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

@endsection
