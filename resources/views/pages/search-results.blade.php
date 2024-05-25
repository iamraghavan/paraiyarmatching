@extends('layouts.app')
@section('content')

<section>
    <div class="all-pro-head">
        <div class="container">
            <div class="row">
                <h1>Lakhs of Happy Marriages</h1>
                <a href="{{url('/app/register')}}">Join now for Free</a>
            </div>
        </div>
    </div>
    <!--FILTER ON MOBILE VIEW-->
    <div class="fil-mob fil-mob-act">
        <h4>Profile filters <i class="fa fa-filter" aria-hidden="true"></i> </h4>
    </div>
</section>


<section>
    <div class="all-weddpro all-jobs all-serexp chosenini">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="short-all">
                        <div class="short-lhs">
                            Showing <b>{{ $results->count() }}</b> profiles
                        </div>
                        <div class="short-rhs">
                            <ul>
                                <li>
                                    <div class="sort-grid sort-grid-1">
                                        <i class="fa fa-th-large" aria-hidden="true"></i>
                                    </div>
                                </li>
                                <li>
                                    <div class="sort-grid sort-grid-2 act">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="all-list-sh">
                        <ul>
                            @foreach($results as $user)
                                <li>
                                    <div class="all-pro-box" data-useravil="avilno" data-aviltxt="Offline">
                                        <div class="pro-img">
                                            <a href="{{ route('user-profile', $user->user_pmid) }}">
                                                <img src="{{asset($user->profile_image)}}" alt="">
                                            </a>
                                        </div>
                                        <div class="pro-detail">
                                            <h4><a href="{{ route('user-profile', $user->user_pmid) }}">{{ $user->name }}</a></h4>
                                            <div class="pro-bio">
                                                <span>B.Sc</span>
                                                <span>IT Profession</span>
                                                <span>{{ $user->age }} Years old</span>
                                                <span>Height: 155Cms</span>
                                            </div>
                                            <div class="links">

                                                <a href="#!">WhatsApp</a>
                                                <a href="#!" class="cta cta-sendint" data-bs-toggle="modal" data-bs-target="#sendInter">Send interest</a>
                                                <a href="{{ route('user-profile', $user->user_pmid) }}">More details</a>
                                            </div>
                                        </div>
                                        <span class="enq-sav" data-toggle="tooltip" title="Click to save this profile."><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





@endsection
