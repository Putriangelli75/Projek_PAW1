@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row">

        @include('layouts.sidebar_pelanggan')

        <div class="col-md-10">

            <div class="content">

                <div class="hero-banner mb-4">

                    <h2>
                        Halo, {{ $user->nama }}!
                    </h2>

                    <p>
                        Selamat datang kembali di SPLJ
                    </p>

                </div>

                <div class="row mb-4">

                    <div class="col-md-3">

                        <div class="card shadow">

                            <div class="card-body">

                                <h6>Total Booking</h6>

                                <h2>{{ $totalBooking }}</h2>

                                <small class="text-muted">
                                    Booking
                                </small>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="card shadow">

                            <div class="card-body">

                                <h6>Booking Aktif</h6>

                                <h2>{{ $bookingAktif }}</h2>

                                <small class="text-muted">
                                    Booking
                                </small>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="card shadow">

                            <div class="card-body">

                                <h6>Reward Point</h6>

                                <h2>{{ $user->poin }}</h2>

                                <small class="text-muted">
                                    Point
                                </small>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="card shadow">

                            <div class="card-body">

                                <h6>Member Status</h6>

                                <h3>
                                    {{ ucfirst($user->membership) }}
                                </h3>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="card shadow">

                            <div class="card-header">

                                <strong>
                                    Jadwal Terdekat
                                </strong>

                            </div>

                            <div class="card-body">

                                @forelse($jadwal as $item)

                                    <div class="border rounded p-3 mb-3">

                                        <h6>
                                            {{ $item->nama_lapangan }}
                                        </h6>

                                        <small>
                                            {{ date('d M Y', strtotime($item->tanggal_booking)) }}
                                        </small>

                                        <br>

                                        <small>
                                            {{ substr($item->jam_mulai,0,5) }}
                                        </small>

                                        <br><br>

                                        <span class="badge bg-success">
                                            {{ ucfirst($item->status) }}
                                        </span>

                                    </div>

                                @empty

                                    <p class="text-muted">
                                        Belum ada booking
                                    </p>

                                @endforelse

                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="card shadow">

                            <div class="card-header">

                                <strong>
                                    Promo Aktif
                                </strong>

                            </div>

                            <div class="card-body">

                                <div
                                    style="
                                    background:#198754;
                                    color:white;
                                    border-radius:15px;
                                    padding:30px;
                                    ">

                                    <h2>DISKON 20%</h2>

                                    <p>
                                        Untuk semua lapangan futsal
                                    </p>

                                    <p>
                                        Berlaku untuk member premium
                                    </p>

                                </div>

                                <div class="text-center mt-3">

                                    <a
                                        href="{{ route('pelanggan.lapangan') }}"
                                        class="btn btn-success">

                                        Booking Sekarang

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection