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
                return redirect('/backend/dashboard');
            } else {
                if (auth()->user()->roles == 'user' && auth()->user()->is_verification == 1) {
                    return redirect('/dashboard-pelanggan');
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
        $user = new User();

        $user->roles = 'user';
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->nama = $request->nama;
        $user->nosamb = $request->nosamb;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;

        $user->save();
        return redirect('/login')->with('pesan-success', 'Akun berhasil di buat, Tunggu akun di verifikasi oleh admin');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
