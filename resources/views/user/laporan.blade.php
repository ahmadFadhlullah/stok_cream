@extends('master.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('custom/css/laporan.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Buat Laporan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('cetak_laporan') }}" method="post">
                    @csrf 
                    <div class="form-group">
                        <label for=""></label>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascript')

@endsection