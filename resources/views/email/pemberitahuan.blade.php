<div>
    Ada Keluhan Dari
    <br>
    Nama : {{ $pelanggan->nama }}
    <br>
    Nomor Sambungan : {{ $pelanggan->nosamb }}
    <br>
    Nomor HP : {{ $pelanggan->no_whatsapp }}
    <br>
    Alamat : {{ $pelanggan->alamat }}
    <br>
    <br>
    Login Dengan Akun Admin Untuk Menyelesaikan Keluhan Jika Telah Selesai.
</div>

<div>
    <a href="{{ route('login') }}" style="display: inline-block; background-color: #1e50f3; color: white; padding: 10px 10px; text-align: center; text-decoration: none; border-radius: 5px; margin-top: 10px; margin-bottom: 10px;">Login</a>
</div>
