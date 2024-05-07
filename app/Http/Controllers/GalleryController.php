<?php

namespace App\Http\Controllers;

use App\Models\PhotoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function show_upload()
    {
        if (Auth::check()) {
            // Fetch the authenticated user
            $user = Auth::user();
            $images = PhotoGallery::where('pmid', $user->pmid)->get();
            return view('pages.dashboard.pages.upload-photo-gallery', compact('images', 'user'));
        }
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:40960', // Max size 2MB
        ]);

        // Handle errors during file upload
        try {
            // Loop through the uploaded images and store them in the database
            foreach ($request->file('images') as $key => $image) {
                // Ensure we don't exceed 10 images
                if ($key >= 10) {
                    break;
                }

                // Generate a unique file name
                $fileName = strtolower($user->pmid) . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                // Define the image storage path
                $path = 'assets/images/profile/' . strtolower($user->pmid) . '/gallery/';

                // Save the image to the database
                $photoGallery = new PhotoGallery();
                $photoGallery->pmid = (string) $user->pmid; // Ensure pmid is treated as a string
                $photoGallery->image_url = $path . $fileName;
                $photoGallery->save();

                // Move the uploaded image to the desired location
                $image->move(public_path($path), $fileName);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Images uploaded successfully!');
    }

    public function delete($image)
    {


        $image = PhotoGallery::where('id', $image)->first();
        $image->delete();



        return redirect()->back()->with('success', 'Image deleted successfully!');
    }
}