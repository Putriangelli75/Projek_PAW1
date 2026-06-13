@extends('layouts.app')

@section('content')
<div class="container-fluid">

<style>
.booking-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
}

.booking-img{
    width:100%;
    height:220px;
    object-fit:cover;
    border-radius:15px;
}

.booking-card table td{
    border:none;
    padding:6px 0;
}

.status-badge{
    padding:8px 15px;
    font-size:14px;
}
</style>

<div class="row">

    @include('layouts.sidebar_pelanggan')

    <div class="col-md-10">
        <div class="content p-4">

            <h2 class="mb-4">Riwayat Booking</h2>

            @foreach($data as $row)
            <div class="card shadow-sm booking-card mb-4">
                <div class="card-body p-4">

                    <div class="row align-items-center">

                        {{-- FOTO --}}
                        <div class="col-md-3">
                            @if(!empty($row->gambar))
                                <img src="{{ asset('uploads/'.$row->gambar) }}" class="booking-img">
                            @else
                                <img src="{{ asset('assets/img/banner.jpg') }}" class="booking-img">
                            @endif
                        </div>

                        {{-- DETAIL --}}
                        <div class="col-md-9">

                            <div class="d-flex justify-content-between align-items-center">

                                <h4 class="mb-0">Detail Booking</h4>

                                @if($row->status == 'disetujui')
                                    <span class="badge bg-success status-badge">Confirmed</span>
                                @elseif($row->status == 'pending')
                                    <span class="badge bg-warning text-dark status-badge">Pending</span>
                                @elseif($row->status == 'ditolak')
                                    <span class="badge bg-danger status-badge">Ditolak</span>
                                @elseif($row->status == 'selesai')
                                    <span class="badge bg-primary status-badge">Selesai</span>
                                @endif

                            </div>

                            <hr>

                            <table class="table table-borderless">
                                <tr>
                                    <td width="180"><b>Kode Booking</b></td>
                                    <td>{{ $row->kode_booking }}</td>
                                </tr>

                                <tr>
                                    <td><b>Lapangan</b></td>
                                    <td>{{ $row->nama_lapangan }}</td>
                                </tr>

                                <tr>
                                    <td><b>Jenis Olahraga</b></td>
                                    <td>{{ $row->jenis_olahraga }}</td>
                                </tr>

                                <tr>
                                    <td><b>Tanggal</b></td>
                                    <td>{{ \Carbon\Carbon::parse($row->tanggal_booking)->format('d M Y') }}</td>
                                </tr>

                                <tr>
                                    <td><b>Jam Mulai</b></td>
                                    <td>{{ $row->jam_mulai }}</td>
                                </tr>

                                <tr>
                                    <td><b>Durasi</b></td>
                                    <td>{{ $row->durasi }} Jam</td>
                                </tr>

                                <tr>
                                    <td><b>Total Biaya</b></td>
                                    <td>Rp {{ number_format($row->total_bayar) }}</td>
                                </tr>
                            </table>

                            @if($row->status == 'pending')
                                <div class="mt-3">

                                    <a href="{{ url('/verifikasi-pembayaran/'.$row->id_booking) }}"
                                       class="btn btn-success">
                                        DP Sekarang
                                    </a>

                                    <a href="{{ url('/batal-booking/'.$row->id_booking) }}"
                                       class="btn btn-outline-danger"
                                       onclick="return confirm('Batalkan booking ini?')">
                                        Batalkan Booking
                                    </a>

                                </div>
                            @endif

                        </div>

                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>

</div>

</div>
@endsection