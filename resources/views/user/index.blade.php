@extends('master.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('lib/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/css/index.css') }}">
@endsection

@section('content')
<div class="container">
    <h3>
        Stok Krim
    </h3>
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List Product</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Treatment</th>
                                            <th>Kode Treatment</th>
                                            <th>Usia</th>
                                            <th>Nama Paket</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Treatment</th>
                                            <th>Kode Treatment</th>
                                            <th>Usia</th>
                                            <th>Nama Paket</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
</div>
@endsection

@section('javascript')
    <script src="{{ asset('lib/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('lib/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#dataTable').DataTable();
        });
    </script>
@endsection