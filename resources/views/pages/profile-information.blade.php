@extends('layouts.app')
@section('content')
@php

    $index = 0;
@endphp

<section>
    <div class="profi-pg profi-ban">
        <div class="">
            <div class="">
                <div class="profile">
                    <div class="pg-pro-big-im">
                        <div class="s1">
                            <img src="{{ $user->profile_image }}" loading="lazy" class="pro" srcset="{{ $user->profile_image }}" alt="{{ $user->name }}">
                        </div>

                    </div>
                </div>
                <div class="profi-pg profi-bio">
                    <div class="lhs">
                        <div class="pro-pg-intro">
                            <h1>{{$user->name}}</h1>
                            <div class="pro-info-status">
                                <span class="stat-1"><b>{{ rand(100, 999) }}</b> Profile Viewers</span>

                            </div>
                            <ul>
                                <li>
                                    <div>
                                        <img src="images/icon/pro-city.png" loading="lazy" alt="">
                                        <span>City: <strong>{{$user->residing_state}}</strong></span>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <img src="images/icon/pro-age.png" loading="lazy" alt="">
                                        <span>Age: <strong>{{ \Carbon\Carbon::parse($user->dob)->age }}</strong></span>

                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <img src="images/icon/pro-city.png" loading="lazy" alt="">
                                        <span>Height: <strong>{{$user->height}}</strong></span>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <img src="images/icon/pro-city.png" loading="lazy" alt="">
                                        <span>Job: <strong>{{$user->employed_in}}</strong></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- PROFILE ABOUT -->
                        <div class="pr-bio-c pr-bio-abo">
                            <h3>About</h3>
                            <p class="text-justify">{{$user->my_bio}}</p>
                        </div>
                        <!-- END PROFILE ABOUT -->
                        <!-- PROFILE ABOUT -->
                        <div class="pr-bio-c pr-bio-gal" id="gallery">Paraiyar Matching - The No. 1 Matrimony Site for Tamil Peoples - paraiyarmatching.com
                            <h3>Photo gallery</h3>
                            <div id="image-gallery">
                                @if($user->photo_gallery && $user->photo_gallery->count() > 0)
                                    @foreach($user->photo_gallery as $image)
                                        <div class="pro-gal-imag">
                                            <a href="{{ $image->image_url }}" target="_blank">
                                            <div class="img-wrapper">

                                                    <img src="{{ $image->image_url }}" class="img-responsive"  alt="{{ strtolower($user->name) . ' ' . ($index + 1) . ' profile' }}">

                                                <div class="img-overlay" style="opacity: 0;">
                                                    <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </a>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No images available</p>
                                @endif
                            </div>

                        <div id="overlay" style="display: none;"><div id="prevButton"><i class="fa fa-angle-left" aria-hidden="true"></i></div><img><div id="nextButton"><i class="fa fa-angle-right" aria-hidden="true"></i></div><div id="exitButton"><i class="fa fa-times" aria-hidden="true"></i></div></div></div>
                        <!-- END PROFILE ABOUT -->
                        <!-- PROFILE ABOUT -->
                        <div class="pr-bio-c pr-bio-conta">
                            <h3>Contact info</h3>
                            <ul>
                                <li><span><i class="fa fa-mobile" aria-hidden="true"></i><b>Phone:</b>{{ $user->phone }}</span></li>
                                <li><span><i class="fa fa-envelope-o" aria-hidden="true"></i><b>Email:</b>{{ $user->email }}</span>
                                </li>
                                <li><span><i class="fa fa fa-map-marker" aria-hidden="true"></i><b>Address: </b>{{ $user->residing_state }} /
                                    <b>Work Address: </b>{{ $user->work_location }}
                                </span></li>
                            </ul>
                        </div>
                        <!-- END PROFILE ABOUT -->
                        <!-- PROFILE ABOUT -->
                        <div class="pr-bio-c pr-bio-info">
                            <h3>Personal information</h3>
                            <ul>
                                @if(isset($user->user_pmid))
                                    <li><b>User PM ID:</b> {{ $user->user_pmid }}</li>
                                @endif

                                @if(isset($user->age))
                                    <li><b>Age:</b> {{ $user->age }}</li>
                                @endif

                                @if(isset($user->dob))
                                    <li><b>Date of Birth:</b> {{ \Carbon\Carbon::parse($user->dob)->format('d M Y') }}</li>
                                @endif

                                @if(isset($user->religion))
                                    <li><b>Religion:</b> {{ $user->religion }}</li>
                                @endif

                                @if(isset($user->mother_tongue))
                                    <li><b>Mother Tongue:</b> {{ $user->mother_tongue }}</li>
                                @endif

                                @if(isset($user->height))
                                    <li><b>Height:</b> {{ $user->height }} cm</li>
                                @endif

                                @if(isset($user->marital_status))
                                    <li><b>Marital Status:</b> {{ $user->marital_status }}</li>
                                @endif

                                @if(isset($user->disability))
                                    <li><b>Disability:</b> {{ $user->disability }}</li>
                                @endif

                                @if(isset($user->family_status))
                                    <li><b>Family Status:</b> {{ $user->family_status }}</li>
                                @endif

                                @if(isset($user->family_type))
                                    <li><b>Family Type:</b> {{ $user->family_type }}</li>
                                @endif

                                @if(isset($user->family_value))
                                    <li><b>Family Value:</b> {{ $user->family_value }}</li>
                                @endif

                                @if(isset($user->education))
                                    <li><b>Education:</b> {{ $user->education }}</li>
                                @endif

                                @if(isset($user->employed_in))
                                    <li><b>Employed In:</b> {{ $user->employed_in }}</li>
                                @endif

                                @if(isset($user->occupation))
                                    <li><b>Occupation:</b> {{ $user->occupation }}</li>
                                @endif

                                @if(isset($user->annual_income))
                                    <li><b>Annual Income:</b> {{ $user->annual_income }}</li>
                                @endif

                                @if(isset($user->work_location))
                                    <li><b>Work Location:</b> {{ $user->work_location }}</li>
                                @endif

                                @if(isset($user->residing_state))
                                    <li><b>Residing State:</b> {{ $user->residing_state }}</li>
                                @endif

                                @if(isset($user->birth_place))
                                <li><b>Birth Place:</b> {{ $user->birth_place }}</li>
                                @endif

                                @if(isset($user->birth_time))
                                <li><b>Birth Time:</b> {{ $user->birth_time }}</li>
                                @endif


