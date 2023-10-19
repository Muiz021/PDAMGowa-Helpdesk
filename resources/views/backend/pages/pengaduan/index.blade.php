@extends('backend.app')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-start my-3">
                    @if (Auth::user()->roles == 'user')
                        <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#create-pengaduan">
                            <i class="fas fa-plus-circle mr-2"></i><span>Tambah Pengaduan</span>
                        </button>
                    @endif
                </div>
                <div class="col-md-12">
                    <div class="table-data__tool" style="margin-bottom: -20px">
                        <div class="table-data__tool-left">
                            <h3 class="title-5 m-b-35">Data Pengaduan</h3>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Pengaduan</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengaduans as $item)
                                    <tr class="tr-shadow">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($item->jenis_pengaduan == 'air_tidak_mengalir')
                                                Air Tidak Mengalir
                                            @elseif ($item->jenis_pengaduan == 'air_keruh')
                                                Air Keruh
                                            @elseif ($item->jenis_pengaduan == 'keberatan_bayar')
                                                Keberatan Bayar
                                            @elseif ($item->jenis_pengaduan == 'pembenahan_sambungan')
                                                Pembenahan Sambungan
                                            @endif
                                        </td>

                                        <td>
                                            @if ($item->status_pengaduan == 'belum_selesai')
                                                <span class="status--denied">Belum Selesai</span>
                                            @elseif ($item->status_pengaduan == 'proses')
                                                <span style="color: goldenrod">Di Proses</span>
                                            @elseif ($item->status_pengaduan == 'selesai')
                                                <span class="status--process">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if (Auth::user()->roles == 'admin')
                                                    @if ($item->status_pengaduan == 'belum_selesai')
                                                        <form action="{{ route('update-pengaduan', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('put')
                                                            <button type="submit" class="item mr-1" data-placement="top"
                                                                title="Proses">
                                                                <i class="zmdi zmdi-mail-send"></i>
                                                            </button>
                                                        </form>
                                                    @elseif ($item->status_pengaduan == 'proses')
                                                        <form action="{{ route('update-pengaduan-selesai', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('put')
                                                            <button type="submit" class="item mr-1" data-placement="top"
                                                                title="Selesai">
                                                                <i class="zmdi zmdi-mail-send"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <a href="{{ route('pengaduan.admin.show', $item->id) }}" class="item"
                                                        data-toggle="tooltip" data-placement="top" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form action="{{ route('pengaduan.admin.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="item" data-placement="top"
                                                            title="Hapus">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('pengaduan.show', $item->id) }}" class="item"
                                                        data-toggle="tooltip" data-placement="top" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button class="item"
                                                        data-target="#update-pengaduan-{{ $item->id }}"
                                                        data-toggle="modal" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                    <form action="{{ route('pengaduan.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="item" data-placement="top"
                                                            title="Hapus">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->roles == 'user')
        @include('backend.pages.pengaduan.model')
    @endif

    @if (Auth::user()->roles == 'user')
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
    @endif
@endsection