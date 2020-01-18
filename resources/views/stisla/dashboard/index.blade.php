@extends('stisla.layouts.app')

@section('konten')

<div class="section-header">
    @php
    $_ikon_dashboard = \App\Models\Modul::where('nama', 'dashboard')->first()->ikon;
    @endphp
    <h1> <i class="{{ $_ikon_dashboard }}"></i> {{ label_dashboard() }}</h1>
</div>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-university"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Modul 1</h4>
                </div>
                <div class="card-body">
                    {{1}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Modul 2</h4>
                </div>
                <div class="card-body">
                    {{0}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Modul 3</h4>
                </div>
                <div class="card-body">
                    {{0}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-clock"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Modul 4</h4>
                </div>
                <div class="card-body">
                    {{0}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
