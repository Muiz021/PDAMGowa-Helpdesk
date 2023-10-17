@extends('backend.app')

@section('title', 'Dashboard')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Dashboard</h2>
                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="col-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <h3 class="title-2">Profil</h3>
                            <div class="row mt-4 ms-3">
                                <div class="col-lg-4 col-md-12 align-self-center">
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <h5 class="fw-bold">
                                            {{ auth()->user()->nama }}
                                        </h5>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <h5 class="fw-bold">
                                            {{ auth()->user()->username }}
                                        </h5>
                                    </div>
                                    <div>
                                        <label class="form-label">No. HP</label>
                                        <h5 class="fw-bold">
                                            {{ auth()->user()->no_hp }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 align-self-center">
                                    <div class="mb-3">
                                        <label class="form-label">No. Sambungan</label>
                                        <h5 class="fw-bold">
                                            {{ auth()->user()->nosamb }}
                                        </h5>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <h5 class="fw-bold">
                                            {{ auth()->user()->alamat }}
                                        </h5>
                                    </div>
                                    <div>
                                        <label class="form-label">Akun</label>
                                        <h5 class="fw-bold">
                                            {{ auth()->user()->roles }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
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
