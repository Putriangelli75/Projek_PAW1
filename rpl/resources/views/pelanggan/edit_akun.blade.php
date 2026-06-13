@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-success text-white">

            Edit Profil

        </div>

        <div class="card-body">

            <form
                action="{{ route('pelanggan.update-akun') }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Nama</label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        value="{{ old('nama', $user->nama) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $user->email) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label>No HP</label>

                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        value="{{ old('no_hp', $user->no_hp) }}">

                </div>

                <button
                    type="submit"
                    class="btn btn-success">

                    Simpan

                </button>

                <a
                    href="{{ route('pelanggan.akun') }}"
                    class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

@endsection