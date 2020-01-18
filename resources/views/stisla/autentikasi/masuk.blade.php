@php
  $_nama_aplikasi = config('stisla.nama_aplikasi');
  $_nama_perusahaan = \App\Models\Pengaturan::where('key', 'nama_perusahaan')->first()->value;
  $_kota = \App\Models\Pengaturan::where('key', 'kota')->first()->value;
  $_negara = \App\Models\Pengaturan::where('key', 'negara')->first()->value;
  $_logo = \App\Models\Pengaturan::where('key', 'logo')->first()->value;
  $_background_masuk = \App\Models\Pengaturan::where('key', 'background_masuk')->first()->value;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  @include('stisla.layouts.meta_dan_judul')
  @php
      $_css_tambahan = [asset('stisla/node_modules/bootstrap-social/bootstrap-social.css')];
  @endphp
  @include('stisla.layouts.css_inti')
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="d-flex flex-wrap align-items-stretch">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                    <div class="p-4 m-3">
                        <div class="align-self-center">
                            <img src="{{ $_logo }}" alt="{{ $_nama_aplikasi }}" width="80"
                                class="shadow-light rounded-circle mb-5 mt-2">
                            <h4 class="text-dark font-weight-normal">Selamat datang di <span
                                    class="font-weight-bold">{{ $_nama_aplikasi }}</span></h4>
                            <h5 class="text-dark font-weight-normal">{{ $_nama_perusahaan }}</h5>
                            <p class="text-muted">Sebelum memulai, anda harus masuk terlebih dahulu dengan akun anda.
                            </p>
                        </div>
                        <form method="POST" action="{{ route('masuk') }}" class="needs-validation" novalidate="">
                            @csrf
                            @email
                            @password

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                        id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Ingat Saya</label>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                                    Masuk
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-5 text-small">
                            Copyright &copy; {{ config('app.company_name') }}. Dibuat dengan 💙 Stisla
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
                    data-background="{{ $_background_masuk }}">
                    <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">
                                <h1 class="mb-2 display-4 font-weight-bold" id="sapaan">Selamat Pagi</h1>
                                <h5 class="font-weight-normal text-muted-transparent">{{ $_kota }}, {{ $_negara }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('stisla.layouts.js_inti')

</body>

</html>
