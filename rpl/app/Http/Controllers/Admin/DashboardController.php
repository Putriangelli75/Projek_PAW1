<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lapangan;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();

        $totalLapangan = Lapangan::count();

        $totalBooking = Booking::count();

        $lapanganTerbaru = Lapangan::orderBy(
            'id_lapangan',
            'desc'
        )->take(5)->get();

        return view(
            'admin.dashboard',
            compact(
                'totalUser',
                'totalLapangan',
                'totalBooking',
                'lapanganTerbaru'
            )
        );
    }
}