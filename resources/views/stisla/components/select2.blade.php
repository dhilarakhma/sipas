@select(['class_append'=>'select2'])

@if(!defined('SELECT2_INCLUDED'))

    @php
        define('SELECT2_INCLUDED', true);
    @endphp

    @push('select2_css')
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/select2/dist/css/select2.min.css') }}">
    @endpush
    
    @push('select2_js')
    <script src="{{ asset('stisla/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
    @endpush

@endif
