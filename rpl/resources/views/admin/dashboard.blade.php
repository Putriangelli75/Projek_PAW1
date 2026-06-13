@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row">

        @include('layouts.sidebar_admin')

        <div class="col-md-10">

            <div class="content">

                <div class="hero-banner mb-4">

                    <h1>Dashboard Admin</h1>

                    <p>
                        Kelola seluruh aktivitas booking lapangan
                        dengan mudah.
                    </p>

                </div>

                <div class="row">

                    <div class="col-md-4">

                        <div class="card shadow">

                            <div class="card-body text-center">

                                <h5>Total User</h5>

                                <h1>{{ $totalUser }}</h1>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="card shadow">

                            <div class="card-body text-center">

                                <h5>Total Lapangan</h5>

                                <h1>{{ $totalLapangan }}</h1>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="card shadow">

                            <div class="card-body text-center">

                                <h5>Total Booking</h5>

                                <h1>{{ $totalBooking }}</h1>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card mt-4 shadow">

                    <div class="card-header bg-success text-white">

                        Data Lapangan Terbaru

                    </div>

                    <div class="card-body">

                        <table class="table table-striped">

                            <thead>

                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Harga</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach($lapanganTerbaru as $lapangan)

                                <tr>

                                    <td>
                                        {{ $lapangan->id_lapangan }}
                                    </td>

                                    <td>
                                        {{ $lapangan->nama_lapangan }}
                                    </td>

                                    <td>
                                        {{ $lapangan->jenis_olahraga }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($lapangan->harga_per_jam) }}
                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection