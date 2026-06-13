<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AkunController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view(
            'pelanggan.akun',
            compact('user')
        );
    }

    public function edit()
    {
        $user = Auth::user();

        return view(
            'pelanggan.edit-akun',
            compact('user')
        );
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_hp' => 'nullable'
        ]);

        $user = Auth::user();

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp
        ]);

        return redirect()
            ->route('pelanggan.akun')
            ->with(
                'success',
                'Profil berhasil diperbarui'
            );
    }
}