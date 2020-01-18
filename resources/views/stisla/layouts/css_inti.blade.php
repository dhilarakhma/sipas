<!-- General CSS Files -->
@if(config('stisla.online', false))
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
@else
<link rel="stylesheet" href="{{ asset('stisla/node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/node_modules/font-awesome/css/font-awesome.min.css') }}">
@endif

<!-- CSS Libraries -->
@php
if(isset($_css_tambahan)){
    foreach ($_css_tambahan as $css) {
        echo '<link rel="stylesheet" href="'.$css."\">\n";
    }
}
@endphp

@stack('select2_css')
@stack('daterangepicker_css')
@stack('css')

<!-- Template CSS -->
<link rel="stylesheet" href="{{ asset('stisla/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/assets/css/components.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/assets/css/styleku.css') }}">

<!-- Your Style -->
@stack('style')
