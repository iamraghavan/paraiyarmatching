

<div>
    <div class="head-top">
        <div class="container">
            <div class="row">
                <div class="lhs">
                    <ul>

                        <li><a href="{{ url("about.html") }}">About</a></li>
                        <li><a href="{{ url("faq.html") }}">FAQ</a></li>
                        <li><a href="{{ url("contact.html") }}">Contact</a></li>
                    </ul>
                </div>
                <div class="rhs">
                    <ul>
                        <li><a href="{{ url("tel:+9704462944") }}"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;+01 5312
                                5312</a></li>
                        <li><a href="{{ url("mailto:info@example.com") }}"><i class="fa fa-envelope-o"
                                    aria-hidden="true"></i>&nbsp; help@company.com</a></li>
                        <li><a href="{{ url("#!") }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="{{ url("#!") }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="{{ url("#!") }}"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="hom-top">
    <div class="container">
        <div class="row">
            <div class="hom-nav">
                <!-- LOGO -->
                <div class="logo">
                    {{-- <span class="menu desk-menu">
                        <i></i><i></i><i></i>
                    </span> --}}
                    <a href="{{ url("/") }}" class="logo-brand"><img src="{{ asset("/images/logo-b.png") }}" alt="" loading="lazy"
                            class="ic-logo"></a>
                </div>

                <!-- EXPLORE MENU -->
                <div class="bl">
                    <ul>
                        <li class="smenu-pare">
                            <span class="smenu">Partner Search</span>
                            <div class="smenu-open smenu-box">
                                <div class="container">
                                    <div class="row">
                                        <h4 class="tit">Search your Life Partner</h4>
                                        <ul>
                                            <li>
                                                <div class="menu-box menu-box-2">
                                                    <h5> Brides <span>1200+ Verified profiles</span></h5>
                                                    <span class="explor-cta">More details</span>
                                                    <a href="{{ url("/") }}" class="fclick"></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="menu-box menu-box-1">
                                                    <h5>Grooms <span>1100+ Verified profiles</span></h5>
                                                    <span class="explor-cta">More details</span>
                                                    <a href="{{ url("wedding.html") }}" class="fclick"></a>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>



                        <li><a href="{{ url("sign-up.html") }}">Contact</a></li>
                        <li><a href="{{ url("sign-up.html") }}">Help</a></li>

                        @if(auth()->check())
                        <li><a onclick="confirmLogout()">Logout</a></li>
@else
    <li><a href="{{ url("/app/register") }}">Register</a></li>
    <li><a href="{{ url("/app/login") }}">Login</a></li>
@endif

                    </ul>
                </div>

                <!-- USER PROFILE -->
                @if(auth()->check())

                <a href="{{url('/app/profile/dashboard')}}">
    <div class="">
        <div class="head-pro">

            <b>{{ auth()->user()->name }}</b><br>
            <h4>{{ auth()->user()->pmid }}</h4>
            <span class="fclick"></span>
        </div>
    </div>
</a>
@else
    <div class="al">
        <div class="head-pro">
            {{-- <img src="{{ asset("/images/profiles/1.jpg") }}" alt="" loading="lazy"> --}}
            <b> <h6 id="datetime" style="display: inline;" ></h6></b><br>
        </div>
    </div>
@endif



                <!--MOBILE MENU-->
                <div class="mob-menu">
                    <div class="mob-me-ic">
                        <span class="ser-open mobile-ser">
                            <img src="{{ asset("/images/icon/search.svg") }}" alt="">
                        </span>
                        <span class="mobile-exprt" data-mob="dashbord">
                            <img src="{{ asset("/images/icon/users.svg") }}" alt="">
                        </span>
                        <span class="mobile-menu" data-mob="mobile">
                            <img src="{{ asset("/images/icon/menu.svg") }}" alt="">
                        </span>
                    </div>
                </div>
                <!--END MOBILE MENU-->
            </div>
        </div>
    </div>
