@extends('master.layout')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('lib/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/css/tabel_cream.css') }}">
@endsection

@section('content')
<div class="container">
    <h3>
        Stok Krim
    </h3><!-- Button trigger modal -->
<button type="button" class="button-dark margin-3" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

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
        <form action="" method="post">
            @csrf 
            <div class="form-group">
                <label for=""></label>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- end modal -->
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
                                            <th>Keterangan</th>
                                            <th>Kode Cream</th>
                                            <th>Harga</th>
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
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($fetch_cream_all as $cream)
                                            <tr>
                                                <td>{{ $cream->nama_cream }}</td>
                                                <td>{{ $cream->stok_cream }}</td>
                                                <td>{{ $cream->kode_cream }}</td>
                                                <td>{{ $cream->keterangan }}</td>
                                                <td>{{ $cream->harga }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm">Edit</button>
                                                        <button class="btn btn-sm">detail</button>
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
    <script src="{{ asset('lib/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('lib/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('sweetalert.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#dataTable').DataTable();
        });
        function alertSwal(id)
        {
            let id_cream = parseInt(id);
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url : "{{ route('hapus_cream') }}",
                            type : "POST",
                            data : { id : `${id_cream}` },
                            success : function(result){
                                swal({
                                    text : "Berhasil menghapus item",
                                    icon : "success",
                                    dangerMode : true,
                                }).then((sukses)=>{
                                    if(sukses)
                                    {
                                        window.location.href = "{{ route('tabel_cream') }}";
                                    }
                                })
                            },
                            error : function(error){
                                console.log(error);
                            }
                        });
                    } else {
                        
                    }
                });
        }
    </script>
@endsection