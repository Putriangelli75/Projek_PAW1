@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-success text-white">
            Booking Lapangan
        </div>

        <div class="card-body">

            <h3>{{ $lapangan->nama_lapangan }}</h3>

            <form
                action="{{ route('pelanggan.booking.store', $lapangan->id_lapangan) }}"
                method="POST">

                @csrf

                <div class="mb-3">
                    <label>Tanggal Booking</label>

                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label>Jam Mulai</label>

                    <input
                        type="time"
                        name="jam"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label>Durasi</label>

                    <select
                        name="durasi"
                        class="form-control">

                        <option value="1">1 Jam</option>
                        <option value="2">2 Jam</option>
                        <option value="3">3 Jam</option>

                    </select>
                </div>

                <div class="alert alert-info">

                    <strong>Informasi:</strong><br>

                    Setelah booking berhasil dibuat,
                    silakan lakukan pembayaran DP melalui menu
                    Riwayat Booking.

                </div>

                <button
                    type="submit"
                    class="btn btn-success">

                    Booking Sekarang

                </button>

                <a
                    href="{{ route('pelanggan.dashboard') }}"
                    class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

@endsection