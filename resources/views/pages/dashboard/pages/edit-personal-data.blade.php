@extends('pages.dashboard.layouts.app')
@section('dashboard-content')

{{-- <div class="mt-80" style="margin: 40rem">
    Vanakam da maple {{ $user->pmid }}

</div>

--}}

<script>
  function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview_image');
            output.src = reader.result;
            output.style.display = 'block'; // Show the image preview
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<section>
    <div class="login pro-edit-update">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="db-nav">
                        <div class="db-nav-pro"><img src="{{url($profile->profile_image)}}" class="img-fluid" alt=""></div>
                        <div class="db-nav-list">
                            <ul>
                                <li><a href="{{url('/app/profile/dashboard')}}" class="act"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a></li>

                                <li><a href="{{url('/app/gallery/upload')}}"><i class="fa fa-upload" aria-hidden="true"></i>Upload Gallery</a></li>
                                <li><a href="{{url('/app/horoscope/upload')}}"><i class="fa fa-upload" aria-hidden="true"></i>Upload Horoscope</a></li>
                                <li><a href="{{url('/')}}"><i class="fa fa-money" aria-hidden="true"></i>Plan</a></li>
                                    @php
                                    function generateRandomString($length = 100) {
                                        return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', $length)), 0, $length);
                                    }

                                    $randomString = generateRandomString(); // Creates a long random alphanumeric string
                                    $salt = 'pmat'; // You can generate a more secure salt or use a constant
                                    $saltedString = $randomString . $salt;
                                    $hashedString = hash('sha256', $saltedString); // Hash the salted string using SHA-256
                                @endphp

                                <li>
                                    <a href="{{ url('/app/profile/user-profile-edit/' . $user->pmid . '/' . $hashedString) }}">
                                        <i class="fa fa-cog" aria-hidden="true"></i>Edit Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/app/profile/edit-personal-data/' . $user->pmid . '/' . $hashedString) }}">
                                        <i class="fa fa-cog" aria-hidden="true"></i>Edit Personal Data
                                    </a>
                                </li>


                                <li><a onclick="confirmLogout()"><i class="fa fa-sign-out" aria-hidden="true"></i>Log out</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="row">

                <div class="inn">
                    <div class="rhs">
                        <div class="form-login">
                            <form method="POST" action="{{ route('profile.bio') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" value="{{ $user->pmid }}" name="user_pmid">

                                <!-- PROFILE BIO -->
                                <div class="edit-pro-parti">
                                    <div class="form-tit">
                                        <h4>{{ $user->pmid }}</h4>
                                        <h1>Profile / Update</h1>
                                    </div>
                                    <div class="form-group">
                                        <label class="lb">Bio:</label>
                                        <textarea class="form-control @error('bio') is-invalid @enderror" placeholder="Enter your Bio (500 to 700 characters)"
                                            name="bio" required minlength="500" maxlength="700">{{ old('bio', $profile->my_bio ?? '') }}</textarea>
                                        @error('bio')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>





@endsection
