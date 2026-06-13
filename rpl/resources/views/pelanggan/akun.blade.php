@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row">

        @include('layouts.sidebar_pelanggan')

        <div class="col-md-10">

            <div class="content p-4">

                <div class="card shadow">

                    <div class="card-header bg-success text-white">
                        Akun Saya
                    </div>

                    <div class="card-body">

                        <div class="d-flex align-items-center mb-4">

                            <form
                                action="{{ route('pelanggan.upload-foto') }}"
                                method="POST"
                                enctype="multipart/form-data">

                                @csrf

                                <label
                                    for="foto"
                                    style="cursor:pointer;">

                                    @if($user->foto)

                                        <img
                                            src="{{ asset('storage/foto/'.$user->foto) }}"
                                            style="
                                                width:90px;
                                                height:90px;
                                                border-radius:50%;
                                                object-fit:cover;
                                                border:3px solid #198754;
                                            ">

                                    @else

                                        <div
                                            style="
                                                width:90px;
                                                height:90px;
                                                border-radius:50%;
                                                background:#198754;
                                                color:white;
                                                display:flex;
                                                align-items:center;
                                                justify-content:center;
                                                font-size:40px;
                                            ">

                                            👤

                                        </div>

                                    @endif

                                </label>

                                <input
                                    type="file"
                                    id="foto"
                                    name="foto"
                                    accept=".jpg,.jpeg,.png"
                                    style="display:none;"
                                    onchange="this.form.submit();">

                            </form>

                            <div class="ms-3">

                                <h4 class="mb-1">
                                    {{ $user->nama }}
                                </h4>

                                <small class="text-muted">
                                    {{ $user->email }}
                                </small>

                            </div>

                        </div>

                        <table class="table">

                            <tr>
                                <td width="200">No HP</td>
                                <td>{{ $user->no_hp }}</td>
                            </tr>

                            <tr>
                                <td>Membership</td>
                                <td>{{ ucfirst($user->membership) }}</td>
                            </tr>

                            <tr>
                                <td>Reward Point</td>
                                <td>{{ $user->poin }}</td>
                            </tr>

                        </table>

                        <a
                            href="{{ route('pelanggan.edit-akun') }}"
                            class="btn btn-success">

                            Edit Profil

                        </a>

                        <a
                            href="{{ route('pelanggan.ubah-password') }}"
                            class="btn btn-warning">

                            Ubah Password

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection