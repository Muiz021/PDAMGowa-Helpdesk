<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pengaduan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaduans = Pengaduan::get();
        $airTidakMengalir = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'air_tidak_mengalir')->where('status_pengaduan', 0)->first();
        $airKeruh = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'air_keruh')->where('status_pengaduan', 0)->first();
        $keberatanBayar = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'keberatan_bayar')->where('status_pengaduan', 0)->first();
        $pembenahanSambungan = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'pembenahan_sambungan')->where('status_pengaduan', 0)->first();

        return view('backend.pages.pengaduan.index', compact('pengaduans', 'airTidakMengalir', 'airKeruh', 'keberatanBayar', 'pembenahanSambungan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_pengaduan' => 'required',
            'bukti_pengaduan' => 'required',
        ]);

        $user_id = Auth::user()->id;
        if ($request->jenis_pengaduan == '1') {
            $jenis_pengaduan = 'air_tidak_mengalir';
        } else if ($request->jenis_pengaduan == '2') {
            $jenis_pengaduan = 'air_keruh';
        } else if ($request->jenis_pengaduan == '3') {
            $jenis_pengaduan = 'keberatan_bayar';
        } else if ($request->jenis_pengaduan == '4') {
            $jenis_pengaduan = 'pembenahan_sambungan';
        }

        $foto = $request->file('bukti_pengaduan');
        $destinationPath = 'images/';
        $baseURL = url('/');
        $profileImage = $baseURL . "/images/" . Str::slug($jenis_pengaduan) . '-' . Carbon::now()->format('YmdHis') . "." . $foto->getClientOriginalExtension();
        $foto->move($destinationPath, $profileImage);

        $pengaduan = Pengaduan::create([
            'user_id' => $user_id,
            'jenis_pengaduan' => $jenis_pengaduan,
            'bukti_pengaduan' => $profileImage
        ]);

        if ($request->jenis_pengaduan == '1') {
            Mail::send('email.pemberitahuan', ['pelanggan' => $pengaduan->user], function ($message) {
                $emailPDAM = "awiajha123@gmail.com";
                $message->to($emailPDAM);
                $message->subject('Keluhan Air Tidak Mengalir');
            });
        } else if ($request->jenis_pengaduan == '2') {
            Mail::send('email.pemberitahuan', ['pelanggan' => $pengaduan->user], function ($message) {
                $emailPDAM = "awiajha123@gmail.com";
                $message->to($emailPDAM);
                $message->subject('Keluhan Air Tidak Keruh');
            });
        } else if ($request->jenis_pengaduan == '3') {
            Mail::send('email.pemberitahuan', ['pelanggan' => $pengaduan->user], function ($message) {
                $emailPDAM = "awiajha123@gmail.com";
                $message->to($emailPDAM);
                $message->subject('Keluhan Keberatan Bayar');
            });
        } else if ($request->jenis_pengaduan == '4') {
            Mail::send('email.pemberitahuan', ['pelanggan' => $pengaduan->user], function ($message) {
                $emailPDAM = "awiajha123@gmail.com";
                $message->to($emailPDAM);
                $message->subject('Keluhan Pembenahan Sambungan');
            });
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        return view('backend.pages.pengaduan.show', compact('pengaduan'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaduan $pengaduan)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaduan $pengaduan)
    {
        abort(404);
    }
}
