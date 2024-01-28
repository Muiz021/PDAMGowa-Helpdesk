@extends('backend.app')

@section('title', 'Riwayat Info')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-data__tool" style="margin-bottom: -20px">
                        <div class="table-data__tool-left">
                            <h3 class="title-5 m-b-35">Riwayat Info</h3>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Waktu</th>
                                    <th>Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemberitahuan as $key => $item)
                                    <tr class="tr-shadow">
                                        <td>{{ $pemberitahuan->firstItem() + $key }}</td>
                                        <td>{{ $item->waktu }}</td>
                                        <td>{{ $item->message }}</td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="left">
                            Showing {{ $pemberitahuan->firstItem() }} of {{ $pemberitahuan->lastItem() }}
                        </div>
                        <div class="right">
                            {{ $pemberitahuan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
