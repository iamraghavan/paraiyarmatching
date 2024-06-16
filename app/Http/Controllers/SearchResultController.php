<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cities;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class SearchResultController extends Controller
{
    public function searchResult(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'looking_for' => 'nullable|string',
            'age' => 'nullable|integer|min:21|max:40',
            'religion' => 'nullable|string',
            'city' => 'nullable|string',
        ]);

        // Build the query
        $query = User::query()
            ->join('profiles', 'users.pmid', '=', 'profiles.user_pmid');

        if ($request->filled('looking_for')) {
            $query->where('users.gender', $validatedData['looking_for']);
        }

        if ($request->filled('age')) {
            $query->where('profiles.age', $validatedData['age']);
        }

        if ($request->filled('religion') && $validatedData['religion'] !== "Any") {
            $query->where('profiles.religion', $validatedData['religion']);
        }


        if ($request->filled('city')) {
            $query->where('profiles.residing_state', $validatedData['city']);
        }

        // Fetch the results
        $results = $query->select('users.*', 'profiles.*')->get();

        // Return the view with the search results
        $cities = Cities::select('name')->get();
        return view('pages.search-results', compact('results'), ['cities' => $cities]);
    }

    public function search(Request $request)
    {
        // Retrieve filter values from the request
        $looking_for = $request->input('looking_for');
        $age = $request->input('age');
        $religion = $request->input('religion');

        // Query to filter results based on selected filters
        $query = User::join('profiles', 'users.pmid', '=', 'profiles.user_pmid')
            ->where('users.gender', $looking_for)
            ->where('profiles.age', $age);

        if ($religion !== "Any") {
            $query->where('profiles.religion', $religion);
        }

        // Get the filtered results
        $results = $query->select('users.*', 'profiles.*')->distinct()->get();

        // Return the filtered results as a view
        return view('pages.search-results', compact('results'));
    }
}
