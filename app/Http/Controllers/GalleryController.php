<?php

namespace App\Http\Controllers;

use App\Models\PhotoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Storage;
use Kreait\Firebase\Exception\FirebaseException;

class GalleryController extends Controller
{
    protected $firebaseStorage;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(config('services.firebase.credentials'));
        $this->firebaseStorage = $factory->createStorage();
    }

    public function show_upload()
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized action.');
        }

        // Fetch the authenticated user
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


        $images = PhotoGallery::where('user_pmid', $user->pmid)->get();
        $profile = Profile::where('user_pmid', $user->pmid)->first();

        return view('pages.dashboard.pages.upload-photo-gallery', compact('images', 'user', 'profile'));
    }

    public function upload(Request $request)
    {
        $user = Auth::user();

        // Check if the user is authenticated
        if (!$user) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }

        // Validate the uploaded images
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max size 2MB per image
        ]);

        // Handle errors during file upload
        try {
            // Loop through the uploaded images and store them in Firebase Storage
            foreach ($request->file('images') as $key => $image) {
                // Ensure we don't exceed 10 images
                if ($key >= 10) {
                    break;
                }

                // Generate a unique file name
                $fileName = strtolower($user->pmid) . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                // Define the image storage path in Firebase Storage
                $firebaseFilePath = 'paraiyarmatching/assets/profile/' . strtolower($user->pmid) . '/' . $fileName;

                // Upload image to Firebase Storage
                $bucket = $this->firebaseStorage->getBucket();
                $bucket->upload(
                    file_get_contents($image->getRealPath()),
                    [
                        'name' => $firebaseFilePath,
                    ]
                );

                // Generate a signed URL for the uploaded file
                $fileReference = $bucket->object($firebaseFilePath);
                $signedUrl = $fileReference->signedUrl(new \DateTime('+1 year'));

                // Save the signed URL to the database
                $photoGallery = new PhotoGallery();
                $photoGallery->user_pmid = $user->pmid;
                $photoGallery->image_url = $signedUrl;
                $photoGallery->save();
            }
        } catch (FirebaseException $e) {
            return redirect()->back()->with('error', 'Firebase Storage Error: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Images uploaded successfully!');
    }


    public function delete($imageId)
    {
        // Find the image record in the database
        $image = PhotoGallery::findOrFail($imageId);

        // Get the file path or URL from the database
        $firebasePath = $image->image_url;

        try {
            // Initialize Firebase Storage
            $factory = (new Factory)->withServiceAccount(config('services.firebase.credentials'));
            $firebaseStorage = $factory->createStorage();

            // Delete the image file from Firebase Storage
            $bucket = $firebaseStorage->getBucket();
            $bucket->object($firebasePath)->delete();

            // Delete the image record from the database
            $image->delete();

            return redirect()->back()->with('success', 'Image deleted successfully!');
        } catch (FirebaseException $e) {
            return redirect()->back()->with('error', 'Firebase Storage Error: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
