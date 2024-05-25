@extends('pages.dashboard.layouts.app')
@section('dashboard-content')

{{-- <div class="container mt-30">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Dashboard</h4>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Mobile Number:</strong> {{ $user->phone }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="profile-completion">
    Profile Completion: {{ $completionPercentage }}%
</div> --}}



<section>
    <div class="db">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="db-nav">
                        <div class="db-nav-pro"><img src="{{url($profile->profile_image)}}" class="img-fluid" alt=""></div>
                        <div class="db-nav-list">
                            <ul>
                                <li><a href="{{url('/app/profile/dashboard')}}" class="act"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a></li>
                                <li>
                                    @if(isset($ipInfo['error']))
                                    <p>Error fetching IP information: {{ $ipInfo['error'] }}</p>
                                @else
                                <p>{{ $ipInfo['timezone'] }} / {{ $ipInfo['country'] }} </p>

                                    @endif
                                </li>

                                <li><a href="{{url('/app/gallery/upload')}}"><i class="fa fa-upload" aria-hidden="true"></i>Upload Gallery</a></li>
                                <li><a href="{{url('/app/horoscope/upload')}}"><i class="fa fa-upload" aria-hidden="true"></i>Upload Horoscope</a></li>
                                <li><a href="{{ url('/app/profile/user-profile-edit/' . $user->pmid) }}"><i class="fa fa-cog" aria-hidden="true"></i>Edit Profile</a></li>
                                <li><a onclick="confirmLogout()"><i class="fa fa-sign-out" aria-hidden="true"></i>Log out</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="row">
                        <div class="col-md-12 db-sec-com">
                            <h2 class="db-tit">Profile settings</h2>
                            <div class="col7 fol-set-rhs">
                                <!-- Profile Section -->
                                <div class="ms-write-post fol-sett-sec sett-rhs-pro" style="">
                                    <div class="foll-set-tit fol-pro-abo-ico">
                                        <h5>{{ $user->pmid }}</h5>
                                    </div>
                                    <div class="fol-sett-box">
                                        <ul>
                                            <li>
                                                <div class="sett-lef">
                                                    <div class="auth-pro-sm sett-pro-wid">

                                                        <div class="auth-pro-sm-desc">
                                                            <h3 class="text-uppercase" >{{ $user->name }}</h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul>
                                                    <li>
                                                        <div class="sett-lef">
                                                            <div class="sett-rad-left">
                                                                <h5>Date of Birth</h5>
                                                                <p>{{ $profile->dob }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sett-lef">
                                                            <div class="sett-rad-left">
                                                                <h5>Age</h5>
                                                                <p>{{ $profile->age }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sett-lef">
                                                            <div class="sett-rad-left">
                                                                <h5>Height</h5>
                                                                <p>{{ $profile->height }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sett-lef">
                                                            <div class="sett-rad-left">
                                                                <h5>Religion</h5>
                                                                <p>{{ $profile->religion }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sett-lef">
                                                            <div class="sett-rad-left">
                                                                <h5>Mother Tongue</h5>
                                                                <p>{{ $profile->mother_tongue }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sett-lef">
                                                            <div class="sett-rad-left">
                                                                <h5>Marital Status</h5>
                                                                <p>{{ $profile->marital_status }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sett-lef">
                                                            <div class="sett-rad-left">
                                                                <h5>Disability</h5>
                                                                <p>{{ $profile->disability }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sett-lef">
                                                            <div class="sett-rad-left">
                                                                <h5>Family Status</h5>
                                                                <p>{{ $profile->family_status }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul>

<li>
    <div class="sett-lef">
        <div class="sett-rad-left">
            <h5>Family Type</h5>
            <p>{{ $profile->family_type }}</p>
        </div>
    </div>
</li>
<li>
    <div class="sett-lef">
        <div class="sett-rad-left">
            <h5>Family Value</h5>
            <p>{{ $profile->family_value }}</p>
        </div>
    </div>
</li>
<li>
    <div class="sett-lef">
        <div class="sett-rad-left">
            <h5>Education</h5>
            <p>{{ $profile->education }}</p>
        </div>
    </div>
</li>
<li>
    <div class="sett-lef">
        <div class="sett-rad-left">
            <h5>Employed In</h5>
            <p>{{ $profile->employed_in }}</p>
        </div>
    </div>
</li>
<li>
    <div class="sett-lef">
        <div class="sett-rad-left">
            <h5>Occupation</h5>
            <p>{{ $profile->occupation }}</p>
        </div>
    </div>
</li>
<li>
    <div class="sett-lef">
        <div class="sett-rad-left">
            <h5>Annual Income</h5>
            <p>{{ $profile->annual_income }}</p>
        </div>
    </div>
</li>
<li>
    <div class="sett-lef">
        <div class="sett-rad-left">
            <h5>Work Location</h5>
            <p>{{ $profile->work_location }}</p>
        </div>
    </div>
</li>
<li>
    <div class="sett-lef">
        <div class="sett-rad-left">
            <h5>Residing State</h5>
            <p>{{ $profile->residing_state }}</p>
        </div>
    </div>
</li>
                                                </ul>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <!-- End of Profile Section -->
                            </div>
                        </div>
                    </div>
                </div>
                <b><h6 id="datetimes" style="display: inline;"></h6></b><br>
            </div>
        </div>
    </div>
</section>


@endsection
