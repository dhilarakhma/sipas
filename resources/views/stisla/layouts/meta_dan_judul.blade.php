@php
    $_nama_aplikasi = config('stisla.nama_aplikasi');
    $_meta_description = \App\Models\Pengaturan::where('key', 'meta_description')->first()->value;
    $_meta_keywords = \App\Models\Pengaturan::where('key', 'meta_keywords')->first()->value;
    $_meta_author = config('stisla.nama_developer');
@endphp
<meta charset="UTF-8">
<meta name="description" content="{{ $_meta_description }}">
<meta name="keywords" content="{{ $_meta_keywords }}">
<meta name="author" content="{{ $_meta_author }}">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>{{ $title }} &mdash; {{ $_nama_aplikasi }}</title>
@php
    $_favicon = \App\Models\Pengaturan::where('key', 'favicon')->first()->value;
@endphp
<!-- Favicon -->
<link rel="shortcut icon" href="{{ $_favicon }}" type="image/x-icon">
