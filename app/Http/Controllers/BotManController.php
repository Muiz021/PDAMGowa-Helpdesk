<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Pengaduan;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;

class BotManController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function ($bot, $message) {
            if ($message == '1') {
                $bot->startConversation(new OnboardingConversation);
            } elseif ($message == '2') {
                $bot->reply('<a href="https://wa.me/6287853444186?text=Hi+Admin.+Saya+ingin+bertanya+mengenai+PDAM" target="blank_">Klik Link Ini Untuk Memulai Chat Whatsapp</a>');
                $bot->reply("Chat Kembali Ke Menu Utama, Ketik : <br> 1. Mulai Chat Bot <br> 2. Mulai Chat Whatsapp");
            } else {
                $bot->reply("Pilihan Anda Salah, Ketik : <br> 1. Mulai Chat Bot <br> 2. Mulai Chat Whatsapp");
            }
        });

        $botman->listen();
    }
}

class OnboardingConversation extends Conversation
{
    protected $pilihan;

    protected $keluhan;

    public function pilihanMenu()
    {
        $this->ask('Pilihan : <br> 1. Apa Itu PDAM <br> 2. Keluhan/Mengingatkan Keluhan', function (Answer $answer) {
            $this->pilihan = $answer->getText();

            if ($this->pilihan == '1') {
                $this->say('PDAM adalah layanan penggunaan air bersih dengan sistem berlangganan dan membayar setiap bulan untuk sejumlah pemakaian air yang digunakan, dengan melihat meteran air yang biasa diletakkan di depan rumah pelanggan');
                $this->say("Chat Kembali Ke Menu Utama, Ketik : <br> 1. Mulai Chat Bot <br> 2. Mulai Chat Whatsapp");
            } elseif ($this->pilihan == '2') {
                $this->keluhanMenu();
            } else {
                $this->say("Pilihan Anda Salah");
                $this->pilihanMenu();
            }
        });
    }

    public function keluhanMenu()
    {
        $this->ask('Pilihan : <br> 1. Air Tidak Mengalir <br> 2. Air Keruh <br> 3. Keberatan Bayar <br> 4. Pembenahan Sambungan', function (Answer $answer) {
            $this->keluhan = $answer->getText();

            if ($this->keluhan == '1') {
                $this->airTidakMengalir();
            } elseif ($this->keluhan == '2') {
                $this->airKeruh();
            } elseif ($this->keluhan == '3') {
                $this->keberatanBayar();
            } elseif ($this->keluhan == '4') {
                $this->pembenahanSambungan();
            } else {
                $this->say("Pilihan Anda Salah");
                $this->keluhanMenu();
            }
        });
    }

