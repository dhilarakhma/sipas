@input(['class_append'=>'datepicker', 'ikon'=>'fas fa-calendar'])

@if(!defined('DATERANGEPICKER_INCLUDED'))

@php
    define('DATERANGEPICKER_INCLUDED', true);
@endphp

@push('daterangepicker_js')
<script src="{{ asset('stisla/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endpush

@push('daterangepicker_css')
<link rel="stylesheet" href="{{ asset('stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@endif