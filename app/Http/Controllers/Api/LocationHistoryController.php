<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LocationHistory;
use Carbon\Carbon;

class LocationHistoryController extends Controller
{
    //show
    public function updateLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required|string',
            'longitude' => 'required|string',
        ]);

        // $lastHistory = LocationHistory::where('user_id', $request->user()->id)
        //     ->whereDate('date', Carbon::now())
        //     ->orderBy('id', 'desc')->first();

        // if ($lastHistory && $lastHistory->latitude == $request->latitude && $lastHistory->longitude == $request->longitude) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Data already exist',
        //     ], 402);
        // }

        $history = new LocationHistory();
        $history->user_id = $request->user()->id;
        $history->date = date('Y-m-d H:i:s');
        $history->latitude = $request->latitude;
        $history->longitude = $request->longitude;
        $history->save();

        $dateMax = Carbon::now()->subMinutes(10);
        $histories = LocationHistory::where('user_id', $history->user_id)
            ->where('date', '<=', $dateMax)->delete();

        return response()->json([
            'status' => true,
            'message' => 'OK',
            'data' => $history,
        ], 200);
    }
}
