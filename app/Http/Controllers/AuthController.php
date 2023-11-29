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
        $request->validate(
            [
                'nama' => 'required',
                'no_whatsapp' => 'required|numeric|digits_between:10,13|unique:users',
                'username' => 'required|unique:users',
                'password' => 'required',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'no_whatsapp.required' => 'No whatsapp tidak boleh kosong',
                'no_whatsapp.numeric' => 'No whatsapp harus menggunakan angka',
                'no_whatsapp.digits_between' => 'No whatsapp harus terdiri dari 10 hingga 13 angka',
                'no_whatsapp.unique' => 'No whatsapp sudah digunakan oleh pengguna lain',
                'username.required' => 'Username tidak boleh kosong',
                'username.unique' => 'Username sudah digunakan oleh pengguna lain',
                'password.required' => 'Password tidak boleh kosong',
            ]
        );

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

    public function update_profil($id, Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_whatsapp' => 'required|numeric|digits_between:10,13|unique:users,no_whatsapp,' . $id,
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'nullable', // Allow the password to be nullable
            'nik' => 'nullable|numeric|digits_between:0,16|unique:users,nik,' . $id,
            'nosamb' => 'nullable|numeric|digits_between:0,10',
            'alamat' => 'nullable',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'no_whatsapp.required' => 'No whatsapp tidak boleh kosong',
            'no_whatsapp.numeric' => 'No whatsapp harus menggunakan angka',
            'no_whatsapp.digits_between' => 'No whatsapp harus terdiri dari 10 hingga 13 angka',
            'no_whatsapp.unique' => 'No whatsapp sudah digunakan oleh pengguna lain',
            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username sudah digunakan oleh pengguna lain',
            'nik.numeric' => 'NIK harus menggunakan angka',
            'nik.digits_between' => 'NIK tidak boleh lebih dari 16 digit',
            'nik.unique' => 'NIK sudah digunakan oleh pengguna lain',
            'nosamb.numeric' => 'No. Sambungan harus menggunakan angka',
            'nosamb.digits_between' => 'No. Sambungan tidak boleh lebih dari 10 digit',
        ]);

        $user = User::findOrFail($id);

        // Update user data
        $userData = [
            'nama' => $request->nama,
            'username' => $request->username,
            'no_whatsapp' => $request->no_whatsapp,
            'nik' => $request->nik,
            'nosamb' => $request->nosamb,
            'alamat' => $request->alamat,
        ];

        // Check if a new password is provided
        if ($request->filled('password')) {
            // Hash and update the password
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('dashboard.user');
    }
}
