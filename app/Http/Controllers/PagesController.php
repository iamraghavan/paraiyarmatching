<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {

        $cities = Cities::select('name')->get();

        return view('pages.index', ['cities' => $cities]);
    }
}
