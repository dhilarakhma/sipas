@extends('stisla.layouts.form')

@section('konten')
<div class="section-header">
    <h1> <i class="{{$modul->ikon}}"></i> {{ $title }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{label_dashboard()}}</a></div>
        <div class="breadcrumb-item"><a href="{{ route('kantor.index') }}">{{ $modul->label }}</a></div>
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
                                @input(['id'=>'kantor', 'value'=>isset($d)?$d->nama : '', 'ikon'=>$modul->ikon])
                            </div>

                            <div class="col-md-6">
                                @input(['id'=>'nama_admin', 'value'=>isset($d)?$d->user->nama : '', 'ikon'=>'fas fa-user'])
                            </div>

                            <div class="col-md-6">
                                @email(['value'=>isset($d)?$d->user->email : ''])
                            </div>

                            <div class="col-md-6">
                                @password(['required'=>isset($d)?false:true])
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
