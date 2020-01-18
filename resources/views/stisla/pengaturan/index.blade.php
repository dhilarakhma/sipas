@php
    $_ikon = \App\Models\Modul::where('nama', 'pengaturan')->first()->ikon;
@endphp

@extends('stisla.layouts.form')

@section('konten')
<div class="section-header">
  <h1><i class="{{$_ikon}}"></i> {{ $title }}</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{label_dashboard()}}</a></div>
    <div class="breadcrumb-item">{{ $title }}</div>
  </div>
</div>

<div class="section-body">
  <div class="row">
    <div class="col-12">
      <form action="{{ $action }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        @foreach ($pengaturan as $grup_pengaturan => $p)
            
        <div class="card">
          <div class="card-header">
            <h4><i class="{{$_ikon}}"></i> {{ $grup_pengaturan }}</h4>
          </div>
          <div class="card-body">
            <div class="row">
              @foreach ($p as $d)
              <div class="col-md-6">
                @if($d->form_type == 'image')
                @gambar(['id'=>$d->key, 'label'=>$d->label, 'ikon'=>$d->ikon, 'value'=>$d->value, 'required'=>false])
                @elseif($d->key == 'sidebar_mini')
                @select(['id'=>$d->key, 'label'=>$d->label, 'value'=>$d->ikon, 'selectData'=>['true'=>'true','false'=>'false']])
                @else
                @input(['id'=>$d->key, 'label'=>$d->label, 'ikon'=>$d->ikon, 'value'=>$d->value])
                @endif
              </div>
              @endforeach
            </div>
          </div>
        </div>

        @endforeach

        <div class="card">
          <div class="card-header">
            <h4><i class="{{$_ikon}}"></i> Aksi</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                <a href="{{ route('pengaturan') }}" class="btn btn-secondary btn-block">Batal</a>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection