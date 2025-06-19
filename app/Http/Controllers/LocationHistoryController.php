<?php

namespace App\Http\Controllers;

use App\Models\LocationHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LocationHistoryController extends Controller
{
    public function index()
    {
        $locations = LocationHistory::with('user')->latest()->paginate(100);
        return view('pages.location_histories.index', compact('locations'));
    }

    public function destroyAll()
    {
        LocationHistory::truncate();
        return redirect()->back()->with('success', 'Semua data lokasi berhasil dihapus.');
    }

    public function outOfRangeReport(Request $request)
{
    $month = $request->get('month', now()->month);
    $year = $request->get('year', now()->year);

    $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
    $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();

    $data = DB::table('location_histories')
        ->select('users.name', DB::raw('COUNT(*) as total_out_of_range'))
        ->join('users', 'location_histories.user_id', '=', 'users.id')
        ->where('is_out_of_range', true)
        ->whereBetween('date', [$startDate, $endDate])
        ->groupBy('users.name')
        ->orderByDesc('total_out_of_range')
        ->get();

    return view('pages.luar_area.laporan_range', compact('data', 'month', 'year'));
}


    public function show($id)
    {
        $location = LocationHistory::with('user')->findOrFail($id);
        return view('pages.location_histories.show', compact('location'));
    }
}
