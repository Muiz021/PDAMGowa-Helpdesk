<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        // if(tanggal sekarang = tanggal 1 bulan 1 tahun 2024){
        //     user = admin
        //     if (user->is_send == false) {
        //         kirim email ke pimpinan
        //         // Dapatkan data berdasarkan rentang waktu
        //         $data = Pengaduan::whereBetween('tanggal', [$request->start_date, $request->end_date])->get();
        //         $start = tanggal 1 bulan 1 tahun 2024;
        //         $end = tanggal 31 bulan 1 tahun 2024;

        //         // Tampilkan data dalam PDF
        //         $pdf = PDF::loadView('backend.pages.pengaduan.pdf',compact('data','start','end'));

        //         return $pdf->download("pengaduan_periode_" . Carbon::parse($request->start_date)->isoFormat('DD_MMMM_YYYY') . "/" . Carbon::parse($request->end_date)->isoFormat('DD_MMMM_YYYY') . ".pdf");
        //         user->is_send = true
        //         update
        //     }
        // }
        // if(tanggal sekarang = tanggal 1 bulan 2 tahun 2024){
        //     user = admin
        //     if (user->bulan_2 == false) {
        //         kirim email ke pimpinan
        //         user->bulan_2 = true
        //         update
        //     }
        // }
        // if(tanggal sekarang = tanggal 1 bulan 3 tahun 2024){
        //     user = admin
        //     user->bulan_2 = false
        //     update
        //     if (user->is_send == false) {
        //         kirim email ke pimpinan
        //         user->is_send = true
        //         update
        //     }
        // }

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
        $nosamb = User::where('roles', 'user')->where('nosamb', $request->nosamb)->where('is_verification', true)->first();

        if ($nosamb) {
            $client = new Client();
            $url = "http://8.215.24.202:8080/message";

            $wa = $request->no_whatsapp;
            $message = "No. Sambungan telah digunakan, Silahkan Gunakan No. Sambungan Lain";

            $body = [
                'phoneNumber' => $wa,
                'message' => $message,
            ];

            $client->request('POST', $url, [
                'form_params' => $body,
                'verify'  => false,
            ]);

            return redirect()->back()->with('pesan-danger', 'No. Sambungan telah digunakan');
        }

        $request->validate(
            [
                'nama' => 'required',
                'nosamb' => 'required|numeric|digits_between:0,10',
                'no_whatsapp' => 'required|numeric|digits_between:10,13|unique:users',
                'username' => 'required|unique:users',
                'password' => 'required',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'nosamb.required' => 'No Sambungan tidak boleh kosong',
                'nosamb.numeric' => 'No Sambungan harus menggunakan angka',
                'nosamb.digits_between' => 'No. Sambungan tidak boleh lebih dari 10 digit',
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
        $user->nosamb = $request->nosamb;

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
        ]);

        $user = User::findOrFail($id);

        // Update user data
        $userData = [
            'nama' => $request->nama,
            'username' => $request->username,
            'no_whatsapp' => $request->no_whatsapp,
            'nik' => $request->nik,
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
