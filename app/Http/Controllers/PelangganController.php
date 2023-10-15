<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function pelanggan()
    {
        $user = User::where('roles', '=', 'user')->get();
        return view('backend.pages.pelanggan.index', compact('user'));
    }

    public function hapus_pelanggan($id)
    {
        $user = User::Where('id', $id)->first();
        $user->delete();
        return redirect('/backend/pelanggan');
    }
    
    public function updateStatus($id)
    {
        $user = User::findorfail($id);
        $user->update([
            "is_verification" => true
        ]);
        return redirect('/backend/pelanggan');
    }
}
