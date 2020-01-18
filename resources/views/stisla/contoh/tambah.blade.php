@extends('stisla.layouts.form')

@section('konten')
<div class="section-header">
    <h1> <i class="{{$modul->ikon}}"></i> {{ $title }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{label_dashboard()}}</a></div>
        <div class="breadcrumb-item"><a href="{{ route('contoh.index') }}">{{ $modul->label }}</a></div>
        <div class="breadcrumb-item">{{ $title }}</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4> <i class="{{$modul->ikon}}"></i> {{ $title }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ $action }}" method="post" enctype="multipart/form-data" class="needs-validation">
                        @isset($d)
                        @method('PUT')
                        @endisset
                        @csrf
                        <div class="row">

                            <div class="col-md-6">
                                @input(['id'=>'ini_text', 'value'=>isset($d)?$d->ini_text : ''])
                            </div>

                            <div class="col-md-6">
                                @number(['id'=>'ini_number', 'value'=>isset($d)?$d->ini_number : ''])
                            </div>

                            <div class="col-md-6">
                                @email(['id'=>'ini_email', 'value'=>isset($d)?$d->ini_email : ''])
                            </div>

                            <div class="col-md-6">
                                @password(['id'=>'ini_password', 'required'=>false])
                            </div>

                            <div class="col-md-6">
                                @datepicker(['id'=>'ini_datepicker', 'value'=>isset($d)?$d->ini_datepicker : ''])
                            </div>

                            <div class="col-md-6">
                                @excel(['id'=>'ini_excel'])
                            </div>

                            <div class="col-md-6">
                                @gambar(['id'=>'ini_gambar', 'ikon'=>'fas fa-image'])
                            </div>

                            <div class="col-md-6">
                                @file(['id'=>'ini_file'])
                            </div>

                            <div class="col-md-6">
                                @select(['id'=>'ini_select', 'select_data'=>['Option 1'=>'Option 1', 'Option 2'=>'Option
                                2'], 'value'=>isset($d)?$d->ini_select : ''])
                            </div>

                            <div class="col-md-6">
                                @select2(['id'=>'ini_select2', 'select_data'=>['Option 1'=>'Option 1', 'Option
                                2'=>'Option 2'], 'value'=>isset($d)?$d->ini_select2 : ''])
                            </div>

                            <div class="col-md-12">
                                @textarea(['id'=>'ini_textarea', 'value'=>isset($d)?$d->ini_select : ''])
                            </div>

                            @if($action)
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                <button type="reset" class="btn btn-secondary btn-block">Batal</button>
                            </div>
                            @endif

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@if(is_null($action))
@push('script')
<script>
    $(document).ready(function () {
        $('.form-control').attr('disabled', true);
    });

</script>
@endpush
@endif
