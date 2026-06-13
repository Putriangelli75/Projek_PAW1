@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header">

            <h4 class="mb-0">
                Edit Lapangan
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
                action="{{ route('admin.lapangan.update', $lapangan->id_lapangan) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        Nama Lapangan
                    </label>

                    <input
                        type="text"
                        name="nama_lapangan"
                        class="form-control"
                        value="{{ old('nama_lapangan', $lapangan->nama_lapangan) }}"
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
                        value="{{ old('jenis_olahraga', $lapangan->jenis_olahraga) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Harga per Jam
                    </label>

                    <input
                        type="number"
                        name="harga_per_jam"
                        class="form-control"
                        value="{{ old('harga_per_jam', $lapangan->harga_per_jam) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-control">

                        <option
                            value="aktif"
                            {{ $lapangan->status == 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option
                            value="nonaktif"
                            {{ $lapangan->status == 'nonaktif' ? 'selected' : '' }}>
                            Non Aktif
                        </option>

                    </select>

                </div>

                <div class="d-flex gap-2">

                    <a
                        href="{{ route('admin.lapangan.index') }}"
                        class="btn btn-secondary">

                        ← Kembali

                    </a>

                    <button
                        type="submit"
                        class="btn btn-warning">

                        Update

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection