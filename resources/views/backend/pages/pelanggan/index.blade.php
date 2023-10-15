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
                                                <a href="/backend/updatestatus/{{ $item->id }}" class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Verifikasi">
                                                    <i class="zmdi zmdi-mail-send"></i>
                                                </a>
                                                <a href="/backend/pelanggan/{{ $item->id }}" class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Hapus">
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
@endsection
