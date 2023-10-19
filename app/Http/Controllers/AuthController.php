<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('backend.pages.login.login');
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            if (Auth::user()->roles == 'admin') {
                return redirect('/backend/admin/dashboard');
            } else {
                if (auth()->user()->roles == 'user' && auth()->user()->is_verification == 1) {
                    return redirect('/backend/user/dashboard-pelanggan');
                } else {
                    Auth::logout();
                    return back()->with('pesan-danger', 'Akun anda belum di verifikasi oleh admin');
                }
            }
        }
        return back()->withErrors([
            'password' => 'Username atau Password anda salah',
        ]);
    }

    public function register()
    {
        return view('backend.pages.register.register');
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_whatsapp' => 'required|min:10|numeric|digits:12',
            'username' => 'required',
            'password' => 'required',
        ],
    [
        'nama.required' => 'Nama tidak boleh kosong',
        'no_whatsapp.required' => 'No whatsapp tidak boleh kosong',
        'no_whatsapp.min' => 'No whatsapp tidak boleh kurang dari 10 angka',
        'no_whatsapp.digits' => 'No whatsapp tidak boleh lebih dari 12 angka',
        'no_whatsapp.numeric' => 'No whatsapp harus menggunakan angka',
        'username.required' => 'Username tidak boleh kosong',
        'password.required' => 'Password tidak boleh kosong',
    ]);

        $user = new User();

        $user->roles = 'user';
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->nama = $request->nama;
        $user->no_whatsapp = $request->no_whatsapp;

        $user->save();
        return redirect('/login')->with('pesan-success', 'Akun berhasil di buat, Tunggu akun di verifikasi oleh admin');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function update_profil($id,Request $request)
    {
        $user = User::findOrfail($id);
        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'no_whatsapp' => $request->no_whatsapp,
            'nik' => $request->nik,
            'nosamb' => $request->nosamb,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('dashboard.user');
    }
}
