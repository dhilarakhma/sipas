<!DOCTYPE html>
<html>
<head>
	<title>Laporan Arsip {{ $jd->nama }}</title>
	<style>
		* {
			font-family: sans-serif;
			-webkit-print-color-adjust:exact;
		}
		h1 {
			text-align: center;
		}
		table {
			width: 100%;
			border-collapse: collapse;
		}
		th,td {
			padding: 10px 15px;
			border: 1px solid #3E3E3E;
		}
		th {
			background-color: #C9C9C9;
		}
		tr:nth-child(even) td{
			background-color: #EBEBEB;
		}
	</style>
</head>
<body>
	<h1>Laporan Arsip {{ $jd->nama }}</h1>
	Tanggal: {{date('Y-m-d')}}
	@if(Auth::user()->role == 'admin')
	<br>
	Kantor: {{Auth::user()->kantor->nama}}
	<br>
	Tahun: {{$tahun}}
	@endif
	<br>
	<br>
	<table>
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
						unduh
					</a>
					<a data-toggle="tooltip" title="Preview" class="btn btn-success" href="{{ route('arsip.preview', [$jenis_dokumen, $d->id]) }}" target="_blank">
						preview
					</a>
					@else
					-
					@endif
				</td>
				<td>{{ $d->keterangan }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<script>
		window.print();
	</script>
</body>
</html>