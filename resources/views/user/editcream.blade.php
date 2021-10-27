@extends('master.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('lib/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/css/index.css') }}">
@endsection
@section('content')
    <div class="container">
        <h3>
            Edit Krim
        </h3>
        @if(Session::has('success'))
            <div class="alert alert-info">{{ Session::get('success') }}</div>
        @endif
        <div class="card shadow mb-4 p-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Product</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <form action="{{ route('update_stok_cream', $find_cream->id) }}" method="post">
                            @csrf 
                            <div class="form-group">
                                <label for="nama_cream">Nama Krim</label>
                                <input type="text" name="nama_cream" id="nama_cream" class="form-control" value="{{ $find_cream->nama_cream }}">
                            </div>
                            <div class="form-group">
                                <label for="kode_cream">Kode Krim</label>
                                <input type="text" name="kode_cream" id="kode_cream" class="form-control" value="{{ $find_cream->kode_cream }}">
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $find_cream->jumlah }}">
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga Krim</label>
                                <input type="number" name="harga" id="harga" class="form-control" value="{{ $find_cream->harga }}">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_kadaluwarsa">Tanggal Kadaluwarsa Krim</label>
                                <input type="date" name="tanggal_kadaluwarsa" id="tanggal_kadaluwarsa" class="form-control" value="{{ $find_cream->tanggal_kadaluwarsa }}">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Catatan</label>
                                <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control">{{ $find_cream->keterangan }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-dark w-100">Simpan Perubahan</button>
                        </form>
                    </div>
                    <div class="col-6">
                        <div class="alert alert-info">
                            form dibawah ini untuk update stok krim (masuk krim baru).
                            selain menggunakan penanggalan manual, form menggunakan sistem otomatis yang menyimpan data update krim dalam history admin
                        </div>
                        <form action="{{ route('update_cream') }}" method="post">
                            @csrf 
                            <input type="hidden" name="id" value="{{ $find_cream->id }}">
                            <div class="form-group">
                                <label for="nama_cream">Nama Krim</label>
                                <input type="text" name="nama_cream" id="nama_cream" class="form-control" value="{{ $find_cream->nama_cream }}">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_update">Jumlah Krim </label>
                                <input type="number" name="jumlah_update" id="jumlah_update" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="catatan">Catatan Tambahan</label>
                                <textarea name="catatan" id="catatan" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Update Krim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection