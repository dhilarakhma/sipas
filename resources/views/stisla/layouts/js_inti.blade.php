@stack('modal')

<form action="" type="submit" id="form-hapus">
    @method('DELETE')
    @csrf
</form>

<!-- General JS Scripts -->
@if(config('stisla.online', false))
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
@else
<script src="{{ asset('stisla/node_modules/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('stisla/node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('stisla/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('stisla/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('stisla/node_modules/moment/min/moment.min.js') }}"></script>
@endif
@stack('select2_js')
@stack('daterangepicker_js')
<script src="{{ asset('stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('stisla/assets/js/stisla.js') }}"></script>

<!-- JS Tambahan -->
@stack('js')

<!-- Template JS File -->
<script src="{{ asset('stisla/assets/js/scripts.js') }}"></script>
<script src="{{ asset('stisla/assets/js/custom.js') }}"></script>
<script src="{{ asset('stisla/assets/js/skripku.js') }}"></script>

<!-- Your custom script -->
@if(session('success_msg'))
<script>

    swal('Sukses', '{{ session('success_msg ') }}', 'success');
    
</script>
@endif
@stack('script')