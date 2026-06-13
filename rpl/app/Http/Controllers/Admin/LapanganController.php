<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use Illuminate\Http\Request;


class LapanganController extends Controller
{
    public function index()
    {
        $lapangan = Lapangan::all();

        return view(
            'admin.lapangan.index',
            compact('lapangan')
        );
    }

    public function edit($id)
    {
        $lapangan = \App\Models\Lapangan::findOrFail($id);

        return view(
            'admin.lapangan.edit',
            compact('lapangan')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lapangan' => 'required',
            'jenis_olahraga' => 'required',
            'harga_per_jam' => 'required|numeric',
            'status' => 'required'
        ]);

        $lapangan = \App\Models\Lapangan::findOrFail($id);

        $lapangan->update([
            'nama_lapangan' => $request->nama_lapangan,
            'jenis_olahraga' => $request->jenis_olahraga,
            'harga_per_jam' => $request->harga_per_jam,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.lapangan.index')
            ->with('success', 'Data lapangan berhasil diperbarui');
    }

    public function create()
    {
        return view('admin.lapangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lapangan' => 'required',
            'jenis_olahraga' => 'required',
            'harga_per_jam' => 'required|numeric|min:1',
            'status' => 'required'
        ]);

        Lapangan::create([
            'nama_lapangan' => $request->nama_lapangan,
            'jenis_olahraga' => $request->jenis_olahraga,
            'harga_per_jam' => $request->harga_per_jam,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.lapangan.index')
            ->with('success', 'Lapangan berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Lapangan::findOrFail($id)->delete();

        return redirect()
            ->route('admin.lapangan.index')
            ->with('success', 'Lapangan berhasil dihapus');
    }
}
