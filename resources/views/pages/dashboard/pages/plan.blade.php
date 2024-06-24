
@extends('pages.dashboard.layouts.app')
@section('dashboard-content')
<section>
    <div class="db">
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
                                    <a href="{{ url('/app/profile/user-profile-edit' . $user->pmid . '/' . $hashedString) }}">
                                        <i class="fa fa-cog" aria-hidden="true"></i>Edit Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/app/profile/edit-personal-data' . $user->pmid . '/' . $hashedString) }}">
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
                        <div class="col-md-3 db-sec-com">
                            <h2 class="db-tit">Plan details</h2>
                            <div class="db-pro-stat">
                                <h6 class="tit-top-curv">Current plan</h6>
                                <div class="db-plan-card">
                                    <img src="{{asset('images/icon/plan.png')}}" alt="">
                                </div>
                                <div class="db-plan-detil">
                                    <ul>
                                        @if ($userPayment)

                                        <li>Name: <strong>{{ $userPayment->name }}</strong></li>

                                        @if($userPayment->paid_status == 'Not Paid')
                                        <li>This user has a free membership.</li>
                                        @elseif ($userPayment->paid_status == 'Paid')
                                        <li>Package Details: <strong>{{ $userPayment->package_details }}</strong></li>
                                        @endif
                                        <li>Paid Status: <strong>{{ $userPayment->paid_status ? 'Paid' : 'Not Paid' }}</strong></li>


                                        @if ($isFreeMembership)

                                        <li><a href="" class="cta-3">Upgrade now</a></li>

                                    @else
                                        <p>This user has a paid membership.</p>
                                    @endif
                                @else
                                    <p>User payment details not found.</p>
                                @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 db-sec-com">

                            <div class="db-invoice">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>User PMID</th>
                                            <th>Name</th>
                                            <th>Package Details</th>
                                            <th>Paid Status</th>
                                            <th>Date of Payment</th>
                                            <th>Plan Expiry Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($userPayment)
                                            <tr>
                                                <td>{{ $userPayment->user_pmid }}</td>
                                                <td>{{ $userPayment->name }}</td>
                                                <td>{{ $userPayment->package_details }}</td>
                                                <td>{{ $userPayment->paid_status ? 'Paid' : 'Not Paid' }}</td>
                                                @if($userPayment->paid_status && $userPayment->package_details != '0 Months')
                                                <td>{{ \Carbon\Carbon::parse($userPayment->date_of_paid)->format('d-m-Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($userPayment->plan_expired_date)->format('d-m-Y') }}</td>
                                            @else
                                                <td>--</td>
                                                <td>--</td>
                                            @endif
                                                {{-- <td>
                                                    <a href="{{ route('download.invoice', ['id' => $payment->id]) }}" class="cta-dark cta-sml" download>
                                                        <span>Download</span>
                                                    </a>
                                                </td> --}}
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="6">No payment details found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                </div>
                        </div>
                        <div class="col-md-12 db-sec-com">
                            <div class="alert alert-warning db-plan-canc">
                                <p><strong>Plan cancellation:</strong> <a href="#" data-bs-toggle="modal" data-bs-target="#plancancel">Click here</a> to cancell the current plan.</p>
                            </div>
                        </div>
                        <div class="col-md-12 db-sec-com">
                            <div class="alert alert-warning db-plan-canc db-plan-canc-app">
                                <p>Your plan cancellation request has been successfully received by the admin. Once the admin approves your cancellation, the cost will be sent to you.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
