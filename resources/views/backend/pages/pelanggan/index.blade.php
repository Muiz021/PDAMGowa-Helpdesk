@extends('backend.app')

@section('title', 'Pelanggan')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-start my-3">
                    <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#kirim-info">
                        <i class="fas fa-plus-circle mr-2"></i><span>Kirim Info</span>
                    </button>
                </div>
                <div class="col-md-12">
                    <div class="table-data__tool" style="margin-bottom: -20px">
                        <div class="table-data__tool-left">
                            <h3 class="title-5 m-b-35">Data Pelanggan</h3>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Samb</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No. Whatsapp</th>
                                    <th>Status Akun</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                    <tr class="tr-shadow">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="block-email">{{ $item->nosamb }}</span>
                                        </td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->no_whatsapp }}</td>
                                        <td>
                                            @if ($item->is_verification == 0)
                                                <span class="status--denied">Belum Di Verifikasi</span>
                                            @elseif ($item->is_verification == 1)
                                                <span class="status--process">Di Verifikasi</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="/backend/admin/updatestatus/{{ $item->id }}" class="item"
                                                    data-toggle="tooltip" data-placement="top" title="Verifikasi">
                                                    <i class="zmdi zmdi-mail-send"></i>
                                                </a>
                                                <button class="item" data-target="#mediumModal{{ $item->id }}"
                                                    data-toggle="modal" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <a href="/backend/admin/pelanggan/{{ $item->id }}" class="item"
                                                    data-toggle="tooltip" data-placement="top" title="Hapus">
                                                    <i class="zmdi zmdi-delete"></i>
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

    <div class="modal fade" id="kirim-info" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form action="{{ route('kirimInfo') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Kirim Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="message" class="form-control-label">Pesan</label>
                            <textarea name="message" id="message" class="form-control" cols="30" rows="5" placeholder="Masukkan Pesan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($user as $item)
        <div class="modal fade" id="mediumModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <form action="/backend/admin/pelanggan/{{ $item->id }}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">Edit Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if ($errors->any())
                                @foreach ($errors->all() as $err)
                                    <p class="alert alert-danger">{{ $err }}</p>
                                @endforeach
                            @endif
                            <div class="form-group">
                                <label for="nosamb" class="form-control-label">No. Samb</label>
                                <input type="text" id="nosamb" name="nosamb" value="{{ $item->nosamb }}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="form-control-label">Nama</label>
                                <input type="text" id="nama" name="nama" value="{{ $item->nama }}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="no_whatsapp" class="form-control-label">No. HP</label>
                                <input type="text" id="no_whatsapp" name="no_whatsapp"
                                    value="{{ $item->no_whatsapp }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="form-control-label">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="3">{{ $item->alamat }}</textarea>
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
    @endforeach
@endsection
