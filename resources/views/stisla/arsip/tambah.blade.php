@php
    $modul = \App\Models\Modul::where('nama', $jenis_dokumen)->first();
    $title = $modul->label.' Baru';
    if(isset($d)){
        $title = $modul->label.' Ubah';
    }
@endphp
@extends('stisla.layouts.form')

@section('konten')
<div class="section-header">
    <h1> <i class="{{$modul->ikon}}"></i> {{ $title }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{label_dashboard()}}</a></div>
        <div class="breadcrumb-item"><a href="{{ route('arsip', [$jenis_dokumen]) }}">{{ $modul->label }}</a></div>
        <div class="breadcrumb-item">{{ $title }}</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4> <i class="{{$modul->ikon}}"></i> {{ $title }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ $action }}" method="post" enctype="multipart/form-data" class="needs-validation">
                        @isset($d)
                        @method('PUT')
                        @endisset
                        @csrf
                        <div class="row">

                            <div class="col-md-6">
                                @input(['id'=>'no_surat', 'value'=>isset($d)?$d->no_surat : '', 'ikon'=>'fas fa-envelope'])
                            </div>

                            <div class="col-md-6">
                                @input(['id'=>'judul_surat', 'value'=>isset($d)?$d->judul_surat : '', 'ikon'=>'fas fa-envelope-open'])
                            </div>

                            <div class="col-md-6">
                                @datepicker(['id'=>'tanggal', 'value'=>isset($d)?$d->tanggal : date('Y-m-d')])
                            </div>

                            @if($jenis_dokumen == 'surat_keluar')
                            <div class="col-md-6">
                                @input(['id'=>'penerima', 'value'=>isset($d)?$d->penerima : '', 'ikon'=>'fas fa-user'])
                            </div>
                            @endif

                            @if($jenis_dokumen == 'surat_masuk')
                            <div class="col-md-6">
                                @input(['id'=>'pengirim', 'value'=>isset($d)?$d->pengirim : '',  'ikon'=>'fas fa-user'])
                            </div>
                            @endif

                            @if($jenis_dokumen == 'pegawai')
                            <div class="col-md-6">
                                @input(['id'=>'pegawai', 'value'=>isset($d)?$d->pegawai : '', 'ikon'=>'fas fa-user'])
                            </div>
                            @endif

                            <div class="col-md-6">
                                @file(['id'=>'berkas', 'ikon'=>'fas fa-file', 'required'=>isset($d)?false:true])
                            </div>

                            @if($action)
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                <button type="reset" class="btn btn-secondary btn-block">Batal</button>
                            </div>
                            @endif

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@if(is_null($action))
@push('script')
<script>
    $(document).ready(function () {
        $('.form-control').attr('disabled', true);
    });

</script>
@endpush
@endif
