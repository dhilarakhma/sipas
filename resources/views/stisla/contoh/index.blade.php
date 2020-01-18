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
                                    <th>{{ \Str::title(str_replace('_', ' ', 'ini_text')) }}</th>
                                    <th>{{ \Str::title(str_replace('_', ' ', 'ini_email')) }}</th>
                                    <th>{{ \Str::title(str_replace('_', ' ', 'ini_datepicker')) }}</th>
                                    <th>{{ \Str::title(str_replace('_', ' ', 'ini_gambar')) }}</th>
                                    <th>{{ \Str::title(str_replace('_', ' ', 'ini_excel')) }}</th>
                                    <th>{{ \Str::title(str_replace('_', ' ', 'ini_file')) }}</th>
                                    <th>{{ \Str::title(str_replace('_', ' ', 'ini_textarea')) }}</th>
                                    <th>{{ \Str::title(str_replace('_', ' ', 'ini_select')) }}</th>
                                    <th>{{ \Str::title(str_replace('_', ' ', 'ini_select2')) }}</th>
                                    <th>{{ \Str::title(str_replace('_', ' ', 'ini_password')) }}</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->ini_text }}</td>
                                    <td>{{ $d->ini_email }}</td>
                                    <td>{{ $d->ini_datepicker }}</td>
                                    <td>
                                        <a href="{{ asset(\Storage::url($d->ini_gambar)) }}" target="_blank">
                                            <img style="max-width: 100px;" src="{{ asset(\Storage::url($d->ini_gambar)) }}" alt="{{ $d->ini_text }}">
                                        </a>
                                    </td>
                                    <td><a target="_blank" href="{{ asset(\Storage::url($d->ini_excel)) }}">Download</a></td>
                                    <td><a target="_blank" href="{{ asset(\Storage::url($d->ini_file)) }}">Download</a></td>
                                    <td>{{ $d->ini_textarea }}</td>
                                    <td>{{ $d->ini_select }}</td>
                                    <td>{{ $d->ini_select2 }}</td>
                                    <td>{{ $d->ini_password }}</td>
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
