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
                        <div class="db-nav-pro">

                            @if(empty($profile) || empty($profile->profile_image))
                            @if($user->gender === 'male')
                                <img id="" src="https://cdn-icons-png.freepik.com/512/11195/11195340.png" alt="Male Profile Image" class="default-profile-image">
                            @elseif($user->gender === 'female')
                                <img id="" src="https://cdn-icons-png.freepik.com/512/13979/13979770.png" alt="Female Profile Image" class="default-profile-image">
                            @endif
                        @else
                            <img id="" src="{{ url($profile->profile_image) }}" alt="{{$user->name}}" class="" >
                        @endif


                        </div>
                        <div class="db-nav-list">
                            <ul>
                                <li><a href="{{url('/app/profile/dashboard')}}" class="act"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a></li>

                                <li><a href="{{url('/app/gallery/upload')}}"><i class="fa fa-upload" aria-hidden="true"></i>Upload Gallery</a></li>
                                <li><a href="{{url('/app/horoscope/upload')}}"><i class="fa fa-upload" aria-hidden="true"></i>Upload Horoscope</a></li>
                                <li><a href="{{url('/app/f/'. $user->pmid .'/membership-plan')}}"><i class="fa fa-money" aria-hidden="true"></i>Plan</a></li>
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
                                        <textarea class="form-control @error('bio') is-invalid @enderror" placeholder="Enter your Bio"
                                            name="bio" required>{{ old('bio', $profile->my_bio ?? '') }}</textarea>
                                        @error('bio')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>



                                    <div class="row mb-3">
                                        <div class="col-md-6 form-group">
                                            <label for="raasi" class="form-label">Raasi:</label>
                                            <select class="form-select" id="raasi" name="raasi" onchange="populateStars(this)">
                                                <option value="">Select Raasi</option>
                                                <option value="Mesham" {{ old('raasi', optional($profile)->raasi) === 'Mesham' ? 'selected' : '' }}>மேஷம் (Mesham)</option>
                                                <option value="Rishabam" {{ old('raasi', optional($profile)->raasi) === 'Rishabam' ? 'selected' : '' }}>ரிஷபம் (Rishabam)</option>
                                                <option value="Midhunam" {{ old('raasi', optional($profile)->raasi) === 'Midhunam' ? 'selected' : '' }}>மிதுனம் (Midhunam)</option>
                                                <option value="Kadagam" {{ old('raasi', optional($profile)->raasi) === 'Kadagam' ? 'selected' : '' }}>கடகம் (Kadagam)</option>
                                                <option value="Simham" {{ old('raasi', optional($profile)->raasi) === 'Simham' ? 'selected' : '' }}>சிம்மம் (Simham)</option>
                                                <option value="Kanni" {{ old('raasi', optional($profile)->raasi) === 'Kanni' ? 'selected' : '' }}>கன்னி (Kanni)</option>
                                                <option value="Thulam" {{ old('raasi', optional($profile)->raasi) === 'Thulam' ? 'selected' : '' }}>துலாம் (Thulam)</option>
                                                <option value="Viruchigam" {{ old('raasi', optional($profile)->raasi) === 'Viruchigam' ? 'selected' : '' }}>விருச்சிகம் (Viruchigam)</option>
                                                <option value="Dhanusu" {{ old('raasi', optional($profile)->raasi) === 'Dhanusu' ? 'selected' : '' }}>தனுசு (Dhanusu)</option>
                                                <option value="Magaram" {{ old('raasi', optional($profile)->raasi) === 'Magaram' ? 'selected' : '' }}>மகரம் (Magaram)</option>
                                                <option value="Kumbam" {{ old('raasi', optional($profile)->raasi) === 'Kumbam' ? 'selected' : '' }}>கும்பம் (Kumbam)</option>
                                                <option value="Meenam" {{ old('raasi', optional($profile)->raasi) === 'Meenam' ? 'selected' : '' }}>மீனம் (Meenam)</option>
                                            </select>
                                            @error('raasi')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6 form-group">
                                            <label for="star" class="form-label">Star:</label>
                                            <select class="form-select" id="star" name="star">
                                                <option value="">Select Star</option>
                                                <!-- Star options will be dynamically populated based on the selected Raasi -->
                                            </select>
                                            @error('star')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-md-6 form-group">
                                            <label for="diet">Diet Preference</label>
                                            <div>
                                                <label class="diet-option">
                                                    <input type="radio" name="diet" value="vegetarian" {{ old('diet', $profile->diet) == 'vegetarian' ? 'checked' : '' }}>
                                                    <i class="fa fa-leaf" aria-hidden="true"></i> Vegetarian
                                                </label>
                                                <label class="diet-option">
                                                    <input type="radio" name="diet" value="non_vegetarian" {{ old('diet', $profile->diet) == 'non_vegetarian' ? 'checked' : '' }}>
                                                    <i class="fa fa-drumstick-bite" aria-hidden="true"></i> Non-Vegetarian
                                                </label>
                                                <label class="diet-option">
                                                    <input type="radio" name="diet" value="vegan" {{ old('diet', $profile->diet) == 'vegan' ? 'checked' : '' }}>
                                                    <i class="fa fa-carrot" aria-hidden="true"></i> Vegan
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <script>
                                        // Function to populate stars based on selected Raasi
                                        function populateStars(raasiSelect) {
                                            var raasi = raasiSelect.value;
                                            var starSelect = document.getElementById("star");
                                            // Clear existing options
                                            starSelect.innerHTML = '<option value="">Select Star</option>';

                                            // Define star options based on Raasi
                                            var starOptions = [];
                                            switch (raasi) {
                                                case "Mesham":
                                                    starOptions = ["Asvini அஸ்வினி", "Baraṇi பரணி", "Kārthigai கார்த்திகை"];
                                                    break;
                                                case "Rishabam":
                                                    starOptions = ["Kārthigai 2-ஆம் பாதம் கிருத்திகை", "Rōgiṇi ரோகிணி", "Mirugasīriḍam 2-ஆம் பாதம் மிருகசீரிடம்"];
                                                    break;
                                                case "Midhunam":
                                                    starOptions = ["Mirugasīriḍam 3-ஆம் பாதம் மிருகசீரிடம்", "Tiruvādirai திருவாதிரை", "Puṉarpūsam 3-ஆம் பாதம் புனர்பூசம்"];
                                                    break;
                                                case "Kadagam":
                                                    starOptions = ["Puṉarpūsam 4-ஆம் பாதம் புனர்பூசம்", "Pūsam பூசம்", "Āyilyam ஆயில்யம்"];
                                                    break;
                                                case "Simham":
                                                    starOptions = ["Magam மகம்", "Pūram பூரம்", "Uttiram 1-ஆம் பாதம் உத்திரம்"];
                                                    break;
                                                case "Kanni":
                                                    starOptions = ["Uttiram 2-ஆம் பாதம் உத்திரம்", "Asttam அஸ்தம்", "Cittirai 2-ஆம் பாதம் சித்திரை"];
                                                    break;
                                                case "Thulam":
                                                    starOptions = ["Cittirai 3-ஆம் பாதம் சித்திரை", "Suvāti சுவாதி", "Visākam 3-ஆம் பாதம் விசாகம்"];
                                                    break;
                                                case "Viruchigam":
                                                    starOptions = ["Visākam 4-ஆம் பாதம் விசாகம்", "Anusham அனுஷம்", "Kēṭṭai கேட்டை"];
                                                    break;
                                                case "Dhanusu":
                                                    starOptions = ["Mūlam மூலம்", "Pūrāṭam பூராடம்", "Uttirāṭam 1-ஆம் பாதம் உத்திராடம்"];
                                                    break;
                                                case "Magaram":
                                                    starOptions = ["Uttirāṭam 2-ஆம் பாதம் உத்திராடம்", "Tiruvōnam திருவோணம்", "Aviṭṭam 2-ஆம் பாதம் அவிட்டம்"];
                                                    break;
                                                case "Kumbam":
                                                    starOptions = ["Aviṭṭam 3-ஆம் பாதம் அவிட்டம்", "Sadayam சதயம்", "Pūraṭṭādi 3-ஆம் பாதம் பூரட்டாதி"];
                                                    break;
                                                case "Meenam":
                                                    starOptions = ["Pūraṭṭādi 4-ஆம் பாதம் பூரட்டாதி", "Uttiraṭṭādi உத்திரட்டாதி", "Rēvati ரேவதி"];
                                                    break;
                                            }

                                            // Populate the star select options
                                            starOptions.forEach(function(star) {
                                                var option = document.createElement("option");
                                                option.value = star.split(' ')[0]; // Extracting star name without Tamil translation
                                                option.textContent = star;
                                                if (option.value === "{{ old('star', optional($profile)->star) }}") {
                                                    option.selected = true;
                                                }
                                                starSelect.appendChild(option);
                                            });
                                        }

                                        // Populate stars on page load if there is a selected Raasi
                                        window.onload = function() {
                                            var raasiSelect = document.getElementById("raasi");
                                            if (raasiSelect.value !== "") {
                                                populateStars(raasiSelect);
                                            }
                                        };
                                    </script>



                                    <div class="row mb-3">
                                        <div class="col-md-6 form-group">
                                            <label for="dosham" class="form-label">Dosham:</label>
                                            <select class="form-select" id="dosham" name="dosham">
                                                <option value="">Select Dosham</option>
                                                <option value="No Dosham" {{ old('dosham', optional($profile)->dosham) === 'No Dosham' ? 'selected' : '' }}>No Dosham</option>
                                                <option value="Chevvai Dosham" {{ old('dosham', optional($profile)->dosham) === 'Chevvai Dosham' ? 'selected' : '' }}>Chevvai Dosham</option>
                                                <option value="Rahu Dosham" {{ old('dosham', optional($profile)->dosham) === 'Rahu Dosham' ? 'selected' : '' }}>Rahu Dosham</option>
                                                <option value="Kethu Dosham" {{ old('dosham', optional($profile)->dosham) === 'Kethu Dosham' ? 'selected' : '' }}>Kethu Dosham</option>
                                                <option value="Sarpa Dosham" {{ old('dosham', optional($profile)->dosham) === 'Sarpa Dosham' ? 'selected' : '' }}>Sarpa Dosham</option>
                                                <option value="Kalathra Dosham" {{ old('dosham', optional($profile)->dosham) === 'Kalathra Dosham' ? 'selected' : '' }}>Kalathra Dosham</option>
                                                <option value="Naga Dosham" {{ old('dosham', optional($profile)->dosham) === 'Naga Dosham' ? 'selected' : '' }}>Naga Dosham</option>
                                                <option value="Manglik Dosham" {{ old('dosham', optional($profile)->dosham) === 'Manglik Dosham' ? 'selected' : '' }}>Manglik Dosham</option>
                                                <option value="Pitru Dosham" {{ old('dosham', optional($profile)->dosham) === 'Pitru Dosham' ? 'selected' : '' }}>Pitru Dosham</option>
                                                <option value="Graha Dosham" {{ old('dosham', optional($profile)->dosham) === 'Graha Dosham' ? 'selected' : '' }}>Graha Dosham</option>
                                                <option value="Shani Dosham" {{ old('dosham', optional($profile)->dosham) === 'Shani Dosham' ? 'selected' : '' }}>Shani Dosham</option>
                                                <option value="Kuja Dosham" {{ old('dosham', optional($profile)->dosham) === 'Kuja Dosham' ? 'selected' : '' }}>Kuja Dosham</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                            @error('dosham')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                    @php
                                    $siblings = json_decode($profile->siblings ?? '[]', true);
                                @endphp

                                <div class="row mb-3">
                                    <div class="col-md-6 form-group">
                                        <label for="number_of_siblings">Number of Siblings:</label>
                                        <input type="number" id="number_of_siblings" name="number_of_siblings" min="0" class="form-control" value="{{ old('number_of_siblings', count($siblings)) }}">
                                    </div>
                                </div>
                                <div id="siblings_container" class="row">
                                    @foreach($siblings as $index => $sibling)
                                        <div class="col-md-6 mb-3 form-group">
                                            <label for="sibling_name_{{ $index }}">Sibling Name:</label>
                                            <input type="text" id="sibling_name_{{ $index }}" name="siblings[{{ $index }}][name]" class="form-control" value="{{ old('siblings.'.$index.'.name', $sibling['name']) }}">
                                        </div>
                                        <div class="col-md-6 mb-3 form-group">
                                            <label for="sibling_married_{{ $index }}">Married:</label>
                                            <select id="sibling_married_{{ $index }}" name="siblings[{{ $index }}][married]" class="form-control">
                                                <option value="1" {{ old('siblings.'.$index.'.married', $sibling['married']) == 1 ? 'selected' : '' }}>Yes</option>
                                                <option value="0" {{ old('siblings.'.$index.'.married', $sibling['married']) == 0 ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    @endforeach
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script>
    $(document).ready(function() {
        const initialSiblings = @json($siblings);
        renderSiblings(initialSiblings.length);

        $('#number_of_siblings').on('input', function() {
            const numSiblings = $(this).val();
            renderSiblings(numSiblings);
        });

        function renderSiblings(numSiblings) {
            $('#siblings_container').empty();
            for (let i = 0; i < numSiblings; i++) {
                const sibling = initialSiblings[i] || { name: '', married: '' };
                const siblingDiv = `
                    <div class="col-md-6 mb-3 form-group">
                        <label for="sibling_name_${i}">Sibling Name:</label>
                        <input type="text" id="sibling_name_${i}" name="siblings[${i}][name]" class="form-control" value="${sibling.name}">
                    </div>
                    <div class="col-md-6 mb-3 form-group">
                        <label for="sibling_married_${i}">Married:</label>
                        <select id="sibling_married_${i}" name="siblings[${i}][married]" class="form-control">
                            <option value="1" ${sibling.married == 1 ? 'selected' : ''}>Yes</option>
                            <option value="0" ${sibling.married == 0 ? 'selected' : ''}>No</option>
                        </select>
                    </div>
                `;
                $('#siblings_container').append(siblingDiv);
            }
        }
    });
</script>
<style>
    .diet-option {
        display: flex;
        align-items: center;
        margin-right: 15px;
        cursor: pointer;
    }

    .diet-option i {
        margin-right: 5px;
        font-size: 1.5em;
        color: #6c757d;
    }

    .diet-option input[type="radio"] {
        display: none; /* Hide the default radio button */
    }

    .diet-option input[type="radio"]:checked + i {
        color: #007bff; /* Change color when the radio button is checked */
    }
    </style>
@endsection
