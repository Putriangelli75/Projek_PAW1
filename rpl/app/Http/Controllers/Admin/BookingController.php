<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $booking = Booking::with([
            'user',
            'lapangan'
        ])
        ->latest('id_booking')
        ->get();

        return view(
            'admin.booking.index',
            compact('booking')
        );
    }

    public function updateStatus(
        $id,
        $status
    ) {

        $booking = Booking::findOrFail($id);

        $booking->update([
            'status' => $status
        ]);

        return redirect()
            ->route('admin.booking.index')
            ->with(
                'success',
                'Status berhasil diperbarui'
            );
    }
}