@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row">

        @include('layouts.sidebar_admin')

        <div class="col-md-10">

            <div class="content p-4">

                <h2>Kelola Booking</h2>

                <hr>

                @if(session('success'))

                    <div class="alert alert-success">

                        {{ session('success') }}

                    </div>

                @endif

                <div class="card shadow">

                    <div class="card-body">

                        <table
                            class="table table-bordered table-striped">

                            <thead class="table-dark">

                                <tr>

                                    <th>Kode</th>
                                    <th>Pelanggan</th>
                                    <th>Lapangan</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Total</th>
                                    <th>Bukti</th>
                                    <th>Status</th>
                                    <th width="220">Aksi</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($booking as $row)

                                <tr>

                                    <td>
                                        {{ $row->kode_booking }}
                                    </td>

                                    <td>
                                        {{ $row->user->nama ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $row->lapangan->nama_lapangan ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $row->tanggal_booking }}
                                    </td>

                                    <td>
                                        {{ $row->jam_mulai }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($row->total_bayar) }}
                                    </td>

                                    <td>

                                        @if($row->bukti_pembayaran)

                                            <a href="{{ asset('storage/'.$row->bukti_pembayaran) }}"
                                               target="_blank">

                                                <img
                                                    src="{{ asset('storage/'.$row->bukti_pembayaran) }}"
                                                    width="80"
                                                    class="img-thumbnail">

                                            </a>

                                        @else

                                            -

                                        @endif

                                    </td>

                                    <td>

                                        @if($row->status == 'pending')

                                            <span class="badge bg-warning">
                                                Pending
                                            </span>

                                        @elseif($row->status == 'disetujui')

                                            <span class="badge bg-success">
                                                Disetujui
                                            </span>

                                        @elseif($row->status == 'ditolak')

                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>

                                        @elseif($row->status == 'selesai')

                                            <span class="badge bg-primary">
                                                Selesai
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        <a href="{{ route('admin.booking.status', [$row->id_booking,'disetujui']) }}"
                                           class="btn btn-success btn-sm">

                                            Approve

                                        </a>

                                        <a href="{{ route('admin.booking.status', [$row->id_booking,'ditolak']) }}"
                                           class="btn btn-danger btn-sm">

                                            Tolak

                                        </a>

                                        <a href="{{ route('admin.booking.status', [$row->id_booking,'selesai']) }}"
                                           class="btn btn-primary btn-sm">

                                            Selesai

                                        </a>

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