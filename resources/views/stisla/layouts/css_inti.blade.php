<!-- General CSS Files -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- CSS Libraries -->
@php
  if (isset($_css_tambahan)) {
      foreach ($_css_tambahan as $css) {
          echo '<link rel="stylesheet" href="' . $css . "\">\n";
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
