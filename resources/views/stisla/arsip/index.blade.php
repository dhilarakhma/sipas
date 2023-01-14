@php
  $modul = \App\Models\Modul::where('nama', $jenis_dokumen)->first();
  $title = $modul->label;
@endphp
@extends('stisla.layouts.table')

@section('konten')
  <div class="section-header">
    <h1> <i class="{{ $modul->ikon }}"></i> {{ $title }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ label_dashboard() }}</a></div>
      <div class="breadcrumb-item">{{ $title }}</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">

        @if (Auth::user()->role == 'superadmin')
          <div class="alert alert-info">
            Untuk superadmin tidak bisa menambahkan arsip, hanya diperuntukkan bagi admin kantor. Superadmin hanya bisa preview, unduh dan cetak
          </div>
        @endif


        @if (count($tahun) > 0)
          <div class="alert alert-info">
            Preview hanya bisa dilakukan jika berkas berformat <span class="badge badge-danger">pdf</span> dan pastikan anda tidak mengunduh <a href="https://www.internetdownloadmanager.com/"> Internet Download Manager</a>
            dikarenakan preview tidak akan tampil akan langsung diunduh
          </div>

          <div class="card">
            <div class="card-header">
              <h4>
                <i class="{{ $modul->ikon }}"></i> Filter {{ $title }} berdasarkan tahun
              </h4>
            </div>
            <div class="card-body">

              <form action="">
                @csrf

                @select(['id' => 'tahun', 'select_data' => $tahun])

                <button type="submit" class="btn btn-primary btn-sm">Lihat</button>

                <a target="_blank" href="#" onclick="laporan(event, this)" data-href="{{ $action_laporan }}" class="btn btn-success btn-sm"> <i class="fas fa-file"></i> Laporan
                </a>
                <a target="_blank" href="#" onclick="laporan(event, this)" data-href="{{ $action_laporan_pdf }}" class="btn btn-danger btn-sm"> <i class="fas fa-file-pdf"></i> Laporan PDF
                </a>
              </form>
            </div>
          </div>
        @else
          <div class="alert alert-info">
            1. Preview hanya bisa dilakukan jika berkas berformat <span class="badge badge-danger">pdf</span> dan pastikan anda tidak mengunduh <a href="https://www.internetdownloadmanager.com/"> Internet Download
              Manager</a> dikarenakan preview tidak akan tampil akan langsung diunduh.
            <br>
            2. Laporan akan muncul ketika sudah ada data
          </div>
        @endif


        <div class="card">
          <div class="card-header">
            <h4> <i class="{{ $modul->ikon }}"></i> {{ $title }} </h4>
            @if (Auth::user()->role == 'admin')
              &nbsp; &nbsp; &nbsp;
              <a href="{{ $action_tambah }}" class="btn btn-primary float-right"> <i class="fas fa-plus"></i> Baru
              </a>
            @endif
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
                    @if ($jenis_dokumen == 'surat_keluar')
                      <th>Penerima</th>
                    @endif
                    @if ($jenis_dokumen == 'surat_masuk')
                      <th>Pengirim</th>
                      <th>Maksud Surat</th>
                    @endif
                    @if ($jenis_dokumen == 'pegawai')
                      <th>Pegawai</th>
                    @endif
                    @if ($jenis_dokumen == 'undangan')
                      <th>Acara</th>
                      <th>Delegasi Hadir</th>
                      <th>Tempat</th>
                      <th>Pengundang</th>
                    @endif
                    <th>Ekstensi</th>
                    <th>Berkas</th>
                    <th>Keterangan</th>
                    @if (Auth::user()->role == 'admin')
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
                      @if ($jenis_dokumen == 'surat_keluar')
                        <td>{{ $d->penerima }}</td>
                      @endif
                      @if ($jenis_dokumen == 'surat_masuk')
                        <td>{{ $d->pengirim }}</td>
                        <td>{{ $d->maksud_surat }}</td>
                      @endif
                      @if ($jenis_dokumen == 'pegawai')
                        <td>{{ $d->pegawai }}</td>
                      @endif
                      @if ($jenis_dokumen == 'undangan')
                        <td>{{ $d->acara }}</td>
                        <td>{{ $d->delegasi_hadir }}</td>
                        <td>{{ $d->tempat }}</td>
                        <td>{{ $d->pengundang }}</td>
                      @endif
                      <td>{!! $d->ekstensi_berkas_label !!}</td>
                      <td>
                        @if ($d->berkas)
                          <a data-toggle="tooltip" title="Unduh" class="btn btn-primary btn-sm" href="{{ route('arsip.unduh', [$jenis_dokumen, $d->id]) }}" target="_blank">
                            <i class="fas fa-download"></i>
                          </a>
                          <a data-toggle="tooltip" title="Preview" class="btn btn-success btn-sm" href="{{ route('arsip.preview', [$jenis_dokumen, $d->id]) }}" target="_blank">
                            <i class="fas fa-eye"></i>
                          </a>
                        @else
                          -
                        @endif
                      </td>
                      <td>{{ $d->keterangan }}</td>
                      @if (Auth::user()->role == 'admin')
                        <td>
                          <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton{{ $loop->iteration }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aksi
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item has-icon" href="{{ route('arsip.edit', [$jenis_dokumen, $d->id]) }}">
                              <i class="fas fa-edit"></i> Ubah
                            </a>
                            <a onclick="hapus(event, '{{ route('arsip.destroy', [$jenis_dokumen, $d->id]) }}')" class="dropdown-item has-icon" href="#">
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


@push('script')
  <script>
    function laporan(e, elem) {
      e.preventDefault();
      var url = $(elem).data('href') + '?tahun=' + $('#tahun').val();
      window.open(url);
    }
  </script>
@endpush
