<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('backend.pages.dashboard.dashboardpelanggan', compact('user'));
    }

    public function pelanggan()
    {
        $user = User::where('roles', '=', 'user')->get();
        return view('backend.pages.pelanggan.index', compact('user'));
    }

    public function edit_pelanggan($id, Request $request)
    {
        $user = User::Where('id', $id)->first();

        $user->nama = $request->nama;
        $user->nosamb = $request->nosamb;
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

        $client = new Client();
        $url = "http://35.219.124.82:8080/message";

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
        $url = "http://35.219.124.82:8080/message";

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
