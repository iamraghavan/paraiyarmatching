<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Http;
use App\Models\UserPayment;
use App\Models\Tndv;
use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Services\SeoService;

$seo = seo();

$seo = app(SeoService::class);

$seo = Seo::make();


class DashboardController extends Controller
{
    // Dashboard index page
    public function index()
    {

        if (!Auth::check()) {
            abort(403, 'Unauthorized action.');
        }




        if (Auth::check()) {

            if (!Auth::check()) {
                abort(403, 'Unauthorized action.');
            }


            $user = Auth::user();

            $ipInfo = $this->fetch_ip();

            seo()->addFromArray([
                'title' => ucwords(strtolower($user->name)) . ' ' . $user->pmid . ' ' . 'Paraiyar Matching - Matchfinder is a matchmaking portal for brides and grooms',
                'description' => 'Paraiyar Matching: No. 1 site for Tamil Brides & Grooms. Trusted globally. Register free!',
                'meta' => [
                    [
                        'name' => 'author',
                        'content' => 'Raghavan Jeeva',
                    ],
                    [
                        'name' => 'site_name',
                        'content' => 'Paraiyar Matching' . ' ' . ucwords(strtolower($user->name)),
                    ],
                ],
                'twitter' => [
                    'card' => 'summary',
                ],
                'og' => [
                    'site_name' => 'Paraiyar Matching',
                ],

            ]);

            // Retrieve the profile associated with the authenticated user
            $profile = Profile::where('user_pmid', $user->pmid)->first();


            // if (Auth::check()) {
            //     if ($profile && is_null($profile->horoscope_url)) {
            //         session()->flash('infos', 'Could you please provide your Horoscope Details to complete your profile');
            //     }
            // }

            $districts = Tndv::select('DISTRICT_NAME')->distinct()->get();
            $subDistricts = Tndv::all();

            // If profile exists
            if ($profile) {
                // Calculate profile completion percentage
                $completionPercentage = $this->calculateProfileCompletion($profile);

                $districts = Tndv::select('DISTRICT_NAME')->distinct()->pluck('DISTRICT_NAME')->toArray();
                $subDistricts = Tndv::all();

                // Redirect based on completion percentage
                if ($completionPercentage >= 100) {
                    return view('pages.dashboard.pages.index', compact('user', 'profile', 'completionPercentage', 'ipInfo'));
                } elseif ($completionPercentage >= 80) {
                    return view('pages.dashboard.pages.index', compact('user', 'profile', 'completionPercentage', 'ipInfo'))->with('info', 'Please complete the remaining profile information.');
                } elseif ($completionPercentage >= 50) {
                    return view('pages.dashboard.pages.index', compact('user', 'profile', 'completionPercentage', 'ipInfo'))->with('info', 'Your profile is halfway complete.');
                } else {
                    // Redirect to profile edit page if completion percentage is less than 50%
                    return redirect()->route('user-profile-edit', [
                        'id' => $user->pmid,
                        'districts' => $districts,
                        'subDistricts' => $subDistricts
                    ])->with('info', 'Could you please provide the missing data to complete your profile?');
                }
            } else {
                // If profile doesn't exist, redirect to profile edit page
                return redirect()->route('user-profile-edit', [
                    'id' => $user->pmid,
                    'districts' => $districts,
                    'subDistricts' => $subDistricts
                ]);
            }
        } else {
            // If user is not authenticated, redirect to login page
            return redirect()->route('login');
        }
    }

    // Calculate profile completion percentage
    public function calculateProfileCompletion($profile)
    {
        $requiredFields = [
            'occupation',
            'annual_income', 'work_location', 'residing_state',
        ];

        // Count the completed fields
        $completedFields = 0;
        foreach ($requiredFields as $field) {
            if ($profile->$field) {
                $completedFields++;
            }
        }

        // Calculate completion percentage based on the number of completed fields
        $totalFields = count($requiredFields);
        $completionPercentage = ($completedFields / $totalFields) * 100;

        return $completionPercentage;
    }


