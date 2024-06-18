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
                <div class="col-md-3 fil-mob-view">
                    <span class="filter-clo">+</span>
                    <form id="searchForm" action="{{ route('searchFilter') }}" method="POST">
                        @csrf
                        <!-- START -->
                        <div class="filt-com lhs-cate">
                            <h4><i class="fa fa-search" aria-hidden="true"></i> I'm looking for</h4>
                            <div class="form-group">
                                <label for="looking_for">I'm looking for</label>
                                <select name="looking_for" class="chosen-select">
                                    <option value="">I'm looking for</option>
                                    <option value="male">Groom</option>
                                    <option value="female">Bride</option>
                                </select>
                            </div>
                        </div>
                        <!-- END -->

                        <!-- START -->
                        <div class="filt-com lhs-cate">
                            <h4><i class="fa fa-clock-o" aria-hidden="true"></i>Age</h4>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <select name="age" class="chosen-select">
                                    <option value="">Age</option>
                                    @for($i = 21; $i <= 40; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <!-- END -->

                        <!-- START -->
                        <div class="filt-com lhs-cate">
                            <h4><i class="fa fa-bell-o" aria-hidden="true"></i>Select Religion</h4>
                            <div class="form-group">
                                <label for="religion">Religion</label>
                                <select name="religion" class="chosen-select">
                                    <option value="">Religion</option>
                                    <option value="Any">Any</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Muslim">Muslim</option>
                                    <option value="Jain">Jain</option>
                                    <option value="Christian">Christian</option>
                                </select>
                            </div>
                        </div>
                        <!-- END -->

                        <div class="filt-com lhs-cate">
                            <li class="sr-btn">
                                <button type="submit" style="background: var(--cta-pink1); color: #fff; border: 0 solid #ffa778; padding: 8px 25px; text-align: center; font-size: 18px; letter-spacing: 1px; transition: .5s; border-radius: 3px; font-weight: 600; font-family: 'Josefin Sans', sans-serif;">Search</button>
                            </li>
                        </div>
                    </form>
                </div>

                <div class="col-md-9">
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
                                <a href="{{ route('user-profile', $user->user_pmid) }}">
                                    <div class="all-pro-box">
                                        <div class="pro-img">
                                            <a href="{{ route('user-profile', $user->user_pmid) }}">
                                                <img src="{{ asset($user->profile_image) }}" alt="{{ $user->name }}" style="  width: 50%;
            height: auto;
            object-fit: cover;
            display: block;
            margin-left: auto;
            margin-right: auto;
            position: relative;
            top: 50%;">
                                            </a>
                                        </div>
                                        <div class="pro-detail">
                                            <h4><a href="{{ route('user-profile', $user->user_pmid) }}">{{ $user->name }}</a></h4>
                                            <div class="pro-bio">
                                                <span>{{ $user->religion }}</span>
                                                <span>{{ $user->family_type }}</span>
                                                <span>{{ $user->age }} Years old</span>
                                            </div>
                                            <div class="links">
                                                <a href="#!" class="cta cta-sendint" data-bs-toggle="modal" data-bs-target="#sendInter">Send interest</a>
                                                <a href="{{ route('user-profile', $user->user_pmid) }}">More details</a>
                                            </div>
                                        </div>
                                        <span class="enq-sav" data-toggle="tooltip" title="Click to save this profile.">
                                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </a>

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
