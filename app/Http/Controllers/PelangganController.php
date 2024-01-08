<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PelangganController extends Controller
{
    public function dashboard_admin()
    {
        $pelanggan = User::where('roles', '=', 'user')->get();
        $pengaduan = Pengaduan::with('user')->get();
        return view('backend.pages.dashboard.dashboard', compact('pelanggan', 'pengaduan'));
    }

    public function dashboard_pelanggan()
    {
        $user = Auth::user();
        if ($user->nik == null || $user->alamat == null || $user->no_whatsapp == null) {
            Alert::info("Info", "Silahkan lengkapi data diri terlebih dahulu");
        }
        return view('backend.pages.dashboard.dashboardpelanggan', compact('user'));
    }

    public function pelanggan()
    {
        $user = User::where('roles', '=', 'user')->get();
        return view('backend.pages.pelanggan.index', compact('user'));
    }

    public function edit_pelanggan($id, Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'no_whatsapp' => 'nullable|numeric|digits_between:10,13|unique:users,no_whatsapp,' . $id,
                'alamat' => 'nullable',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'no_whatsapp.required' => 'No whatsapp tidak boleh kosong',
                'no_whatsapp.numeric' => 'No whatsapp harus menggunakan angka',
                'no_whatsapp.digits_between' => 'No whatsapp harus terdiri dari 10 hingga 13 angka',
                'no_whatsapp.unique' => 'No whatsapp sudah digunakan oleh pengguna lain',
            ]
        );

        $user = User::Where('id', $id)->first();

        $user->nama = $request->nama;
        $user->no_whatsapp = $request->no_whatsapp;
        $user->alamat = $request->alamat;

        $user->update();
        return redirect('/backend/admin/pelanggan');
    }

    public function hapus_pelanggan($id)
    {
        $user = User::Where('id', $id)->first();
        $user->delete();
        return redirect('/backend/admin/pelanggan');
    }

    public function updateStatus($id)
    {
        $user = User::findorfail($id);

        $user->update([
            "is_verification" => true
        ]);

        $nosamb = User::where('roles', 'user')->where('nosamb', $user->nosamb)->where('is_verification', false)->get();
        foreach ($nosamb as $item) {
            $client = new Client();
            $url = "http://8.215.24.202:8080/message";

            $wa = $item->no_whatsapp;
            $message = "Verifikasi anda gagal. No. Sambungan telah digunakan, Silahkan Gunakan No. Sambungan Lain";

            $body = [
                'phoneNumber' => $wa,
                'message' => $message,
            ];

            $client->request('POST', $url, [
                'form_params' => $body,
                'verify'  => false,
            ]);

            $item->delete();
        }

        $client = new Client();
        $url = "http://8.215.24.202:8080/message";

        $wa = $user->no_whatsapp;
        $message = "Akun Anda Telah Di Verifikasi Oleh Admin PDAM";

        $body = [
            'phoneNumber' => $wa,
            'message' => $message,
        ];

        $client->request('POST', $url, [
            'form_params' => $body,
            'verify'  => false,
        ]);

        return redirect('/backend/admin/pelanggan');
    }

    public function kirimInfo(Request $request)
    {
        $client = new Client();
        $url = "http://8.215.24.202:8080/message";

        $user = User::where('roles', 'user')->get();

        foreach ($user as $item) {
            $wa = $item->no_whatsapp;
            $message = $request->message;

            $body = [
                'phoneNumber' => $wa,
                'message' => $message,
            ];

            $client->request('POST', $url, [
                'form_params' => $body,
                'verify'  => false,
            ]);
        }

        return redirect('/backend/admin/pelanggan');
    }
}
