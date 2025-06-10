<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LocationHistory;
use Carbon\Carbon;

class LocationHistoryController extends Controller
{
    public function updateLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required|string',
            'longitude' => 'required|string',
        ]);

        // Simpan lokasi baru
        $history = new LocationHistory();
        $history->user_id = $request->user()->id;
        $history->date = date('Y-m-d H:i:s');
        $history->latitude = $request->latitude;
        $history->longitude = $request->longitude;
        $history->save();

        // Cek jumlah total data user
        $count = LocationHistory::where('user_id', $request->user()->id)->count();

        // Jika sudah lebih dari 50 data, hapus 1 data paling lama
        if ($count > 50) {
            $oldest = LocationHistory::where('user_id', $request->user()->id)
                ->orderBy('date', 'asc')
                ->first();

            if ($oldest) {
                $oldest->delete();
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'OK',
            'data' => $history,
        ], 200);
    }
}
