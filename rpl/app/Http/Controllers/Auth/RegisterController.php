<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama'     => 'required|max:255',
            'email'    => 'required|email|unique:users,email',
            'no_hp'    => 'nullable|max:20',
            'password' => 'required|min:6'
        ]);

        User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'no_hp'    => $request->no_hp,
            'password' => Hash::make($request->password),
            'role'     => 'pelanggan'
        ]);

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Akun berhasil dibuat! Silakan login.'
            );
    }
}