<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;

class LapanganController extends Controller
{
    public function index()
    {
        $lapangan = Lapangan::all();

        return view(
            'admin.lapangan.index',
            compact('lapangan')
        );
    }
}