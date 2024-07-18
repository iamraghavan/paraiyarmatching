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
    <div class="login">
        <div class="container">
            <div class="row">

                <div class="inn">
                    <div class="lhs">
                        <div class="tit">
                            <h2>Now <b>Find <br> your life partner</b> Easy and fast.</h2>
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
                                <h1>Sign in to Matrimony</h1>
                                <p>Not a member? <a href="{{url('/app/register')}}">Sign up now</a></p>
                            </div>
                            @if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

                            <div class="form-login">
                                <form method="POST" action="{{ route('verify_login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="lb">Email:</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="lb">Password:</label>
                                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
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


                                    <div class="form-group form-check">
                                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                                    </div>



                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-primary">Sign in</button>
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
