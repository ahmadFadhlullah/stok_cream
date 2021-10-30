@extends('master.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('lib/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/css/index.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="card shadow mb-4 mt-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">History Pembelian Krim</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Pembeli</th>
                                <th>Krim</th>
                                <th>Jumlah Pembelian</th>
                                <th>Tanggal Pembelian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($history_pembelis as $history_pembeli)
                                <tr>
                                    <td>{{ $history_pembeli->nama_pembeli }}</td>
                                    <td>{{ $history_pembeli->nama_cream }}</td>
                                    <td>{{ $history_pembeli->jumlah }}</td>
                                    <td>{{ $history_pembeli->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Pembeli</th>
                                <th>Krim</th>
                                <th>Jumlah Pembelian</th>
                                <th>Tanggal Pembelian</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
<script src="{{ asset('lib/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('lib/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('sweetalert.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#dataTable').DataTable();
        });
    </script>
@endsection