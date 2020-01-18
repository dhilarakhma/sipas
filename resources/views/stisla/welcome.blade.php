<!doctype html>
<html lang="en">

<head>
    @include('stisla.layouts.meta_dan_judul')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('stisla/welcome/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/welcome/vendors/linericon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/welcome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/welcome/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/welcome/vendors/animate-css/animate.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('stisla/welcome/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/welcome/css/styleku.css') }}">
</head>

<body>

    <!--================Header Menu Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{ url('') }}">
                        <img class="logoku"
                            src="{{ $_logo = \App\Models\Pengaturan::where('key', 'logo')->first()->value }}"
                            alt="{{ config('stisla.nama_aplikasi') }}">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav justify-content-center">
                            <li class="nav-item active"><a class="nav-link" href="{{ url('') }}">Beranda</a></li>
                            <li class="nav-item"><a target="_blank" class="nav-link"
                                    href="https://wa.me/{{ config('stisla.whatsapp_developer') }}">WhatsApp</a></li>
                            <li class="nav-item"><a class="nav-link"
                                    href="https://github.com/{{ config('stisla.github_developer') }}">Github</a>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            @if(Auth::check())
                            <li class="nav-item"><a href="{{ route('dashboard') }}" class="primary_btn">Dashboard</a>
                            </li>
                            @else
                            <li class="nav-item"><a href="{{ route('masuk') }}" class="primary_btn">Masuk</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================Header Menu Area =================-->

    <!--================Home Banner Area =================-->
    <section class="home_banner_area">
        <div class="banner_inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="home_left_img">
                            <img class="img-fluid" src="{{ asset('stisla/welcome/img/banner/home-left.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="banner_content">
                            <h2>
                                {{ config('stisla.nama_aplikasi') }}
                            </h2>
                            <h3>
                                {{ $_logo = \App\Models\Pengaturan::where('key', 'nama_perusahaan')->first()->value }}
                            </h3>
                            <div class="d-flex align-items-center">
                                <a id="play-home-video" class="video-play-button" href="{{ route('dashboard') }}">
                                    <span></span>
                                </a>
                                <div class="watch_video text-uppercase">
                                    Ke aplikasi
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('stisla/welcome/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('stisla/welcome/js/popper.js') }}"></script>
    <script src="{{ asset('stisla/welcome/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('stisla/welcome/js/stellar.js') }}"></script>
    <script>
        function fixHeight() {
            var lebar_layar = $(window).outerWidth();
            if (lebar_layar <= 768) {
                $('.home_banner_area').css({
                    height: $(window).outerHeight() - 71,
                })
            } else {
                $('.home_banner_area').css({
                    height: $(window).outerHeight(),
                })
            }
        }

        window.addEventListener("resize", fixHeight);

		fixHeight();

    </script>
</body>

</html>
