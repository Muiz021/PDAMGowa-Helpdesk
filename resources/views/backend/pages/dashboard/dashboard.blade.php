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
                <div class="overview-item overview-item--c1">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-account-o"></i>
                            </div>
                            <div class="text">
                                <h2>{{ $pelanggan->count() }}</h2>
                                <span>Pelanggan</span>
                            </div>
                        </div>
                        <div class="overview-chart">
                            <canvas id="widgetChart1"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
