@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-warning">
            Ubah Password
        </div>

        <div class="card-body">

            {{-- ERROR --}}
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ url('/akun/password') }}">
                @csrf

                <div class="mb-3">
                    <label>Password Lama</label>
                    <input type="password" name="password_lama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password Baru</label>
                    <input type="password" name="password_baru" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="konfirmasi" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-warning">
                    Ubah Password
                </button>

                <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>
@endsection