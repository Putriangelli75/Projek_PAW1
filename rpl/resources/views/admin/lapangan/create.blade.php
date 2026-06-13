@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row">

        @include('layouts.sidebar_admin')

        <div class="col-md-10">

            <div class="content p-4">

                <div class="card shadow">

                    <div class="card-header bg-success text-white">

                        <h4 class="mb-0">
                            Tambah Lapangan
                        </h4>

                    </div>

                    <div class="card-body">

                        @if ($errors->any())

                            <div class="alert alert-danger">

                                <ul class="mb-0">

                                    @foreach ($errors->all() as $error)

                                        <li>{{ $error }}</li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif

                        <form
                            action="{{ route('admin.lapangan.store') }}"
                            method="POST">

                            @csrf

                            <div class="mb-3">

                                <label class="form-label">
                                    Nama Lapangan
                                </label>

                                <input
                                    type="text"
                                    name="nama_lapangan"
                                    class="form-control"
                                    value="{{ old('nama_lapangan') }}"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Jenis Olahraga
                                </label>

                                <input
                                    type="text"
                                    name="jenis_olahraga"
                                    class="form-control"
                                    value="{{ old('jenis_olahraga') }}"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Harga Per Jam
                                </label>

                                <input
                                    type="number"
                                    name="harga_per_jam"
                                    class="form-control"
                                    min="1"
                                    value="{{ old('harga_per_jam') }}"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Status
                                </label>

                                <select
                                    name="status"
                                    class="form-control">

                                    <option value="aktif">
                                        Aktif
                                    </option>

                                    <option value="nonaktif">
                                        Non Aktif
                                    </option>

                                </select>

                            </div>

                            <div class="mt-4">

                                <a
                                    href="{{ route('admin.lapangan.index') }}"
                                    class="btn btn-secondary">

                                    Kembali

                                </a>

                                <button
                                    type="submit"
                                    class="btn btn-success">

                                    Simpan Lapangan

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection