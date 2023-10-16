@extends('backend.app')


@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 my-3">
                    <div class="card">
                        <div class="card-header">Detail Data</div>
                        <div class="card-body">
                            <form action="#" method="post" novalidate="novalidate">
                                <div class="d-flex">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="jenis_pengaduan" class="form-control-label">Jenis Pengaduan</label>
                                            <input class="form-control-sm form-control"
                                                value="@if ($pengaduan->jenis_pengaduan == 'air_tidak_mengalir') Air Tidak Mengalir
                                                    @elseif ($pengaduan->jenis_pengaduan == 'air_keruh')
                                                        Air Keruh
                                                    @elseif ($pengaduan->jenis_pengaduan == 'keberatan_bayar')
                                                        Keberatan Bayar
                                                    @elseif ($pengaduan->jenis_pengaduan == 'pembenahan_sambungan')
                                                        Pembenahan Sambungan @endif"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="bukti_pengaduan" class="form-control-label">Bukti Pengaduan</label>
                                            <a href="{{ $pengaduan->bukti_pengaduan }}" target="__BLANK"
                                                class="btn btn-success form-control-sm form-control">Gambar</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('pengaduan.index') }}" class="btn btn-primary">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var botmanWidget = {
            introMessage: 'Halo {{ auth()->user()->nama }}, Ketik : <br> 1. Mulai Chat Bot <br> 2. Mulai Chat Whatsapp',
            title: 'Chat Bot',
            aboutText: 'PDAM Gowa',
            placeholderText: 'Kirim Pesan...',
            mainColor: '#2891E9',
            bubbleBackground: '	#2891E9',
            bubbleAvatarUrl: '',
            aboutLink: '/',
            userId: '{{ auth()->user()->id }}'
        };
    </script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
@endsection
