<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BookingController extends Controller
{
    public function create($id)
    {
        $lapangan = Lapangan::findOrFail($id);

        return view(
            'pelanggan.booking.create',
            compact('lapangan')
        );
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required',
            'durasi' => 'required|integer|min:1'
        ]);

        $lapangan = Lapangan::findOrFail($id);

        $total = $lapangan->harga_per_jam * $request->durasi;

        Booking::create([
            'kode_booking' => 'BK' . time(),
            'id_user' => Auth::id(),
            'id_lapangan' => $id,
            'tanggal_booking' => $request->tanggal,
            'jam_mulai' => $request->jam,
            'durasi' => $request->durasi,
            'total_bayar' => $total,
            'status' => 'pending'
        ]);

        Auth::user()->increment('poin', 10);

        return redirect()
            ->route('pelanggan.riwayat')
            ->with('success', 'Booking berhasil dibuat');
    }


    ## Riwayat Booking
    public function riwayat()
    {
        $user = Auth::user();

        if ($user->role !== 'pelanggan') {
            return redirect('/login');
        }

        $data = DB::table('booking as b')
            ->join('lapangan as l', 'b.id_lapangan', '=', 'l.id_lapangan')
            ->where('b.id_user', $user->id)
            ->where('b.status', '!=', 'dibatalkan')
            ->orderBy('b.id_booking', 'desc')
            ->select(
                'b.*',
                'l.nama_lapangan',
                'l.jenis_olahraga',
                'l.gambar'
            )
            ->get();

        return view('booking.riwayat', compact('data'));
    }

    ## Batal Booking
    public function batal($id)
    {
        $user = Auth::user();

        if ($user->role !== 'pelanggan') {
            return redirect('/login');
        }

        $deleted = DB::table('booking')
            ->where('id_booking', $id)
            ->where('id_user', $user->id)
            ->delete();

        return redirect('/riwayat-booking')
            ->with('success', 'Booking berhasil dibatalkan');
    }

    ## Pembayaran
    public function formPembayaran($id)
    {
        $user = Auth::user();

        $data = DB::table('booking as b')
            ->join('lapangan as l', 'b.id_lapangan', '=', 'l.id_lapangan')
            ->where('b.id_booking', $id)
            ->where('b.id_user', $user->id_user)
            ->select('b.*', 'l.nama_lapangan', 'l.jenis_olahraga', 'l.gambar')
            ->first();

        if (!$data) {
            abort(404, 'Data booking tidak ditemukan');
        }

        return view('booking.pembayaran', compact('data'));
    }

    public function uploadPembayaran(Request $request, $id)
    {
        $request->validate([
            'metode' => 'required',
            'bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        $booking = DB::table('booking')
            ->where('id_booking', $id)
            ->where('id_user', $user->id_user)
            ->first();

        if (!$booking) {
            abort(404);
        }

        // upload file
        $file = $request->file('bukti');
        $namaFile = time() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('uploads'), $namaFile);

        // update database
        DB::table('booking')
            ->where('id_booking', $id)
            ->update([
                'bukti_pembayaran' => $namaFile,
                'metode_pembayaran' => $request->metode,
            ]);

        return redirect('/riwayat-booking')
            ->with('success', 'Bukti pembayaran berhasil dikirim');
    }
}
