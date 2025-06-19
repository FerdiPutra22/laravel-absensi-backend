<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LocationHistory;
use App\Models\Company;

class LocationHistoryController extends Controller
{
    public function updateLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required|string',
            'longitude' => 'required|string',
        ]);

        $user = $request->user();

        // Ambil data company (asumsi hanya satu perusahaan di sistem)
        $company = Company::first();
        if (!$company) {
            return response()->json([
                'status' => false,
                'message' => 'Company data not found.',
            ], 404);
        }

        // Konversi koordinat ke float
        $lat1 = floatval($request->latitude);
        $lon1 = floatval($request->longitude);
        $lat2 = floatval($company->latitude);
        $lon2 = floatval($company->longitude);

        // Hitung jarak antar koordinat (dalam kilometer)
        $distance = $this->calculateDistance($lat1, $lon1, $lat2, $lon2);

        // Bandingkan dengan radius dari company
        $isOutOfRange = $distance > $company->radius_km;

        // Simpan data lokasi ke database
        $history = new LocationHistory();
        $history->user_id = $user->id;
        $history->date = now();
        $history->latitude = $lat1;
        $history->longitude = $lon1;
        $history->is_out_of_range = $isOutOfRange;
        $history->save();

        return response()->json([
            'status' => true,
            'message' => 'Lokasi berhasil diperbarui',
            'data' => $history,
            'distance_km' => round($distance, 3),
            'is_out_of_range' => $isOutOfRange,
        ]);
    }

    /**
     * Menghitung jarak antara dua titik koordinat dengan Haversine formula.
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // in kilometers

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return $distance;
    }
    
}
