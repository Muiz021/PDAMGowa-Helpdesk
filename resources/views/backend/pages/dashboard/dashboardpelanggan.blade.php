@extends('backend.app')

@section('title', 'Dashboard')

@section('content')
@include('sweetalert::alert')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Dashboard</h2>
                    </div>
                </div>
                <div class="col-md-12 my-3">
                    <div class="card">
                        <div class="card-header">Profil User</div>
                        <div class="card-body">
                            @if ($errors->any())
                                @foreach ($errors->all() as $err)
                                    <p class="alert alert-danger">{{ $err }}</p>
                                @endforeach
                            @endif
                            <form action="#" method="post" novalidate="novalidate" @disabled(true)>
                                <div class="d-flex">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nama" class="form-control-label">Nama</label>
                                            <input type="text" name="nama" class="form-control-sm form-control"
                                                value="{{ Auth::user()->nama }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="form-control-label">Username</label>
                                            <input type="text" name="username" class="form-control-sm form-control"
                                                value="{{ Auth::user()->username }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_whatsapp" class="form-control-label">NIK</label>
                                            <input type="text" name="nik" class="form-control-sm form-control"
                                                value="{{ Auth::user()->nik }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="no_whatsapp" class="form-control-label">No. Whatsapp</label>
                                            <input type="text" name="no_whatsapp" class="form-control-sm form-control"
                                                value="{{ Auth::user()->no_whatsapp }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_whatsapp" class="form-control-label">Alamat</label>
                                            <textarea name="alamat" id="alamat" class="form-control-sm form-control" cols="20" rows="10" disabled>{{ Auth::user()->alamat }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary" data-target="#profil-{{ Auth::user()->id }}"
                                        data-toggle="modal" data-placement="top" title="Edit">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('backend.pages.dashboard.modal')

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
