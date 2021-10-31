@extends('master.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('custom/css/index.css') }}">
@endsection
@section('content')
    <div class="container">
        @if(Session::has('pesan'))
            <div class="alert alert-danger">{{ Session::get('pesan') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Form Edit Pembeli</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('edit_pembeli_form', $find->id) }}" method="post">
                    @csrf 
                    <div class="row">
                        <div class="col-3">
                            <label for="nama_pembeli"><b>Nama Pembeli</b></label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="nama_pembeli" id="nama_pembeli" value="{{ $find->nama_pembeli }}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="kode_cream"><b>Krim</b></label>
                        </div>
                        <div class="col-9">
                            <select name="kode_cream" id="kode_cream" class="form-control">
                                @foreach($produk as $item)
                                    <option value="{{ $item->kode_cream }}"
                                        @if($find->kode_cream == $item->kode_cream)
                                            selected
                                        @endif
                                    >{{ $item->nama_cream }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="jumlah"><b>Jumlah</b></label>
                        </div>
                        <div class="col-9">
                            <input type="number" name="jumlah" id="jumlah" value="{{ $find->jumlah }}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="created_at"><b>Tanggal</b></label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="created_at" id="created_at" value="{{ $find->created_at }}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascript')

@endsection