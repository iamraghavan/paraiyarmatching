
@php
    use Illuminate\Support\Facades\Http;

    function fetch_ip()
    {
        try {
            $response = Http::get('https://ipinfo.io/json');

            if ($response->successful()) {
                $data = $response->json();
                $clientIP = $data['ip'];
                $timezone = $data['timezone'];
                $country = $data['country'];

                return [
                    'ip' => $clientIP,
                    'timezone' => $timezone,
                    'country' => $country,
                ];
            } else {
                return ['error' => 'Unable to fetch IP information'];
            }
        } catch (\Exception $e) {
            return ['error' => 'Sorry Please Refresh the Page to get IP information'];
        }
    }

    $ipInfo = fetch_ip();
@endphp

<div>
    <div class="head-top">
        <div class="container">
            <div class="row">
                <div class="lhs">
                    <ul>

                        @if(isset($ipInfo['error']))
                        <li><a href="{{ $ipInfo['error'] }}">{{ $ipInfo['error'] }}</a></li>
                        @else
                        <li><a href="{{ $ipInfo['ip'] }}">{{ $ipInfo['ip'] }}</a></li>
                        @endif



                    </ul>
                </div>
                <div class="rhs">
                    <ul>
                        <li><a><span id="datetimes" style="display: inline;"></span></a></li>

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


                            <li><a href="{{ url("#") }}">Take a Tour</a></li>

                            <li><a href="{{ url("/membership/package") }}">Membership Package</a></li>


                        @if(auth()->check())
                            <li><a onclick="confirmLogout()">Logout</a></li>
                        @else
                            <li><a href="{{ url("/app/register") }}">Register</a></li>
                            <li><a href="{{ url("/app/login") }}">Login</a></li>
                        @endif
                    </ul>
                </div>
                <div class="al">
                <!-- USER PROFILE -->
                @if(auth()->check())

                <a href="{{url('/app/profile/dashboard')}}" rel="noopener noreferrer" name={{auth()->user()->name}} target="_parent" referrerpolicy="no-referrer strict-origin-when-cross-origin">
                    <div class="desktop-view"> <!-- Add a class for desktop view -->

                            <div class="head-pro">

                                <b>{{ auth()->user()->name }}</b><br>
                                <h4>{{ auth()->user()->pmid }}</h4>
                                <span class="fclick"></span>

                            </div>

                    </div>

                </a>

            @else

                    <div class="head-pro">
                        {{-- <img src="{{ asset("/images/profiles/1.jpg") }}" alt="" loading="lazy"> --}}
                        <b><h6 id="datetimes" style="display: inline;"></h6></b><br>
                    </div>

            @endif
        </div>





                <!--MOBILE MENU-->
                <div class="mob-menu">
                    <div class="mob-me-ic">
                        {{-- <span class="ser-open mobile-ser">
                            <img src="{{ asset("/images/icon/search.svg") }}" alt="">
                        </span> --}}
                        @if(auth()->check())

                        <a href="{{url('/app/profile/dashboard')}}">
                            <span class="mobile-exprt" data-mob="dashbord">
                                <img src="{{ asset("/images/icon/users.svg") }}" alt="">
                            </span>
        </a>
        @endif

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
     @if(auth()->check())
                            @if(isset($ipInfo['error']))
                                <p>Error fetching IP information: {{ $ipInfo['error'] }}</p>
                            @else
                                <li><p>{{ $ipInfo['ip'] }}</p></li>
                            @endif
                        @else
    <div class="mv-bus">
        <h4><i class="fa fa-globe" aria-hidden="true"></i> EXPLORE CATEGORY</h4>
        <ul>
            <li><a href="{{ url("#") }}">Search Brides</a></li>
            <li><a href="{{ url("#") }}">Search Grooms</a></li>

        </ul>
        <h4><i class="fa fa-align-center" aria-hidden="true"></i> All Pages</h4>
        <ul>
            <li><a href="{{ url("#") }}">Contact</a></li>
            <li><a href="{{ url("#") }}">Take a Tour</a></li>
            <li><a href="{{ url("#") }}">Help</a></li>

            @endif

            @if(auth()->check())
            <li><a onclick="confirmLogout()">Logout</a></li>
@else
<li><a href="{{ url("/app/register") }}">Register</a></li>
<li><a href="{{ url("/app/login") }}">Login</a></li>
@endif
        </ul>


    </div>
</div>


