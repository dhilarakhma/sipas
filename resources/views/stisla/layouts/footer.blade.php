@php
  $_nama_aplikasi = config('stisla.nama_aplikasi');
  $_nama_developer = config('stisla.nama_developer');
  $_whatsapp_developer = config('stisla.whatsapp_developer');
  $_tahun = \App\Models\Pengaturan::where('key', 'tahun')->first()->value;
  $_versi = config('stisla.versi');
@endphp
<footer class="main-footer">
	<div class="footer-left">
		Copyright &copy; {{ $_tahun }} <div class="bullet"></div> <a href="{{ route('dashboard') }}">{{ $_nama_aplikasi }}</a> 
		<span> ♥ Aplikasi dibuat oleh {{ $_nama_developer }}</span>
		<span> ♥ WhatsApp di <a href="https://wa.me/{{ $_whatsapp_developer }}" target="_blank">{{ $_whatsapp_developer }}</a></span>
	</div>
	<div class="footer-right">
		Versi {{ $_versi }}
	</div>
</footer>