    // Profile edit page
    public function user_profile_edit($id, $dummy = null)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // If authenticated, fetch the authenticated user
            $user = Auth::user();

            seo()->addFromArray([
                'title' => ucwords(strtolower($user->name)) . ' ' . $user->pmid . ' ' . 'Paraiyar Matching - Matchfinder is a matchmaking portal for brides and grooms',
                'description' => 'Paraiyar Matching: No. 1 site for Tamil Brides & Grooms. Trusted globally. Register free!',
                'meta' => [
                    [
                        'name' => 'author',
                        'content' => 'Raghavan Jeeva',
                    ],
                    [
                        'name' => 'site_name',
                        'content' => 'Paraiyar Matching' . ' ' . ucwords(strtolower($user->name)),
                    ],
                ],
                'twitter' => [
                    'card' => 'summary',
                ],
                'og' => [
                    'site_name' => 'Paraiyar Matching',
                ],

            ]);

            $districts = Tndv::select('DISTRICT_NAME')->distinct()->pluck('DISTRICT_NAME')->toArray();
            $subDistricts = Tndv::all();

            // Retrieve the profile associated with the authenticated user
            $profile = Profile::where('user_pmid', $user->pmid)->first();

            return view('pages.dashboard.pages.user-profile-edit')
                ->with('user', $user)
                ->with('profile', $profile)
                ->with('districts', $districts)
                ->with('subDistricts', $subDistricts);
        } else {
            // If not authenticated, redirect to the login page
            return redirect()->route('login');
        }
    }


    public function edit_personal_data($id, $dummys = null)

    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // If authenticated, fetch the authenticated user
            $user = Auth::user();

            seo()->addFromArray([
                'title' => ucwords(strtolower($user->name)) . ' ' . $user->pmid . ' ' . 'Paraiyar Matching - Matchfinder is a matchmaking portal for brides and grooms',
                'description' => 'Paraiyar Matching: No. 1 site for Tamil Brides & Grooms. Trusted globally. Register free!',
                'meta' => [
                    [
                        'name' => 'author',
                        'content' => 'Raghavan Jeeva',
                    ],
                    [
                        'name' => 'site_name',
                        'content' => 'Paraiyar Matching' . ' ' . ucwords(strtolower($user->name)),
                    ],
                ],
                'twitter' => [
                    'card' => 'summary',
                ],
                'og' => [
                    'site_name' => 'Paraiyar Matching',
                ],

            ]);


            // Retrieve the profile associated with the authenticated user
            $profile = Profile::where('user_pmid', $user->pmid)->first();

            return view('pages.dashboard.pages.edit-personal-data', compact('user', 'profile'));
        } else {
            // If not authenticated, redirect to the login page
            return redirect()->route('login');
        }
    }

    // Edit user profile
    public function editUserProfile($id)
    {
        $user = User::findOrFail($id); // Assuming you have a User model
        $profile = Profile::where('user_id', $id)->first(); // Assuming you have a 'user_id' column in your profiles table
        $districts = Tndv::select('DISTRICT_NAME')->distinct()->get();
        $subDistricts = Tndv::all();
        if ($profile) {

            seo()->addFromArray([
                'title' => ucwords(strtolower($user->name)) . ' ' . $user->pmid . ' ' . 'Paraiyar Matching - Matchfinder is a matchmaking portal for brides and grooms',
                'description' => 'Paraiyar Matching: No. 1 site for Tamil Brides & Grooms. Trusted globally. Register free!',
                'meta' => [
                    [
                        'name' => 'author',
                        'content' => 'Raghavan Jeeva',
                    ],
                    [
                        'name' => 'site_name',
                        'content' => 'Paraiyar Matching' . ' ' . ucwords(strtolower($user->name)),
                    ],
                ],
                'twitter' => [
                    'card' => 'summary',
                ],
                'og' => [
                    'site_name' => 'Paraiyar Matching',
                ],

            ]);

            $districts = Tndv::select('DISTRICT_NAME')->distinct()->pluck('DISTRICT_NAME')->toArray();
            $subDistricts = Tndv::all();


            return view('pages.dashboard.pages.edit-user-profile', compact('user', 'profile', 'districts', 'subDistricts'));
            // return view('user-profile-edit', compact('user', 'profile', 'tamilNaduDistrictVillage'));
        } else {
            return redirect()->route('user-profile-edit', [
                'id' => $user->pmid,

                'districts' => $districts,
                'subDistricts' => $subDistricts
            ])->with('info', 'Could you please provide the missing data to complete your profile?');
        }
    }
    public function horoscope_upload()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $profile = Profile::where('user_pmid', $user->pmid)->first();

            seo()->addFromArray([
                'title' => ucwords(strtolower($user->name)) . ' ' . $user->pmid . ' ' . 'Paraiyar Matching - Matchfinder is a matchmaking portal for brides and grooms',
                'description' => 'Paraiyar Matching: No. 1 site for Tamil Brides & Grooms. Trusted globally. Register free!',
                'meta' => [
                    [
                        'name' => 'author',
                        'content' => 'Raghavan Jeeva',
                    ],
                    [
                        'name' => 'site_name',
                        'content' => 'Paraiyar Matching' . ' ' . ucwords(strtolower($user->name)),
                    ],
                ],
                'twitter' => [
                    'card' => 'summary',
                ],
                'og' => [
                    'site_name' => 'Paraiyar Matching',
                ],

            ]);


            if ($profile) {

                $horoscopeUrl = $profile->horoscope_url;

                return view('pages.dashboard.pages.upload-horoscope', compact('user', 'profile', 'horoscopeUrl'));
            } else {
                return redirect()->route('horoscope.upload', ['id' => $user->pmid])->with('info', 'Could you please provide the missing data to complete your profile?');
            }
        }
    }


    public function membershipPlan($id)
    {

        if (Auth::check()) {

            if (!Auth::check()) {
                abort(403, 'Unauthorized action.');
            }



            $user = Auth::user();

            seo()->addFromArray([
                'title' => ucwords(strtolower($user->name)) . ' ' . $user->pmid . ' ' . 'Paraiyar Matching - Matchfinder is a matchmaking portal for brides and grooms',
                'description' => 'Paraiyar Matching: No. 1 site for Tamil Brides & Grooms. Trusted globally. Register free!',
                'meta' => [
                    [
                        'name' => 'author',
                        'content' => 'Raghavan Jeeva',
                    ],
                    [
                        'name' => 'site_name',
                        'content' => 'Paraiyar Matching' . ' ' . ucwords(strtolower($user->name)),
                    ],
                ],
                'twitter' => [
                    'card' => 'summary',
                ],
                'og' => [
                    'site_name' => 'Paraiyar Matching',
                ],

            ]);


            if (Auth()->user()->pmid == $id) {
                $profile = Profile::where('user_pmid', $user->pmid)->first();
                $user = Profile::where('user_pmid', $id)->first();
                $userPayment = UserPayment::where('user_pmid', $id)->first();

                // Check if the user has a free membership
                $isFreeMembership = false;
                if ($userPayment) {
                    if ($userPayment->package_details == '0 Months' && $userPayment->paid_status == 0) {
                        $isFreeMembership = true;
                    }
                }
                return view('pages.dashboard.pages.plan', ['user' => $user, 'profile' => $profile, 'userPayment' => $userPayment, 'isFreeMembership' => $isFreeMembership]);
            }
        }
    }


    /* IP Value Get */

    public function fetch_ip()
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
            return ['error' => 'Sorry' . $e->getMessage()];
        }
    }
}
