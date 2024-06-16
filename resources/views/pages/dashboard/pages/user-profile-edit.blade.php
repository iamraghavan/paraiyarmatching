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
                            <form method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data">
                                @csrf
    @method('PUT')

    <input type="hidden" value="{{ $user->pmid }}" name="user_pmid">

                                 <!--PROFILE BIO-->
                                 <div class="edit-pro-parti">
                                    <div class="form-tit">
                                        <h4>{{ $user->pmid }}</h4>
                                        <h1>Profile / Update</h1>
                                    </div>
                                    <div class="form-group">
                                        <label class="lb">Name:</label>
                                        <input type="text" value="{{ $user->name }}" class="form-control" placeholder="Enter your full name"
                                            name="name" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="lb">Email:</label>
                                        <input type="email" value="{{ $user->email }}" class="form-control" id="email"
                                            placeholder="Enter email" name="email" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="lb">Phone:</label>
                                        <input type="number" value="{{ $user->phone }}" class="form-control" id="phone"
                                            placeholder="Enter phone number" name="phone" readonly>
                                    </div>


                                    <div class="form-group">
                                        <label class="lb">Gender:</label>
                                        <input type="text" value="{{ $user->gender }}" class="form-control" id="gender"
                                            placeholder="{{ $user->gender }}" name="gender" readonly>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="lb">Upload Profile Picture:</label>

                                            <!-- <input type="file"
                                            class="custom-file-input form-control @if($errors->has('imagepath')) is-invalid @endif"
                                            id="profile_image"
                                            name="profile_image"
                                            accept="image/*"
                                            onchange="previewImage(event)"> -->



<label for="images" class="drop-container">
    <span class="drop-title">Drop files here</span> or
    <input class="@if($errors->has('imagepath')) is-invalid @endif" type="file" id="profile_image" onchange="previewImage(event)" name="profile_image" accept="image/*">
</label>


@error('profile_image')
    <span class="text-danger">{{ $message }}</span>
@enderror


                                        </div>
                                        <div class="profile-image-container col-md-6">
    @if(empty($profile->profile_image))
        @if($user->gender === 'male')
            <img id="preview_image" src="https://cdn-icons-png.freepik.com/512/11195/11195340.png" alt="Male Profile Image" class="default-profile-image">
        @elseif($user->gender === 'female')
            <img id="preview_image" src="https://cdn-icons-png.freepik.com/512/13979/13979770.png" alt="Female Profile Image" class="default-profile-image">
        @endif
    @else
        <img id="preview_image" src="{{ url($profile->profile_image) }}" alt="{{$user->name}}" class="" >
    @endif
