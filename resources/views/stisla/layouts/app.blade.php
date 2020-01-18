<!DOCTYPE html>
<html lang="en">

<head>

    @include('stisla.layouts.meta_dan_judul')
    @include('stisla.layouts.css_inti')

</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            @include('stisla.layouts.navbar')
            @include('stisla.layouts.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    @yield('konten')
                </section>
            </div>
            @include('stisla.layouts.footer')
        </div>
    </div>

    @include('stisla.layouts.js_inti')

</body>

</html>
