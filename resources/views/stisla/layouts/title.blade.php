@php
  $_nama_aplikasi = \App\Models\Pengaturan::where('key', 'nama_aplikasi')->first()->value;
@endphp
<title>{{ $title }} &mdash; {{ $_nama_aplikasi }}</title>