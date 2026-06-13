@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="row">

        <!-- DETAIL -->
        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-dark text-white">
                    Detail Booking
                </div>

                <div class="card-body">

                    @if(!empty($data->gambar))
                        <img src="{{ asset('uploads/'.$data->gambar) }}"
                             class="img-fluid rounded mb-3">
                    @endif

                    <table class="table">

                        <tr>
                            <td>Kode Booking</td>
                            <td>{{ $data->kode_booking }}</td>
                        </tr>

                        <tr>
                            <td>Lapangan</td>
                            <td>{{ $data->nama_lapangan }}</td>
                        </tr>

                        <tr>
                            <td>Jenis</td>
                            <td>{{ $data->jenis_olahraga }}</td>
                        </tr>

                        <tr>
                            <td>Tanggal</td>
                            <td>{{ $data->tanggal_booking }}</td>
                        </tr>

                        <tr>
                            <td>Jam</td>
                            <td>{{ $data->jam_mulai }}</td>
                        </tr>

                        <tr>
                            <td>Durasi</td>
                            <td>{{ $data->durasi }} Jam</td>
                        </tr>

                        <tr>
                            <td>Total Biaya</td>
                            <td>Rp {{ number_format($data->total_bayar) }}</td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

        <!-- FORM -->
        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-dark text-white">
                    Upload Bukti Pembayaran DP
                </div>

                <div class="card-body">

                    <form method="POST"
                          action="{{ url('/pembayaran/'.$data->id_booking) }}"
                          enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">
                            <label>Nominal Transfer</label>
                            <input type="text"
                                   class="form-control"
                                   value="Rp {{ number_format($data->total_bayar * 0.5) }}"
                                   readonly>
                        </div>

                        <div class="mb-3">
                            <label>Metode Pembayaran</label>

                            <select name="metode" class="form-control" required>
                                <option>Transfer Bank BCA</option>
                                <option>Transfer Bank BRI</option>
                                <option>Transfer Bank Mandiri</option>
                                <option>Transfer Bank BNI</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Upload Bukti Transfer</label>

                            <input type="file"
                                   name="bukti"
                                   class="form-control"
                                   accept=".jpg,.jpeg,.png"
                                   required>
                        </div>

                        <button class="btn btn-success w-100">
                            Kirim Bukti Pembayaran
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection