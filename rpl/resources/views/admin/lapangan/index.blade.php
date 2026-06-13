@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row">

        @include('layouts.sidebar_admin')

        <div class="col-md-10">

            <div class="content">

                <div class="d-flex justify-content-between">

                    <h2>Kelola Lapangan</h2>

                    <a
                        href="{{ route('admin.lapangan.create') }}"
                        class="btn btn-success">

                        Tambah Lapangan

                    </a>

                </div>

                <hr>

                <table
                    class="table table-bordered table-striped">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Nama Lapangan</th>
                            <th>Jenis</th>
                            <th>Harga/Jam</th>
                            <th>Status</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($lapangan as $row)

                        <tr>

                            <td>
                                {{ $row->id_lapangan }}
                            </td>

                            <td>
                                {{ $row->nama_lapangan }}
                            </td>

                            <td>
                                {{ $row->jenis_olahraga }}
                            </td>

                            <td>

                                Rp
                                {{ number_format($row->harga_per_jam) }}

                            </td>

                            <td>

                                {{ $row->status }}

                            </td>

                            <td>

                                <a
                                    href="{{ route('admin.lapangan.edit', $row->id_lapangan) }}"
                                    class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('admin.lapangan.destroy', $row->id_lapangan) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection