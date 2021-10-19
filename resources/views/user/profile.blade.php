@extends('master.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('custom/css/profile.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="box-large">
            <div class="profil">
                <div class="wp-images">
                    <img src="{{ asset('profil/'.$profilFoto) }}" class="foo" alt="" srcset="">
                </div>
                <div class="text-100">
                    <h2>{{ Auth::user()->name }}</h2>
                </div>
                <div class="text-100">
                    <span>{{ Auth::user()->email }}</span>
                </div>
                <div class="text-100 margin-top-5">  
                <button class="button" data-toggle="modal" data-target="#exampleModal">Ubah Profil</button>
                </div>
            </div>
        </div>
        <form action="{{ route('ubah.profil') }}" method="post">
            @csrf
            <div class="text-between">
                <span>Nama User</span>
                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="input">
            </div>
            <div class="text-between">
                <span>Email User</span>
                <span>{{ Auth::user()->email }}</span>
            </div>
            <div class="text-between">
                <span>ID User</span>
                <span>{{ Auth::user()->id }}</span>
            </div>
            <button class="button">Simpan Perubahan</button>
        </form>
        
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('ubah.foto') }}" method="post" enctype="multipart/form-data">
                @csrf 
                <div class="form-group">
                    <input type="file" name="url_image" id="url_image" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Ubah Profil</button>
            </form>
        </div>
        </div>
    </div>
    </div>
    <!-- End Modal -->
@endsection
@section('javascript')

@endsection