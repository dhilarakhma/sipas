@php
    $modul = \App\Models\Modul::where('nama', 'kantor')->first();
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

            @if(env('IS_HEROKU', true))
                <div class="alert alert-info">
                    Kantor tidak bisa dihapus saat aplikasi dalam status demo
                </div>
            @endif

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
                                    <th>Kantor</th>
                                    <th>Nama Admin</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->nama }}</td>
                                    <td>{{ $d->user->nama }}</td>
                                    <td>{{ $d->user->email }}</td>
                                    <td>
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{$loop->iteration}}" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Aksi
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item has-icon" href="{{ route('kantor.edit', $d->id) }}">
                                                <i class="fas fa-edit"></i> Ubah
                                            </a>
                                            <a onclick="hapus(event, '{{ route('kantor.destroy', $d->id) }}')"
                                                class="dropdown-item has-icon" href="#">
                                                <i class="fas fa-trash"></i> Hapus
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