</div>


   <!-- EXPLORE MENU POPUP -->
   <div class="mob-me-all mobile_menu">
    <div class="mob-me-clo"><img src="{{ asset("/images/icon/close.svg") }}" alt=""></div>
    <div class="mv-bus">
        <h4><i class="fa fa-globe" aria-hidden="true"></i> EXPLORE CATEGORY</h4>
        <ul>
            <li><a href="{{ url("all-profiles.html") }}">Browse profiles</a></li>
            <li><a href="{{ url("wedding.html") }}">Wedding page</a></li>
            <li><a href="{{ url("services.html") }}">All Services</a></li>
            <li><a href="{{ url("plans.html") }}">Join Now</a></li>
        </ul>
        <h4><i class="fa fa-align-center" aria-hidden="true"></i> All Pages</h4>
        <ul>
            <li><a href="{{ url("all-profiles.html") }}">All profiles</a></li>
            <li><a href="{{ url("profile-details.html") }}">Profile details</a></li>
            <li><a href="{{ url("wedding.html") }}">Wedding</a></li>
            <li><a href="{{ url("wedding-video.html") }}">Wedding video</a></li>
            <li><a href="{{ url("services.html") }}">Our Services</a></li>
            <li><a href="{{ url("plans.html") }}">Pricing plans</a></li>
            <li><a href="{{ url("login.html") }}">Login</a></li>
            <li><a href="{{ url("sign-up.html") }}">Sign-up</a></li>
            <li><a href="{{ url("photo-gallery.html") }}">Photo gallery</a></li>
            <li><a href="{{ url("photo-gallery-1.html") }}">Photo gallery 1</a></li>
            <li><a href="{{ url("contact.html") }}">Contact</a></li>
            <li><a href="{{ url("about.html") }}">About</a></li>
            <li><a href="{{ url("blog.html") }}">Blog</a></li>
            <li><a href="{{ url("blog-detail.html") }}">Blog detail</a></li>
            <li><a href="{{ url("enquiry.html") }}">Ask your doubts</a></li>
            <li><a href="{{ url("make-reservation.html") }}">Make Reservation</a></li>
            <li><a href="{{ url("faq.html") }}">FAQ</a></li>
            <li><a href="{{ url("coming-soon.html") }}" target="_blank">Coming soon</a></li>
            <li><a href="{{ url("404.html") }}">404</a></li>
        </ul>
        <div class="menu-pop-help">
            <h4>Support Team</h4>
            <div class="user-pro">
                <img src="{{ asset("/images/profiles/1.jpg") }}" alt="" loading="lazy">
            </div>
            <div class="user-bio">
                <h5>Ashley emyy</h5>
                <span>Senior personal advisor</span>
                <a href="{{ url("enquiry.html") }}" class="btn btn-primary btn-sm">Ask your doubts</a>
            </div>
        </div>
        <div class="menu-pop-soci">
            <ul>
                <li><a href="{{ url("#!") }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="{{ url("#!") }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="{{ url("#!") }}"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                <li><a href="{{ url("#!") }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                <li><a href="{{ url("#!") }}"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                <li><a href="{{ url("#!") }}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
        </div>
        <div class="late-news">
            <h4>Latest news</h4>
            <ul>
                <li>
                    <div class="rel-pro-img">
                        <img src="{{ asset("/images/couples/1.jpg") }}" alt="" loading="lazy">
                    </div>
                    <div class="rel-pro-con">
                        <h5>Long established fact that a reader distracted</h5>
                        <span class="ic-date">12 Dec 2023</span>
                    </div>
                    <a href="{{ url("blog-detail.html") }}" class="fclick"></a>
                </li>
                <li>
                    <div class="rel-pro-img">
                        <img src="{{ asset("/images/couples/3.jpg") }}" alt="" loading="lazy">
                    </div>
                    <div class="rel-pro-con">
                        <h5>Long established fact that a reader distracted</h5>
                        <span class="ic-date">12 Dec 2023</span>
                    </div>
                    <a href="{{ url("blog-detail.html") }}" class="fclick"></a>
                </li>
                <li>
                    <div class="rel-pro-img">
                        <img src="{{ asset("/images/couples/4.jpg") }}" alt="" loading="lazy">
                    </div>
                    <div class="rel-pro-con">
                        <h5>Long established fact that a reader distracted</h5>
                        <span class="ic-date">12 Dec 2023</span>
                    </div>
                    <a href="{{ url("blog-detail.html") }}" class="fclick"></a>
                </li>
            </ul>
        </div>
        <div class="prof-rhs-help">
            <div class="inn">
                <h3>Tell us your Needs</h3>
                <p>Tell us what kind of service you are looking for.</p>
                <a href="{{ url("enquiry.html") }}">Register for free</a>
            </div>
        </div>
    </div>
</div>
<!-- END MOBILE MENU POPUP -->

<!-- MOBILE USER PROFILE MENU POPUP -->
<div class="mob-me-all dashbord_menu">
    <div class="mob-me-clo"><img src="{{ asset("/images/icon/close.svg") }}" alt=""></div>
    <div class="mv-bus">
        <div class="head-pro">
            <img src="{{ asset("/images/profiles/1.jpg") }}" alt="" loading="lazy">
            <b>user profile</b><br>
            <h4>Ashley emyy</h4>
        </div>
        <ul>
            <li><a href="{{ url("login.html") }}">Login</a></li>
            <li><a href="{{ url("sign-up.html") }}">Sign-up</a></li>
            <li><a href="{{ url("plans.html") }}">Pricing plans</a></li>
            <li><a href="{{ url("all-profiles.html") }}">Browse profiles</a></li>
        </ul>
    </div>
</div>
<!-- END USER PROFILE MENU POPUP -->