    public function airTidakMengalir()
    {
        $pengaduan = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'air_tidak_mengalir')->where('status_pengaduan', 'belum_selesai')->first();
        $pengaduanProses = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'air_tidak_mengalir')->where('status_pengaduan', 'proses')->first();
        $pengaduanSelesai = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'air_tidak_mengalir')->where('status_pengaduan', 'selesai')->first();

        if ($pengaduan) {
            $client = new Client();
            $url = "http://35.219.124.82:8080/message";

            $wa = "+6287853444186";
            $message = "Pengingat Keluhan Air Tidak Mengalir Dari ".auth()->user()->nama." Dengan Nomor Sambungan ".auth()->user()->nosamb." Di Alamat ".auth()->user()->alamat." Silahkan Login Ke Web Admin Untuk Memeriksanya";

            $body = [
                'phoneNumber' => $wa,
                'message' => $message,
            ];

            $client->request('POST', $url, [
                'form_params' => $body,
                'verify'  => false,
            ]);

            $this->say('Keluhan Air Tidak Mengalir Anda Segera Di Proses, Saya Telah Mengirimkan Whatsapp Ke Admin Untuk Mengingatkannya Kembali');
        } elseif ($pengaduanProses) {
            $this->say('Keluhan Air Tidak Mengalir Anda Sedang Di Proses');
        } elseif ($pengaduanSelesai) {
            $this->say('Pengaduan Air Tidak Mengalir Anda Telah Selesai, Silahkan Input Bukti Pengaduan Di Menu Pengaduan Jika Masih Ada Keluhan Lainnya');
        } else {
            $this->say('Silahkan Input Bukti Pengaduan Di Menu Pengaduan, Terima Kasih Telah Menghubungi PDAM Gowa Helpdesk');
        }

        $this->say("Chat Kembali Ke Menu Utama, Ketik : <br> 1. Mulai Chat Bot <br> 2. Mulai Chat Whatsapp");
    }

    public function airKeruh()
    {
        $pengaduan = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'air_keruh')->where('status_pengaduan', 'belum_selesai')->first();
        $pengaduanProses = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'air_keruh')->where('status_pengaduan', 'proses')->first();
        $pengaduanSelesai = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'air_keruh')->where('status_pengaduan', 'selesai')->first();

        if ($pengaduan) {
            $client = new Client();
            $url = "http://35.219.124.82:8080/message";

            $wa = "+6287853444186";
            $message = "Pengingat Keluhan Air Keruh Dari ".auth()->user()->nama." Dengan Nomor Sambungan ".auth()->user()->nosamb." Di Alamat ".auth()->user()->alamat." Silahkan Login Ke Web Admin Untuk Memeriksanya";

            $body = [
                'phoneNumber' => $wa,
                'message' => $message,
            ];

            $client->request('POST', $url, [
                'form_params' => $body,
                'verify'  => false,
            ]);
            $this->say('Keluhan Air Keruh Anda Segera Di Proses, Saya Telah Mengirimkan Whatsapp Ke Admin Untuk Mengingatkannya Kembali');
        } elseif ($pengaduanProses) {
            $this->say('Keluhan Air Keruh Anda Sedang Di Proses');
        } elseif ($pengaduanSelesai) {
            $this->say('Pengaduan Air Keruh Anda Telah Selesai, Silahkan Input Bukti Pengaduan Di Menu Pengaduan Jika Masih Ada Keluhan Lainnya');
        } else {
            $this->say('Silahkan Input Bukti Pengaduan Di Menu Pengaduan, Terima Kasih Telah Menghubungi PDAM Gowa Helpdesk');
        }

        $this->say("Chat Kembali Ke Menu Utama, Ketik : <br> 1. Mulai Chat Bot <br> 2. Mulai Chat Whatsapp");
    }

    public function keberatanBayar()
    {
        $pengaduan = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'keberatan_bayar')->where('status_pengaduan', 'belum_selesai')->first();
        $pengaduanProses = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'keberatan_bayar')->where('status_pengaduan', 'proses')->first();
        $pengaduanSelesai = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'keberatan_bayar')->where('status_pengaduan', 'selesai')->first();

        if ($pengaduan) {
            $client = new Client();
            $url = "http://35.219.124.82:8080/message";

            $wa = "+6287853444186";
            $message = "Pengingat Keluhan Keberatan Bayar Dari ".auth()->user()->nama." Dengan Nomor Sambungan ".auth()->user()->nosamb." Di Alamat ".auth()->user()->alamat.". Silahkan Login Ke Web Admin Untuk Memeriksanya";

            $body = [
                'phoneNumber' => $wa,
                'message' => $message,
            ];

            $client->request('POST', $url, [
                'form_params' => $body,
                'verify'  => false,
            ]);
            $this->say('Keluhan Keberatan Bayar Anda Segera Di Proses, Saya Telah Mengirimkan Whatsapp Ke Admin Untuk Mengingatkannya Kembali');
        } elseif ($pengaduanProses) {
            $this->say('Keluhan Keberatan Bayar Anda Sedang Di Proses');
        } elseif ($pengaduanSelesai) {
            $this->say('Pengaduan Keberatan Bayar Anda Telah Selesai, Silahkan Input Bukti Pengaduan Di Menu Pengaduan Jika Masih Ada Keluhan Lainnya');
        } else {
            $this->say('Silahkan Input Bukti Pengaduan Di Menu Pengaduan, Terima Kasih Telah Menghubungi PDAM Gowa Helpdesk');
        }

        $this->say("Chat Kembali Ke Menu Utama, Ketik : <br> 1. Mulai Chat Bot <br> 2. Mulai Chat Whatsapp");
    }

    public function pembenahanSambungan()
    {
        $pengaduan = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'pembenahan_sambungan')->where('status_pengaduan', 'belum_selesai')->first();
        $pengaduanProses = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'pembenahan_sambungan')->where('status_pengaduan', 'proses')->first();
        $pengaduanSelesai = Pengaduan::where('user_id', auth()->user()->id)->where('jenis_pengaduan', 'pembenahan_sambungan')->where('status_pengaduan', 'selesai')->first();

        if ($pengaduan) {
            $client = new Client();
            $url = "http://35.219.124.82:8080/message";

            $wa = "+6287853444186";
            $message = "Pengingat Keluhan Pembenahan Sambungan Dari ".auth()->user()->nama." Dengan Nomor Sambungan ".auth()->user()->nosamb." Di Alamat ".auth()->user()->alamat." Silahkan Login Ke Web Admin Untuk Memeriksanya";

            $body = [
                'phoneNumber' => $wa,
                'message' => $message,
            ];

            $client->request('POST', $url, [
                'form_params' => $body,
                'verify'  => false,
            ]);
            $this->say('Keluhan Pembenahan Sambungan Anda Segera Di Proses, Saya Telah Mengirimkan Whatsapp Ke Admin Untuk Mengingatkannya Kembali');
        } elseif ($pengaduanProses) {
            $this->say('Keluhan Pembenahan Sambungan Anda Sedang Di Proses');
        } elseif ($pengaduanSelesai) {
            $this->say('Pengaduan Pembenahan Sambungan Anda Telah Selesai, Silahkan Input Bukti Pengaduan Di Menu Pengaduan Jika Masih Ada Keluhan Lainnya');
        } else {
            $this->say('Silahkan Input Bukti Pengaduan Di Menu Pengaduan, Terima Kasih Telah Menghubungi PDAM Gowa Helpdesk');
        }

        $this->say("Chat Kembali Ke Menu Utama, Ketik : <br> 1. Mulai Chat Bot <br> 2. Mulai Chat Whatsapp");
    }

    public function run()
    {
        $this->pilihanMenu();
    }
}
