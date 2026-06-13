<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalBooking = Booking::where(
            'id_user',
            $user->id_user
        )->count();

        $bookingAktif = Booking::where(
            'id_user',
            $user->id_user
        )
        ->whereIn('status', [
            'pending',
            'disetujui'
        ])
        ->count();

        $jadwal = Booking::join(
                'lapangan',
                'booking.id_lapangan',
                '=',
                'lapangan.id_lapangan'
            )
            ->where(
                'booking.id_user',
                $user->id_user
            )
            ->whereIn(
                'booking.status',
                ['pending', 'disetujui']
            )
            ->orderBy(
                'booking.tanggal_booking'
            )
            ->orderBy(
                'booking.jam_mulai'
            )
            ->limit(3)
            ->get([
                'booking.*',
                'lapangan.nama_lapangan'
            ]);

        return view(
            'pelanggan.dashboard',
            compact(
                'user',
                'totalBooking',
                'bookingAktif',
                'jadwal'
            )
        );
    }
}