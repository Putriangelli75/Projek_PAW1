<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Lapangan;

class LapanganController extends Controller
{
    public function index()
    {
        $lapangan = Lapangan::where('status', 'aktif')->get();

        return view('pelanggan.lapangan', compact('lapangan'));
    }
}