@php
$surat_masuk = \App\Models\Modul::where('nama', 'surat_masuk')->first();
$surat_masuk->ikon = str_replace('fa ', 'fas ', $surat_masuk->ikon);
$surat_keluar = \App\Models\Modul::where('nama', 'surat_keluar')->first();
$surat_keluar->ikon = str_replace('fa ', 'fas ', $surat_keluar->ikon);
$pegawai = \App\Models\Modul::where('nama', 'pegawai')->first();
$pegawai->ikon = str_replace('fa ', 'fas ', $pegawai->ikon);
$organisasi = \App\Models\Modul::where('nama', 'organisasi')->first();
$organisasi->ikon = str_replace('fa ', 'fas ', $organisasi->ikon);

$surat_masuk_count = \App\Arsip::where('jenis_dokumen_id', 1)->count();
if(Auth::user()->role == 'admin')
    $surat_masuk_count = \App\Arsip::where('jenis_dokumen_id', 1)->where('kantor_id', Auth::user()->kantor->id)->count();
$surat_keluar_count = \App\Arsip::where('jenis_dokumen_id', 2)->count();
if(Auth::user()->role == 'admin')
    $surat_keluar_count = \App\Arsip::where('jenis_dokumen_id', 2)->where('kantor_id', Auth::user()->kantor->id)->count();
$pegawai_count = \App\Arsip::where('jenis_dokumen_id', 3)->count();
if(Auth::user()->role == 'admin')
    $pegawai_count = \App\Arsip::where('jenis_dokumen_id', 3)->where('kantor_id', Auth::user()->kantor->id)->count();
$organisasi_count = \App\Arsip::where('jenis_dokumen_id', 4)->count();
if(Auth::user()->role == 'admin')
    $organisasi_count = \App\Arsip::where('jenis_dokumen_id', 4)->where('kantor_id', Auth::user()->kantor->id)->count();
@endphp

@extends('stisla.layouts.app')

@section('konten')

<div class="section-header">
    @php
    $_ikon_dashboard = \App\Models\Modul::where('nama', 'dashboard')->first()->ikon;
    @endphp
    <h1> <i class="{{ $_ikon_dashboard }}"></i> {{ label_dashboard() }}</h1>
</div>
<div class="row">

    <div class="col-lg-12">
        <div class="hero bg-primary text-white mb-3">
            <div class="hero-inner">
                <h2>Selamat datang, {{ \Auth::user()->nama }}</h2>
                <p class="lead">{{ config('stisla.deskripsi_aplikasi') }}</p>
                <div class="mt-4">
                    <a href="{{ route('arsip', ['surat_masuk']) }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="{{ $surat_masuk->ikon }}"></i> {{ $surat_masuk->label }}</a>
                    <a href="{{ route('arsip', ['surat_keluar']) }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="{{ $surat_keluar->ikon }}"></i> {{ $surat_keluar->label }}</a>
                    <a href="{{ route('arsip', ['pegawai']) }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="{{ $pegawai->ikon }}"></i> {{ $pegawai->label }}</a>
                    <a href="{{ route('arsip', ['organisasi']) }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="{{ $organisasi->ikon }}"></i> {{ $organisasi->label }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="{{ $surat_masuk->ikon }}"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ $surat_masuk->label }}</h4>
                </div>
                <div class="card-body">
                    {{ $surat_masuk_count }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="{{ $surat_keluar->ikon }}"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ $surat_keluar->label }}</h4>
                </div>
                <div class="card-body">
                    {{ $surat_keluar_count }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="{{ $pegawai->ikon }}"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ $pegawai->label }}</h4>
                </div>
                <div class="card-body">
                    {{ $pegawai_count }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="{{ $organisasi->ikon }}"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ $organisasi->label }}</h4>
                </div>
                <div class="card-body">
                    {{ $organisasi_count }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
