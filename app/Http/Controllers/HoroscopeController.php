<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\FirebaseException;

class HoroscopeController extends Controller
{
    protected $firebaseStorage;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(config('services.firebase.credentials'));
        $this->firebaseStorage = $factory->createStorage();
    }

    public function uploadHoroscope(Request $request)
    {
        $request->validate([
            'user_pmid' => 'required|exists:profiles,user_pmid',
            'horoscope' => 'required|file|mimes:pdf|max:2048',
        ]);

        $file = $request->file('horoscope');
        $userPmid = $request->input('user_pmid');
        $fileName = "{$userPmid}-horoscope.pdf";
        $firebasePath = "paraiyarmatching/assets/pdf/{$userPmid}/{$fileName}";

        try {
            // Upload file to Firebase
            $bucket = $this->firebaseStorage->getBucket();
            $bucket->upload(
                file_get_contents($file->getRealPath()),
                [
                    'name' => $firebasePath,
                ]
            );

            // Generate a signed URL for the file
            $fileReference = $bucket->object($firebasePath);
            $horoscopeUrl = $fileReference->signedUrl(new \DateTime('+1 year'));

            // Update profile with the horoscope URL
            $profile = Profile::where('user_pmid', $userPmid)->first();
            $profile->update([
                'horoscope_url' => $horoscopeUrl,
            ]);

            return redirect()->route('dashboard')->with('success', 'Horoscope uploaded successfully.');
        } catch (FirebaseException $e) {
            return redirect()->route('dashboard')->with('error', 'Failed to upload horoscope: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Failed to upload horoscope: ' . $e->getMessage());
        }
    }
}