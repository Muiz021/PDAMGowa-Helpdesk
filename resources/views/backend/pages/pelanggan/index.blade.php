@extends('backend.app')

@section('title', 'Pelanggan')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
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
                                    <th>No. Hp</th>
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
                                        <td>{{ $item->no_hp }}</td>
                                        <td>
                                            @if ($item->is_verification == 0)
                                                <span class="status--denied">Belum Di Verifikasi</span>
                                            @elseif ($item->is_verification == 1)
                                                <span class="status--process">Di Verifikasi</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="/backend/updatestatus/{{ $item->id }}" class="item"
                                                    data-toggle="tooltip" data-placement="top" title="Verifikasi">
                                                    <i class="zmdi zmdi-mail-send"></i>
                                                </a>
                                                <button class="item" data-target="#mediumModal{{ $item->id }}"
                                                    data-toggle="modal" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <a href="/backend/pelanggan/{{ $item->id }}" class="item"
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

    @foreach ($user as $item)
        <div class="modal fade" id="mediumModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <form action="/backend/pelanggan/{{ $item->id }}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">Edit Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
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
                                <label for="no_hp" class="form-control-label">No. HP</label>
                                <input type="text" id="no_hp" name="no_hp" value="{{ $item->no_hp }}"
                                    class="form-control">
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
