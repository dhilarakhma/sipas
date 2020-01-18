@php
    $_ikon = \App\Models\Modul::where('nama', 'profil')->first()->ikon;
@endphp
@extends('stisla.layouts.form')

@section('konten')
<div class="section-header">
  <h1> <i class="{{$_ikon}}"></i> {{ $title }}</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{label_dashboard()}}</a></div>
    <div class="breadcrumb-item">{{ $title }}</div>
  </div>
</div>

<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4> <i class="{{$_ikon}}"></i> {{ $title }}</h4>
        </div>
        <div class="card-body">
          <form action="{{ $action }}" method="post" enctype="multipart/form-data" class="needs-validation">
            @isset($d)
            @method('PUT')
            @endisset
            @csrf
            <div class="row">
              <div class="col-md-6">
                @input(['id'=>'nama', 'label'=>'Nama', 'ikon'=>'fas fa-user', 'value'=>isset($d)?$d->nama : ''])
              </div>
              <div class="col-md-6">
                @gambar(['id'=>'avatar', 'label'=>'Avatar', 'ikon'=>'fas fa-image', 'required'=>false])
              </div>
              <div class="col-md-6">
                @email(['value'=>isset($d)?$d->email : ''])
              </div>
              <div class="col-md-6">
                @password(['required'=>false])
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                <button type="reset" class="btn btn-secondary btn-block">Batal</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection