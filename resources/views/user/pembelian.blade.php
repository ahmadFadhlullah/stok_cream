@extends('master.layout')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('lib/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/css/index.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="card shadow mb-4 mt-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">History Pembelian Krim</h6>
                <form action="{{ route('cetak_laporan') }}" method="post">
                    @csrf 
                    <div class="row mt-3">
                    <div class="col-3">
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-success">Cetak Laporan</button>
                    </div>
                </div>
                </form>
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($history_pembelis as $history_pembeli)
                                <tr>
                                    <td>{{ $history_pembeli->nama_pembeli }}</td>
                                    <td>{{ $history_pembeli->nama_cream }}</td>
                                    <td>{{ $history_pembeli->jumlah }}</td>
                                    <td>{{ $history_pembeli->created_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button onclick="deleteUser(this)" id="{{ $history_pembeli->id }}" class="btn btn-warning"> <i class="fa fa-trash"></i> </button>
                                            <a href="{{ route('edit_pembeli', $history_pembeli->id) }}" class="btn btn-success"> <i class="fa fa-edit"></i> </a>
                                            <button class="btn btn-warning"> <i class="fa fa-eye"></i> </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Pembeli</th>
                                <th>Krim</th>
                                <th>Jumlah Pembelian</th>
                                <th>Tanggal Pembelian</th>
                                <th>Aksi</th>
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
        function deleteUser(el)
        {
            let id = el.id;
            let res = confirm(`ingin menghapus ${id} ?`);
            if(res)
            {
                $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                $.ajax({
                    url : "{{ route('hapus_pembeli') }}",
                    type : "POST",
                    data : {
                        id : `${id}`
                    },
                    success : function(data)
                    {
                        alert('berhasil menghapus data pembeli');
                        location.reload();

                    },
                    error : function(error)
                    {
                        alert('terjadi error pada '+error);
                    }
                });
            }
        }
    </script>
    <script>
        $(document).ready(function(){
            $('#dataTable').DataTable();
        });

        
    </script>
@endsection