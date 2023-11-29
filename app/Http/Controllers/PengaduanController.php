<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Pengaduan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->roles == 'admin') {
            $pengaduans = Pengaduan::get();
            $airTidakMengalir = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'air_tidak_mengalir')->where(function ($query) {
                $query->where('status_pengaduan', 'belum_selesai')
                    ->orWhere('status_pengaduan', 'proses');
            })->first();
            $airKeruh = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'air_keruh')->where(function ($query) {
                $query->where('status_pengaduan', 'belum_selesai')
                    ->orWhere('status_pengaduan', 'proses');
            })->first();
            $keberatanBayar = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'keberatan_bayar')->where(function ($query) {
                $query->where('status_pengaduan', 'belum_selesai')
                    ->orWhere('status_pengaduan', 'proses');
            })->first();
            $pembenahanSambungan = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'pembenahan_sambungan')->where(function ($query) {
                $query->where('status_pengaduan', 'belum_selesai')
                    ->orWhere('status_pengaduan', 'proses');
            })->first();
        } else {
            $pengaduans = Pengaduan::where('user_id', $user->id)->get();
            $airTidakMengalir = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'air_tidak_mengalir')->where(function ($query) {
                $query->where('status_pengaduan', 'belum_selesai')
                    ->orWhere('status_pengaduan', 'proses');
            })->first();
            $airKeruh = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'air_keruh')->where(function ($query) {
                $query->where('status_pengaduan', 'belum_selesai')
                    ->orWhere('status_pengaduan', 'proses');
            })->first();
            $keberatanBayar = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'keberatan_bayar')->where(function ($query) {
                $query->where('status_pengaduan', 'belum_selesai')
                    ->orWhere('status_pengaduan', 'proses');
            })->first();
            $pembenahanSambungan = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'pembenahan_sambungan')->where(function ($query) {
                $query->where('status_pengaduan', 'belum_selesai')
                    ->orWhere('status_pengaduan', 'proses');
            })->first();
        }

        return view('backend.pages.pengaduan.index', compact('pengaduans', 'airTidakMengalir', 'airKeruh', 'keberatanBayar', 'pembenahanSambungan'));
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

        $user = Auth::user();
        $user_id = $user->id;
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
            $client = new Client();
            $url = "http://35.219.124.82:8080/message";

            $wa = "+6287853444186";
            $message = "Ada Keluhan Air Tidak Mengalir Dari " . $user->nama . " Dengan Nomor Sambungan " . $user->nosamb . " Di Alamat " . $user->alamat . " Silahkan Login Ke Web Admin Untuk Memeriksanya. Silahkan Masuk ke web: ".route('login');

            $body = [
                'phoneNumber' => $wa,
                'message' => $message,
            ];

            $client->request('POST', $url, [
                'form_params' => $body,
                'verify'  => false,
            ]);
        } else if ($request->jenis_pengaduan == '2') {
            $client = new Client();
            $url = "http://35.219.124.82:8080/message";

            $wa = "+6287853444186";
            $message = "Ada Keluhan Air Keruh Dari " . $user->nama . " Dengan Nomor Sambungan " . $user->nosamb . " Di Alamat " . $user->alamat . " Silahkan Login Ke Web Admin Untuk Memeriksanya. Silahkan Masuk ke web: ".route('login');

            $body = [
                'phoneNumber' => $wa,
                'message' => $message,
            ];

            $client->request('POST', $url, [
                'form_params' => $body,
                'verify'  => false,
            ]);
        } else if ($request->jenis_pengaduan == '3') {
            $client = new Client();
            $url = "http://35.219.124.82:8080/message";

            $wa = "+6287853444186";
            $message = "Ada Keluhan Keberatan Bayar Dari " . $user->nama . " Dengan Nomor Sambungan " . $user->nosamb . " Di Alamat " . $user->alamat . " Silahkan Login Ke Web Admin Untuk Memeriksanya. Silahkan Masuk ke web: ".route('login');

            $body = [
                'phoneNumber' => $wa,
                'message' => $message,
            ];

            $client->request('POST', $url, [
                'form_params' => $body,
                'verify'  => false,
            ]);
        } else if ($request->jenis_pengaduan == '4') {
            $client = new Client();
            $url = "http://35.219.124.82:8080/message";

            $wa = "+6287853444186";
            $message = "Ada Keluhan Pembenahan Sambungan Dari " . $user->nama . " Dengan Nomor Sambungan " . $user->nosamb . " Di Alamat " . $user->alamat . " Silahkan Login Ke Web Admin Untuk Memeriksanya. Silahkan Masuk ke web: ".route('login');

            $body = [
                'phoneNumber' => $wa,
                'message' => $message,
            ];

            $client->request('POST', $url, [
                'form_params' => $body,
                'verify'  => false,
            ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {

        $request->validate([
            'jenis_pengaduan' => 'required',
        ]);

        if ($request->jenis_pengaduan == '1') {
            $jenis_pengaduan = 'air_tidak_mengalir';
        } else if ($request->jenis_pengaduan == '2') {
            $jenis_pengaduan = 'air_keruh';
        } else if ($request->jenis_pengaduan == '3') {
            $jenis_pengaduan = 'keberatan_bayar';
        } else if ($request->jenis_pengaduan == '4') {
            $jenis_pengaduan = 'pembenahan_sambungan';
        }

        $data = [
            'jenis_pengaduan' => $jenis_pengaduan,
        ];

        if ($request->hasFile('bukti_pengaduan')) {
            $file_path_image = public_path('images/' . $pengaduan->bukti_pengaduan);
            if (file_exists($file_path_image)) {
                unlink($file_path_image);
            }

            $foto = $request->file('bukti_pengaduan');
            $destinationPath = 'images/';
            $baseURL = url('/');
            $profileImage = $baseURL . "/images/" . Str::slug($jenis_pengaduan) . '-' . Carbon::now()->format('YmdHis') . "." . $foto->getClientOriginalExtension();
            $foto->move($destinationPath, $profileImage);
            $data['bukti_pengaduan'] = $profileImage;
        }
        $pengaduan->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaduan $pengaduan)
    {

        $file_path_image = public_path('images/' . $pengaduan->bukti_pengaduan);
        if (file_exists($file_path_image)) {
            unlink($file_path_image);
        }
        $pengaduan->delete();
        return redirect()->back();
    }

    public function update_status($id)
    {
        $pengaduan = Pengaduan::findorfail($id);
        $noAdmin = [
            [
                'nama' => 'Imrha',
                'nowa' => '085723906247',
            ],
            [
                'nama' => 'Wiah',
                'nowa' => '082347755579',
            ],
            [
                'nama' => 'Kiky',
                'nowa' => '085341042607',
            ],
            [
                'nama' => 'Taufan',
                'nowa' => '081355548388',
            ],
        ];
        $pengaduan->update(
            [
                'status_pengaduan' => 'proses'
            ]
        );

        $client = new Client();
        $url = "http://35.219.124.82:8080/message";

        $wa = $pengaduan->user->no_whatsapp;
        $message = '';
        if ($pengaduan->jenis_pengaduan == "air_tidak_mengalir") {
            $message = "Keluhan Anda Masuk Ke Dalam Tahap Proses, Silahkan Hubungi Kontak Whatsapp Ini Agar Terhubung Dengan Petugas Yang Akan Mengatasi Keluhan Anda\n\nNo Whatsapp : " . $noAdmin[0]['nowa'] . " (" . $noAdmin[0]['nama'] . ")";
        } else if ($pengaduan->jenis_pengaduan == "air_keruh") {
            "Keluhan Anda Masuk Ke Dalam Tahap Proses, Silahkan Hubungi Kontak Whatsapp Ini Agar Terhubung Dengan Petugas Yang Akan Mengatasi Keluhan Anda\n\nNo Whatsapp : " . $noAdmin[1]['nowa'] . " (" . $noAdmin[1]['nama'] . ")";
        } else if ($pengaduan->jenis_pengaduan == "keberatan_bayar") {
            $message =  "Keluhan Anda Masuk Ke Dalam Tahap Proses, Silahkan Hubungi Kontak Whatsapp Ini Agar Terhubung Dengan Petugas Yang Akan Mengatasi Keluhan Anda\n\nNo Whatsapp : " . $noAdmin[2]['nowa'] . " (" . $noAdmin[2]['nama'] . ")";
        } else if ($pengaduan->jenis_pengaduan == "pembenahan_sambungan") {
            $message = "Keluhan Anda Masuk Ke Dalam Tahap Proses, Silahkan Hubungi Kontak Whatsapp Ini Agar Terhubung Dengan Petugas Yang Akan Mengatasi Keluhan Anda\n\nNo Whatsapp : " . $noAdmin[3]['nowa'] . " (" . $noAdmin[3]['nama'] . ")";
        };
        $body = [
            'phoneNumber' => $wa,
            'message' => $message,
        ];

        $client->request('POST', $url, [
            'form_params' => $body,
            'verify'  => false,
        ]);

        return redirect()->back();
    }

    public function update_status_selesai($id)
    {
        $pengaduan = Pengaduan::findorfail($id);
        $pengaduan->update(
            [
                'status_pengaduan' => 'selesai'
            ]
        );
        return redirect()->back();
    }
}
