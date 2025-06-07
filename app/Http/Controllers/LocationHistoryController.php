<?php

namespace App\Http\Controllers;

use App\Models\LocationHistory;

class LocationHistoryController extends Controller
{
    public function index()
    {
        $locations = LocationHistory::with('user')->latest()->paginate(10);
        return view('pages.location_histories.index', compact('locations'));
    }
}


