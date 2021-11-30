@extends('master.layout')
@section('css')
<link rel="stylesheet" href="{{ asset('lib/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/css/tabel_cream.css') }}">
@endsection
@section('content')
                <div class="container">
                    <div class="card shadow mb-4 mt-2">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List Product</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Cream</th>
                                            <th>Stok Cream</th>
                                            <th>Kode Cream</th>
                                            <th>Keterangan</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Cream</th>
                                            <th>Stok Cream</th>
                                            <th>Kode Cream</th>
                                            <th>Keterangan</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($stok_menipis as $cream)
                                            <tr>
                                                <td>{{ $cream->nama_cream }}</td>
                                                <td>{{ $cream->jumlah }}</td>
                                                <td>{{ $cream->kode_cream }}</td>
                                                <td>{{ $cream->keterangan }}</td>
                                                <td>{{ $cream->harga }}</td>
                                                <td>
                                                    @if($cream->status == 'warning')
                                                        <span class="badge badge-pill bg-warning text-dark">{{ $cream->status }}</span>
                                                    @elseif($cream->status == 'long')
                                                        <span class="badge badge-pill bg-success">{{ $cream->status }}</span>
                                                    @else
                                                        <span class="badge badge-pill bg-danger text-light">{{ $cream->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('edit_cream', $cream->id) }}" class="btn btn-sm">Edit</a>
                                                        <a href="{{ route('edit_cream', $cream->id) }}" class="btn btn-sm">detail</a>
                                                        <button class="btn btn-sm" onclick='alertSwal("{{ $cream->id }}")' >Delete</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@section('javascript')
<script src="{{ asset('jquery.js') }}"></script>
<script src="{{ asset('lib/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('lib/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function(){
            $('#dataTable').DataTable();
        });
</script>
@endsection