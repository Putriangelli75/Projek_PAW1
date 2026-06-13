<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


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

    ## Ubah Password
    public function editPassword()
    {
        $user = Auth::user();

        if ($user->role !== 'pelanggan') {
            return redirect('/login');
        }

        return view('pelanggan.ubah_password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'pelanggan') {
            return redirect('/login');
        }

        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6',
            'konfirmasi' => 'required|same:password_baru',
        ]);

        // cek password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->with('error', 'Password lama salah');
        }

        // update password
        DB::table('users')
            ->where('id_user', $user->id_user)
            ->update([
                'password' => Hash::make($request->password_baru)
            ]);

        return redirect('/akun/password')
            ->with('success', 'Password berhasil diubah');
    }
}
