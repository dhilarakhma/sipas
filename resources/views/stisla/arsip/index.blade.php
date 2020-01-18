@php
    $modul = \App\Models\Modul::where('nama', $jenis_dokumen)->first();
    $title = $modul->label;
@endphp
@extends('stisla.layouts.table')

@section('konten')
<div class="section-header">
    <h1> <i class="{{$modul->ikon}}"></i> {{ $title }}</h1>
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
                    <h4> <i class="{{$modul->ikon}}"></i> {{ $title }} </h4>
                    &nbsp; &nbsp; &nbsp;
                    <a href="{{ $action_tambah }}" class="btn btn-primary float-right"> <i class="fas fa-plus"></i> Baru
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hovered" id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Surat</th>
                                    <th>Tanggal</th>
                                    <th>Penerima</th>
                                    <th>Pengirim</th>
                                    <th>Pegawai</th>
                                    <th>Berkas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->no_surat }}</td>
                                    <td>{{ $d->tanggal }}</td>
                                    <td>{{ $d->penerima }}</td>
                                    <td>{{ $d->pengirim }}</td>
                                    <td>{{ $d->pegawai }}</td>
                                    <td><a href="{{ $d->berkas }}" target="_blank">unduh</a></td>
                                    <td>
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{$loop->iteration}}" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Aksi
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item has-icon" href="{{ route('contoh.edit', $d->id) }}">
                                                <i class="fas fa-edit"></i> Ubah
                                            </a>
                                            <a onclick="hapus(event, '{{ route('contoh.destroy', $d->id) }}')"
                                                class="dropdown-item has-icon" href="#">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                            <a href="{{ route('contoh.show', $d->id) }}" class="dropdown-item has-icon">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
