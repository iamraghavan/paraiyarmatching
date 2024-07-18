@extends('layouts.app')

@section('content')

<section>
    <div class="login">
        <div class="container">
            <div class="row">

                <div class="inn">
                    <div class="lhs">
                        <div class="tit">
                            <h2>Enter your Registed Email to Reset your Password.</h2>
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
                                <h1>Recover Your Matrimony Account</h1>
                                <p>Remember your password? <a href="{{url('/app/login')}}">Sign in now</a></p>
                            </div>

                            @if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

                            <div class="form-login">
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>



@endsection
