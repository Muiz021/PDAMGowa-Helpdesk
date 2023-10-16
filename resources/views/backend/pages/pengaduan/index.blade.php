@extends('backend.app')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-start my-3">
                    <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#create-pengaduan">
                        <i class="fas fa-plus-circle mr-2"></i><span>Tambah Pengaduan</span>
                    </button>
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
                                            @if ($item->status_pengaduan == 0)
                                                <span class="status--denied">Belum Selesai</span>
                                            @elseif ($item->status_pengaduan == 1)
                                                <span class="status--process">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('pengaduan.show', $item->id) }}" class="item"
                                                    data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
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

    <div class="modal fade" id="create-pengaduan" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form action="{{ route('pengaduan.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Membuat Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="jenis_pengaduan" class="form-control-label">Jenis Pengaduan</label>
                            <select name="jenis_pengaduan" id="SelectLm" class="form-control-sm form-control">
                                <option value="">Please select</option>
                                <option value="1">Air Tidak Mengalir</option>
                                <option value="2">Air Keruh</option>
                                <option value="3">Keberatan Bayar</option>
                                <option value="4">Pembenahan Sambungan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bukti_pengaduan" class="form-control-label">Bukti Pengaduan</label>
                            <input type="file" name="bukti_pengaduan" class="form-control-sm form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
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
