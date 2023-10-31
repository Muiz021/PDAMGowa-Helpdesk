<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    public function dashboard_admin()
    {
        $pelanggan = User::where('roles', '=', 'user')->get();
        $pengaduan = Pengaduan::with('user')->get();
        return view('backend.pages.dashboard.dashboard', compact('pelanggan','pengaduan'));
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
        $user->no_hp = $request->no_hp;
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
        return redirect('/backend/admin/pelanggan');
    }
}