<div class="mt-4" style="margin: 1.5rem 0 !important">
    @if(isset($user->star))
    <li><b>Star</b> {{ $user->star }}</li>
@endif
@if(isset($user->raasi))
<li><b>Rassi:</b> {{ $user->raasi }}</li>
@endif





@if(isset($user->dosham))
<li><b>Dosham:</b> {{ $user->dosham }}</li>
@endif
@if(isset($user->diet))
<li><b>Diet:</b> {{ $user->diet }}</li>
@endif

</div>

                            </ul>


<br>




                        </div>

                        @if(isset($user->siblings))
    @php
        $siblings = json_decode($user->siblings, true);
    @endphp

    <div class="">
        @if(isset($user->number_of_siblings))
            <div class="row mb-2">
                <div class="col-12">
                    <li><b>No of Siblings:</b> {{ $user->number_of_siblings }}</li>
                </div>
            </div>
        @endif

        @if(is_array($siblings))
            @foreach($siblings as $sibling)
                <div class="row mb-2 sibling-info">
                    <div class="col-6">
                        <b>Name:  </b>   {{ $sibling['name'] }}
                    </div>
                    <div class="col-6">
                        <b>Married:  </b>   {{ $sibling['married'] ? 'Yes' : 'No' }}
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endif





<div class="">




            <div class="row mb-2 sibling-info">
                @if(isset($user->father_name))
                <div class="col-6">

                    <b>Fathers Name:</b> {{ $user->father_name }}

                </div>
                @endif

                @if(isset($user->father_occupation))
                <div class="col-6">
                <b>Fathers Occupation:</b> {{ $user->father_occupation }}
                </div>
                @endif
            </div>




            <div class="row mb-2 sibling-info">

                    @if(isset($user->mother_name))
                    <div class="col-6">
                    <b>Mother Name:</b> {{ $user->mother_name }}
                    </div>
                    @endif

                @if(isset($user->mother_occupation))
                <div class="col-6">
                <b>Mother Occupation:</b> {{ $user->mother_occupation }}
                </div>
                @endif
            </div>


</div>

<style>
.sibling-info {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 10px;
}

.sibling-info .col-6 {
    display: flex;
    align-items: center;
}

@media (max-width: 767px) {
    .sibling-info .col-6 {
        flex: 0 0 100%;
        max-width: 100%;
        margin-bottom: 10px;
    }

    .col-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}

/* Adjusting container and other elements */
.container {
    padding-left: 15px;
    padding-right: 15px;
}

</style>

                        <!-- END PROFILE ABOUT -->
                        <!-- PROFILE ABOUT -->
                        {{-- <div class="pr-bio-c pr-bio-hob">
                            <h3>Hobbies</h3>
                            <ul>
                                <li><span>Modelling</span></li>
                                <li><span>Watching movies</span></li>
                                <li><span>Playing volleyball</span></li>
                                <li><span>Hangout with family</span></li>
                                <li><span>Adventure travel</span></li>
                                <li><span>Books reading</span></li>
                                <li><span>Music</span></li>
                                <li><span>Cooking</span></li>
                                <li><span>Yoga</span></li>
                            </ul>
                        </div> --}}
                        <!-- END PROFILE ABOUT -->
                        <!-- PROFILE ABOUT -->
                        {{-- <div class="pr-bio-c menu-pop-soci pr-bio-soc">
                            <h3>Social media</h3>
                            <ul>
                                <li><a href="#!"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#!"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#!"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                                <li><a href="#!"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#!"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                <li><a href="#!"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </div> --}}
                        <!-- END PROFILE ABOUT -->


                    </div>

                    <!-- PROFILE lHS -->
                    <div class="rhs">
                        <!-- HELP BOX -->

                        <!-- END HELP BOX -->
                        <!-- RELATED PROFILES -->


                        {{-- <div class="slid-inn pr-bio-c wedd-rel-pro">
                            <h3>Related profiles</h3>
                            <ul class="slider3">
                                @foreach($relatedProfiles as $profile)
                                    <li>
                                        <x-related-profile-card :profile="$profile" />
                                    </li>
                                @endforeach
                            </ul>
                        </div> --}}



                        <!-- END RELATED PROFILES -->
                    </div>
                    <!-- END PROFILE lHS -->
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <div class="col-lg-12" style="margin: 20rem">

    <img src="{{ $user->profile_image }}" alt="{{ $user->name }}" srcset="">

    <h1>{{ $user->name }}</h1>
    <p>Age: {{ $user->age }}</p>
    <p>Religion: {{ $user->religion }}</p>
    <p>City: {{ $user->residing_state }}</p>
</div> --}}

@endsection
