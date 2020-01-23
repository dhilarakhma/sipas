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

            @if(Auth::user()->role == 'superadmin')
            <div class="alert alert-info">
                Untuk superadmin tidak bisa menambahkan arsip, hanya diperuntukkan bagi admin kantor. Superadmin hanya bisa preview, unduh dan cetak
            </div>
            @endif

            <div class="alert alert-info">
                Preview hanya bisa dilakukan jika berkas berformat <span class="badge badge-danger">pdf</span> dan pastikan anda tidak mengunduh <a href="https://www.internetdownloadmanager.com/"> Internet Download Manager</a> dikarenakan preview tidak akan tampil akan langsung diunduh
            </div>

            <div class="card">
                <div class="card-header">
                    <h4> <i class="{{$modul->ikon}}"></i> {{ $title }} </h4>
                    @if(Auth::user()->role == 'admin')
                    &nbsp; &nbsp; &nbsp;
                    <a href="{{ $action_tambah }}" class="btn btn-primary float-right"> <i class="fas fa-plus"></i> Baru
                    </a>
                    @endif
                    <a target="_blank" href="{{ $action_laporan }}" class="btn btn-success float-right"> <i class="fas fa-file"></i> Laporan
                    </a>
                    <a target="_blank" href="{{ $action_laporan_pdf }}" class="btn btn-danger float-right"> <i class="fas fa-file-pdf"></i> Laporan PDF
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hovered" id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Surat</th>
                                    <th>Judul Surat</th>
                                    <th>Tanggal</th>
                                    @if($jenis_dokumen == 'surat_keluar')
                                    <th>Penerima</th>
                                    @endif
                                    @if($jenis_dokumen == 'surat_masuk')
                                    <th>Pengirim</th>
                                    <th>Maksud Surat</th>
                                    @endif
                                    @if($jenis_dokumen == 'pegawai')
                                    <th>Pegawai</th>
                                    @endif
                                    <th>Ekstensi</th>
                                    <th>Berkas</th>
                                    <th>Keterangan</th>
                                    @if(Auth::user()->role == 'admin')
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->no_surat }}</td>
                                    <td>{{ $d->judul_surat }}</td>
                                    <td>{{ $d->tanggal }}</td>
                                    @if($jenis_dokumen == 'surat_keluar')
                                    <td>{{ $d->penerima }}</td>
                                    @endif
                                    @if($jenis_dokumen == 'surat_masuk')
                                    <td>{{ $d->pengirim }}</td>
                                    <td>{{ $d->maksud_surat }}</td>
                                    @endif
                                    @if($jenis_dokumen == 'pegawai')
                                    <td>{{ $d->pegawai }}</td>
                                    @endif
                                    <td>{!! $d->ekstensi_berkas_label !!}</td>
                                    <td>
                                        @if($d->berkas)
                                        <a data-toggle="tooltip" title="Unduh" class="btn btn-primary" href="{{ route('arsip.unduh', [$jenis_dokumen, $d->id]) }}" target="_blank">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <a data-toggle="tooltip" title="Preview" class="btn btn-success" href="{{ route('arsip.preview', [$jenis_dokumen, $d->id]) }}" target="_blank">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>{{ $d->keterangan }}</td>
                                    @if(Auth::user()->role == 'admin')
                                    <td>
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{$loop->iteration}}" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Aksi
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item has-icon" href="{{ route('arsip.edit', [$jenis_dokumen, $d->id]) }}">
                                                <i class="fas fa-edit"></i> Ubah
                                            </a>
                                            <a onclick="hapus(event, '{{ route('arsip.destroy', [$jenis_dokumen, $d->id]) }}')"
                                                class="dropdown-item has-icon" href="#">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                    @endif
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
