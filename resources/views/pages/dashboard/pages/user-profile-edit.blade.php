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
                <div class="inn">
                    <div class="rhs">
                        <div class="form-login">
                            <form method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data">
                                @csrf

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
                                            name="name" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="lb">Email:</label>
                                        <input type="email" value="{{ $user->email }}" class="form-control" id="email"
                                            placeholder="Enter email" name="email" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="lb">Phone:</label>
                                        <input type="number" value="{{ $user->phone }}" class="form-control" id="phone"
                                            placeholder="Enter phone number" name="phone" disabled>
                                    </div>


                                    <div class="form-group">
                                        <label class="lb">Gender:</label>
                                        <input type="text" value="{{ $user->gender }}" class="form-control" id="gender"
                                            placeholder="{{ $user->gender }}" name="gender" disabled>
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
    <input class="@if($errors->has('imagepath')) is-invalid @endif" type="file" id="profile_image" onchange="previewImage(event)" name="profile_image" accept="image/*" required>
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
        <img id="preview_image" src="{{ url($profile->profile_image) }}" alt="{{$user->name}}" class="profile-image">
    @endif
</div>

                                    </div>

                                </div>
                                <!--END PROFILE BIO-->

                                <!-- Date of Birth -->


                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="lb">Date of Birth:</label>
                                        <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') }}">
                                        @error('dob')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="lb">{{ $user->name }}, your Age is:</label>
                                        <input type="text" class="form-control" id="age" placeholder="Your age" value="{{ $profile->age }}" readonly name="age">
                                    </div>
                                </div>



                                <!-- Religion -->


                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="lb">Religion:</label>
                                    <select class="form-select" name="religion">
                                        <option hidden="" value="">Select Religion</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Muslim - All">Muslim - All</option>
                                        <option value="Muslim - Shia">Muslim - Shia</option>
                                        <option value="Muslim - Sunni">Muslim - Sunni</option>
                                        <option value="Muslim - Others">Muslim - Others</option>
                                        <option value="Christian">Christian</option>
                                        <option value="Sikh">Sikh</option>
                                        <option value="Jain - All">Jain - All</option>
                                        <option value="Jain - Digambar">Jain - Digambar</option>
                                        <option value="Jain - Shwetambar">Jain - Shwetambar</option>
                                        <option value="Jain - Others">Jain - Others</option>
                                        <option value="Parsi">Parsi</option>
                                        <option value="Buddhist">Buddhist</option>
                                        <option value="Jewish">Jewish</option>
                                        <option value="Inter-Religion">Inter-Religion</option>
                                        <option value="No Religious Belief">No Religious Belief</option>
                                    </select>
                                    @error('religion')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="lb">Mother Tongue:</label>

                                    <select class="form-select" value="{{ old('mother_tongue') }}" name="mother_tongue">
                                        <option value="">Select Mother Tongue</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="Bengali">Bengali</option>
                                        <option value="Telugu">Telugu</option>
                                        <option value="Marathi">Marathi</option>
                                        <option value="Tamil">Tamil</option>
                                        <option value="Urdu">Urdu</option>
                                        <option value="Gujarati">Gujarati</option>
                                        <option value="Kannada">Kannada</option>
                                        <option value="Odia">Odia</option>
                                        <option value="Punjabi">Punjabi</option>
                                        <option value="Malayalam">Malayalam</option>
                                        <option value="Assamese">Assamese</option>
                                        <option value="Sanskrit">Sanskrit</option>
                                        <option value="Konkani">Konkani</option>
                                        <option value="Manipuri">Manipuri</option>
                                        <option value="Nepali">Nepali</option>
                                        <option value="Sindhi">Sindhi</option>
                                        <option value="Dogri">Dogri</option>
                                        <option value="Kashmiri">Kashmiri</option>
                                        <option value="Bodo">Bodo</option>
                                        <option value="Santhali">Santhali</option>
                                        <option value="Maithili">Maithili</option>
                                        <option value="Santali">Santali</option>
                                        <option value="Kokborok">Kokborok</option>
                                        <option value="Khasi">Khasi</option>
                                        <option value="Garo">Garo</option>
                                        <option value="Mizo">Mizo</option>
                                    </select>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="lb">Select Height:</label>
                                        <select class="form-select" name="height">
                                            <option value="">Select Height</option>
                                            <option value="4ft 6in">4ft 6in</option>
                                            <option value="4ft 7in">4ft 7in</option>
                                            <option value="4ft 8in">4ft 8in</option>
                                            <option value="4ft 9in">4ft 9in</option>
                                            <option value="4ft 10in">4ft 10in</option>
                                            <option value="4ft 11in">4ft 11in</option>
                                            <option value="5ft 0in">5ft 0in</option>
                                            <option value="5ft 1in">5ft 1in</option>
                                            <option value="5ft 2in">5ft 2in</option>
                                            <option value="5ft 3in">5ft 3in</option>
                                            <option value="5ft 4in">5ft 4in</option>
                                            <option value="5ft 5in">5ft 5in</option>
                                            <option value="5ft 6in">5ft 6in</option>
                                            <option value="5ft 7in">5ft 7in</option>
                                            <option value="5ft 8in">5ft 8in</option>
                                            <option value="5ft 9in">5ft 9in</option>
                                            <option value="5ft 10in">5ft 10in</option>
                                            <option value="5ft 11in">5ft 11in</option>
                                            <option value="6ft 0in">6ft 0in</option>
                                            <option value="6ft 1in">6ft 1in</option>
                                            <option value="6ft 2in">6ft 2in</option>
                                            <option value="6ft 3in">6ft 3in</option>
                                            <option value="6ft 4in">6ft 4in</option>
                                            <option value="6ft 5in">6ft 5in</option>
                                            <option value="6ft 6in">6ft 6in</option>
                                            <option value="6ft 7in">6ft 7in</option>
                                            <option value="6ft 8in">6ft 8in</option>
                                            <option value="6ft 9in">6ft 9in</option>
                                            <option value="6ft 10in">6ft 10in</option>
                                            <option value="6ft 11in">6ft 11in</option>
                                            <option value="7ft 0in">7ft</option>
                                        </select>

                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label class="lb">Marital Status:</label>
                                        <select class="form-select" name="marital_status">
                                            <option value="">Select Marital Status</option>
                                            <option value="Never Married">Never Married</option>
                                            <option value="Widowed">Widowed</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Awaiting Divorce">Awaiting Divorce</option>
                                        </select>

                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="lb">Any Disability:</label>
                                        <select class="form-select" name="disability">
                                            <option value="">Select</option>
                                            <option value="None" @if(old('disability') == 'None') selected @endif>None</option>
                                            <option value="Physically Challenged" @if(old('disability') == 'Physically Challenged') selected @endif>Physically Challenged</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="lb">Family Status:</label>
                                        <select class="form-select" name="family_status">
                                            <option value="">Select Family Status</option>
                                            <option value="Middle Class">Middle Class</option>
                                            <option value="High Class">High Class</option>
                                            <option value="Upper Middle Class">Upper Middle Class</option>
                                            <option value="Rich / Affluent">Rich / Affluent</option>
                                        </select>

                                    </div>
                                </div>





                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="lb">Family Type:</label>
                                        <select class="form-select" name="family_type">
                                            <option value="">Select Family Type</option>
                                            <option value="Joint">Joint</option>
                                            <option value="Nuclear">Nuclear</option>
                                        </select>

                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="lb">Family Status:</label>
                                        <select class="form-select" name="family_value">
                                            <option value="">Select Family Value</option>
                                            <option value="Orthodox">Orthodox</option>
                                            <option value="Moderate">Moderate</option>
                                            <option value="Traditional">Traditional</option>
                                            <option value="Liberal">Liberal</option>
                                        </select>


                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <!-- Education -->
                                        <label class="lb">Education:</label>
                                        <input type="text" class="form-control" name="education" value="{{ old('education') }}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <!-- Employed In -->
                                        <label class="lb">Employed In:</label>
                                        <select class="form-select" name="employed_in">
                                            <option value="">Select Employed In</option>
                                            <option value="Private">Private</option>
                                            <option value="Government">Government</option>
                                            <option value="Business">Business</option>
                                            <option value="Self Employed">Self Employed</option>
                                            <option value="Not Working">Not Working</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <!-- Occupation -->
                                        <label class="lb">Occupation:</label>
                                        <input type="text" class="form-control" name="occupation" value="{{ old('occupation') }}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <!-- Annual Income -->
                                        <label class="lb">Annual Income:</label>
                                        <input type="text" class="form-control" name="annual_income" value="{{ old('annual_income') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <!-- Work Location -->
                                        <label class="lb">Work Location:</label>
                                        <input type="text" class="form-control" name="work_location" value="{{ old('work_location') }}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <!-- Residing State -->
                                        <label class="lb">Residing State:</label>
                                        <input type="text" class="form-control" name="residing_state" value="{{ old('residing_state') }}">
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
</section>


@endsection