</div>

                                    </div>

                                </div>
                                <!--END PROFILE BIO-->

                                <!-- Date of Birth -->


                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="lb">Date of Birth:</label>
                                        <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', optional($profile)->dob ?? '') }}">
                                        @error('dob')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="lb">{{ $user->name }}, your Age is:</label>
                                        <input type="text" class="form-control" id="age" placeholder="Your age" value="{{ old('dob', optional($profile)->age ?? '') }}" readonly name="age">
                                    </div>
                                </div>



                                <!-- Religion -->

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="lb">Religion:</label>
                                       <select class="form-select" name="religion">
    <option hidden>Select Religion</option>
    <option value="Hindu" {{ old('religion', optional($profile)->religion) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
    <option value="Muslim - All" {{ old('religion', optional($profile)->religion) == 'Muslim - All' ? 'selected' : '' }}>Muslim - All</option>
    <option value="Muslim - Shia" {{ old('religion', optional($profile)->religion) == 'Muslim - Shia' ? 'selected' : '' }}>Muslim - Shia</option>
    <option value="Muslim - Sunni" {{ old('religion', optional($profile)->religion) == 'Muslim - Sunni' ? 'selected' : '' }}>Muslim - Sunni</option>
    <option value="Muslim - Others" {{ old('religion', optional($profile)->religion) == 'Muslim - Others' ? 'selected' : '' }}>Muslim - Others</option>
    <option value="Christian" {{ old('religion', optional($profile)->religion) == 'Christian' ? 'selected' : '' }}>Christian</option>
    <option value="Sikh" {{ old('religion', optional($profile)->religion) == 'Sikh' ? 'selected' : '' }}>Sikh</option>
    <option value="Jain - All" {{ old('religion', optional($profile)->religion) == 'Jain - All' ? 'selected' : '' }}>Jain - All</option>
    <option value="Jain - Digambar" {{ old('religion', optional($profile)->religion) == 'Jain - Digambar' ? 'selected' : '' }}>Jain - Digambar</option>
    <option value="Jain - Shwetambar" {{ old('religion', optional($profile)->religion) == 'Jain - Shwetambar' ? 'selected' : '' }}>Jain - Shwetambar</option>
    <option value="Jain - Others" {{ old('religion', optional($profile)->religion) == 'Jain - Others' ? 'selected' : '' }}>Jain - Others</option>
    <option value="Parsi" {{ old('religion', optional($profile)->religion) == 'Parsi' ? 'selected' : '' }}>Parsi</option>
    <option value="Buddhist" {{ old('religion', optional($profile)->religion) == 'Buddhist' ? 'selected' : '' }}>Buddhist</option>
    <option value="Jewish" {{ old('religion', optional($profile)->religion) == 'Jewish' ? 'selected' : '' }}>Jewish</option>
    <option value="Inter-Religion" {{ old('religion', optional($profile)->religion) == 'Inter-Religion' ? 'selected' : '' }}>Inter-Religion</option>
    <option value="No Religious Belief" {{ old('religion', optional($profile)->religion) == 'No Religious Belief' ? 'selected' : '' }}>No Religious Belief</option>
</select>


                                    @error('religion')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>




                                    <div class="col-md-6 form-group">
                                        <label class="lb">Mother Tongue:</label>

                                        <select class="form-select" name="mother_tongue">
    <option value="">Select Mother Tongue</option>
    <option value="Hindi" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Hindi' ? 'selected' : '' }}>Hindi</option>
    <option value="Bengali" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Bengali' ? 'selected' : '' }}>Bengali</option>
    <option value="Telugu" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Telugu' ? 'selected' : '' }}>Telugu</option>
    <option value="Marathi" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Marathi' ? 'selected' : '' }}>Marathi</option>
    <option value="Tamil" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Tamil' ? 'selected' : '' }}>Tamil</option>
    <option value="Urdu" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Urdu' ? 'selected' : '' }}>Urdu</option>
    <option value="Gujarati" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Gujarati' ? 'selected' : '' }}>Gujarati</option>
    <option value="Kannada" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Kannada' ? 'selected' : '' }}>Kannada</option>
    <option value="Odia" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Odia' ? 'selected' : '' }}>Odia</option>
    <option value="Punjabi" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Punjabi' ? 'selected' : '' }}>Punjabi</option>
    <option value="Malayalam" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Malayalam' ? 'selected' : '' }}>Malayalam</option>
    <option value="Assamese" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Assamese' ? 'selected' : '' }}>Assamese</option>
    <option value="Sanskrit" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Sanskrit' ? 'selected' : '' }}>Sanskrit</option>
    <option value="Konkani" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Konkani' ? 'selected' : '' }}>Konkani</option>
    <option value="Manipuri" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Manipuri' ? 'selected' : '' }}>Manipuri</option>
    <option value="Nepali" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Nepali' ? 'selected' : '' }}>Nepali</option>
    <option value="Sindhi" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Sindhi' ? 'selected' : '' }}>Sindhi</option>
    <option value="Dogri" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Dogri' ? 'selected' : '' }}>Dogri</option>
    <option value="Kashmiri" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Kashmiri' ? 'selected' : '' }}>Kashmiri</option>
    <option value="Bodo" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Bodo' ? 'selected' : '' }}>Bodo</option>
    <option value="Santhali" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Santhali' ? 'selected' : '' }}>Santhali</option>
    <option value="Maithili" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Maithili' ? 'selected' : '' }}>Maithili</option>
    <option value="Santali" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Santali' ? 'selected' : '' }}>Santali</option>
    <option value="Kokborok" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Kokborok' ? 'selected' : '' }}>Kokborok</option>
    <option value="Khasi" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Khasi' ? 'selected' : '' }}>Khasi</option>
    <option value="Garo" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Garo' ? 'selected' : '' }}>Garo</option>
    <option value="Mizo" {{ old('mother_tongue', optional($profile)->mother_tongue) == 'Mizo' ? 'selected' : '' }}>Mizo</option>
</select>

                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="lb">Select Height:</label>
                                       <select class="form-select" name="height">
    <option value="">Select Height</option>
    <option value="4ft 6in" {{ old('height', optional($profile)->height) == '4ft 6in' ? 'selected' : '' }}>4ft 6in</option>
    <option value="4ft 7in" {{ old('height', optional($profile)->height) == '4ft 7in' ? 'selected' : '' }}>4ft 7in</option>
    <option value="4ft 8in" {{ old('height', optional($profile)->height) == '4ft 8in' ? 'selected' : '' }}>4ft 8in</option>
    <option value="4ft 9in" {{ old('height', optional($profile)->height) == '4ft 9in' ? 'selected' : '' }}>4ft 9in</option>
    <option value="4ft 10in" {{ old('height', optional($profile)->height) == '4ft 10in' ? 'selected' : '' }}>4ft 10in</option>
    <option value="4ft 11in" {{ old('height', optional($profile)->height) == '4ft 11in' ? 'selected' : '' }}>4ft 11in</option>
    <option value="5ft 0in" {{ old('height', optional($profile)->height) == '5ft 0in' ? 'selected' : '' }}>5ft 0in</option>
    <option value="5ft 1in" {{ old('height', optional($profile)->height) == '5ft 1in' ? 'selected' : '' }}>5ft 1in</option>
    <option value="5ft 2in" {{ old('height', optional($profile)->height) == '5ft 2in' ? 'selected' : '' }}>5ft 2in</option>
    <option value="5ft 3in" {{ old('height', optional($profile)->height) == '5ft 3in' ? 'selected' : '' }}>5ft 3in</option>
    <option value="5ft 4in" {{ old('height', optional($profile)->height) == '5ft 4in' ? 'selected' : '' }}>5ft 4in</option>
    <option value="5ft 5in" {{ old('height', optional($profile)->height) == '5ft 5in' ? 'selected' : '' }}>5ft 5in</option>
    <option value="5ft 6in" {{ old('height', optional($profile)->height) == '5ft 6in' ? 'selected' : '' }}>5ft 6in</option>
    <option value="5ft 7in" {{ old('height', optional($profile)->height) == '5ft 7in' ? 'selected' : '' }}>5ft 7in</option>
    <option value="5ft 8in" {{ old('height', optional($profile)->height) == '5ft 8in' ? 'selected' : '' }}>5ft 8in</option>
    <option value="5ft 9in" {{ old('height', optional($profile)->height) == '5ft 9in' ? 'selected' : '' }}>5ft 9in</option>
    <option value="5ft 10in" {{ old('height', optional($profile)->height) == '5ft 10in' ? 'selected' : '' }}>5ft 10in</option>
    <option value="5ft 11in" {{ old('height', optional($profile)->height) == '5ft 11in' ? 'selected' : '' }}>5ft 11in</option>
    <option value="6ft 0in" {{ old('height', optional($profile)->height) == '6ft 0in' ? 'selected' : '' }}>6ft 0in</option>
    <option value="6ft 1in" {{ old('height', optional($profile)->height) == '6ft 1in' ? 'selected' : '' }}>6ft 1in</option>
    <option value="6ft 2in" {{ old('height', optional($profile)->height) == '6ft 2in' ? 'selected' : '' }}>6ft 2in</option>
    <option value="6ft 3in" {{ old('height', optional($profile)->height) == '6ft 3in' ? 'selected' : '' }}>6ft 3in</option>
    <option value="6ft 4in" {{ old('height', optional($profile)->height) == '6ft 4in' ? 'selected' : '' }}>6ft 4in</option>
    <option value="6ft 5in" {{ old('height', optional($profile)->height) == '6ft 5in' ? 'selected' : '' }}>6ft 5in</option>
    <option value="6ft 6in" {{ old('height', optional($profile)->height) == '6ft 6in' ? 'selected' : '' }}>6ft 6in</option>
    <option value="6ft 7in" {{ old('height', optional($profile)->height) == '6ft 7in' ? 'selected' : '' }}>6ft 7in</option>
    <option value="6ft 8in" {{ old('height', optional($profile)->height) == '6ft 8in' ? 'selected' : '' }}>6ft 8in</option>
    <option value="6ft 9in" {{ old('height', optional($profile)->height) == '6ft 9in' ? 'selected' : '' }}>6ft 9in</option>
    <option value="6ft 10in" {{ old('height', optional($profile)->height) == '6ft 10in' ? 'selected' : '' }}>6ft 10in</option>
    <option value="6ft 11in" {{ old('height', optional($profile)->height) == '6ft 11in' ? 'selected' : '' }}>6ft 11in</option>
    <option value="7ft 0in" {{ old('height', optional($profile)->height) == '7ft 0in' ? 'selected' : '' }}>7ft</option>
</select>



                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label class="lb">Marital Status:</label>
                                      <select class="form-select" name="marital_status">
    <option value="" {{ optional($profile)->marital_status ? '' : 'selected' }}>Select Marital Status</option>
    <option value="Never Married" {{ optional($profile)->marital_status === 'Never Married' ? 'selected' : '' }}>Never Married</option>
    <option value="Widowed" {{ optional($profile)->marital_status === 'Widowed' ? 'selected' : '' }}>Widowed</option>
    <option value="Divorced" {{ optional($profile)->marital_status === 'Divorced' ? 'selected' : '' }}>Divorced</option>
    <option value="Awaiting Divorce" {{ optional($profile)->marital_status === 'Awaiting Divorce' ? 'selected' : '' }}>Awaiting Divorce</option>
</select>




                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="lb">Any Disability:</label>
<select class="form-select" name="disability">
    <option value="">Select</option>
    <option value="None" {{ optional($profile)->disability === 'None' ? 'selected' : '' }}>None</option>
    <option value="Physically Challenged" {{ optional($profile)->disability === 'Physically Challenged' ? 'selected' : '' }}>Physically Challenged</option>
</select>



                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="lb">Family Status:</label>
<select class="form-select" name="family_status">
    <option value="">Select Family Status</option>
    <option value="Middle Class" {{ optional($profile)->family_status === 'Middle Class' ? 'selected' : '' }}>Middle Class</option>
    <option value="High Class" {{ optional($profile)->family_status === 'High Class' ? 'selected' : '' }}>High Class</option>
    <option value="Upper Middle Class" {{ optional($profile)->family_status === 'Upper Middle Class' ? 'selected' : '' }}>Upper Middle Class</option>
    <option value="Rich / Affluent" {{ optional($profile)->family_status === 'Rich / Affluent' ? 'selected' : '' }}>Rich / Affluent</option>
</select>




                                    </div>
                                </div>





                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="lb">Family Type:</label>
  <select class="form-select" name="family_type">
    <option value="">Select Family Type</option>
    <option value="Joint Family" {{ optional($profile)->family_type === 'Joint Family' ? 'selected' : '' }}>Joint Family</option>
    <option value="Nuclear Family" {{ optional($profile)->family_type === 'Nuclear Family' ? 'selected' : '' }}>Nuclear Family</option>
</select>



                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="lb">Family Status:</label>
                                      <select class="form-select" name="family_value">
    <option value="">Select Family Value</option>
    <option value="Orthodox" {{ optional($profile)->family_value === 'Orthodox' ? 'selected' : '' }}>Orthodox</option>
    <option value="Moderate" {{ optional($profile)->family_value === 'Moderate' ? 'selected' : '' }}>Moderate</option>
    <option value="Traditional" {{ optional($profile)->family_value === 'Traditional' ? 'selected' : '' }}>Traditional</option>
    <option value="Liberal" {{ optional($profile)->family_value === 'Liberal' ? 'selected' : '' }}>Liberal</option>
</select>





                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <!-- Education -->
                                        <label class="lb">Education:</label>
                                        <input type="text" class="form-control" name="education" value="{{ old('education', optional($profile)->education ?? '') }}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <!-- Employed In -->
                                        <label class="lb">Employed In:</label>
                                       <select class="form-select" name="employed_in">
    <option value="">Select Employed In</option>
    <option value="Private" {{ optional($profile)->employed_in === 'Private' ? 'selected' : '' }}>Private</option>
    <option value="Government" {{ optional($profile)->employed_in === 'Government' ? 'selected' : '' }}>Government</option>
    <option value="Business" {{ optional($profile)->employed_in === 'Business' ? 'selected' : '' }}>Business</option>
    <option value="Self Employed" {{ optional($profile)->employed_in === 'Self Employed' ? 'selected' : '' }}>Self Employed</option>
    <option value="Not Working" {{ optional($profile)->employed_in === 'Not Working' ? 'selected' : '' }}>Not Working</option>
</select>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <!-- Occupation -->
                                        <label class="lb">Occupation:</label>
                                        <input type="text" class="form-control" name="occupation" value="{{ old('occupation', optional($profile)->occupation ?? '') }}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <!-- Annual Income -->
                                        <label class="lb">Annual Income:</label>
                                        <input type="text" class="form-control" name="annual_income" value="{{ old('annual_income', optional($profile)->annual_income ?? '') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <!-- Work Location -->
                                        <label class="lb">Work Location:</label>
                                        <input type="text" class="form-control" name="work_location" value="{{ old('work_location', optional($profile)->work_location ?? '') }}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <!-- Residing State -->
                                        <label class="lb">Residing State:</label>
                                        <input type="text" class="form-control" name="residing_state" value="{{ old('residing_state', optional($profile)->residing_state ?? '') }}">
                                    </div>
                                </div>





                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Submit</button>
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
