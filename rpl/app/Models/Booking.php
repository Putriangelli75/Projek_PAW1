<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';

    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'kode_booking',
        'id_user',
        'id_lapangan',
        'tanggal_booking',
        'jam_mulai',
        'durasi',
        'total_bayar',
        'status',
        'bukti_pembayaran',
        'metode_pembayaran'
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }

    public function lapangan()
    {
        return $this->belongsTo(
            Lapangan::class,
            'id_lapangan',
            'id_lapangan'
        );
    }
}