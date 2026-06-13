<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lapangan;
use App\Models\Booking;
use App\Models\User;

class BookingController extends Controller
{
    public function create($id)
    {
        $lapangan = Lapangan::find($id);

        if (!$lapangan) {
            abort(404);
        }

        return view(
            'pelanggan.booking.create',
            compact('lapangan')
        );
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam'     => 'required',
            'durasi'  => 'required|integer'
        ]);

        $lapangan = Lapangan::findOrFail($id);

        $total = $lapangan->harga_per_jam
                 * $request->durasi;

        $kode = 'BK' . time();

        Booking::create([

            'kode_booking'    => $kode,
            'id_user'         => Auth::id(),
            'id_lapangan'     => $id,
            'tanggal_booking' => $request->tanggal,
            'jam_mulai'       => $request->jam,
            'durasi'          => $request->durasi,
            'total_bayar'     => $total,
            'status'          => 'pending'

        ]);

        User::where(
            'id_user',
            Auth::id()
        )->increment('poin', 10);

        return redirect()
            ->route('pelanggan.riwayat-booking')
            ->with(
                'success',
                'Booking berhasil dibuat'
            );
    }
}