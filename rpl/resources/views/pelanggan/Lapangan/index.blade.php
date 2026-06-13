<!-- resources/views/pelanggan/lapangan/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">

        @include('layouts.sidebar_pelanggan')

        <div class="col-md-10">

            <h2 class="mb-4">Booking Lapangan</h2>

            <div class="row">

                @foreach ($lapangan as $row)

                    <div class="col-md-4">

                        <div class="card shadow mb-4">

                            <img src="{{ asset('assets/img/banner.jpg') }}"
                                 height="180"
                                 style="object-fit:cover;">

                            <div class="card-body">

                                <h5>{{ $row->nama_lapangan }}</h5>

                                <p>{{ $row->jenis_olahraga }}</p>

                                <h4 class="text-success">
                                    Rp {{ number_format($row->harga_per_jam) }}
                                </h4>

                                <a href="{{ url('/pelanggan/booking/'.$row->id_lapangan) }}"
                                   class="btn btn-success w-100">
                                    Booking
                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</div>
@endsection