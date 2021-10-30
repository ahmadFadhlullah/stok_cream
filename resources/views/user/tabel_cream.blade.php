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
<div class="wp-button m-3">
<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
  Tambah Krim
</button>

<button class="btn btn-success" type="button" data-toggle="modal" data-target="#Customer">
    Tambah Data Pembelian
</button>

</div>
@if(Session::has('pesan'))
    <div class="container">
        <div class="alert alert-info">{{ Session::get('pesan') }}</div>
    </div>
@endif

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
        <form action="{{ route('tambah_cream') }}" method="post">
            @csrf 
            <div class="form-group">
                <label for="nama_cream">Nama Krim</label>
                <input type="text" name="nama_cream" id="nama_cream" class="form-control">
            </div>
            <div class="form-group">
                <label for="kode_cream">Kode Krim</label>
                <input type="text" name="kode_cream" id="kode_cream" class="form-control">
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control">
            </div>
            <div class="form-group">
                <label for="harga">Harga Krim</label>
                <input type="number" name="harga" id="harga" class="form-control">
            </div>
            <div class="form-group">
                <label for="tanggal_kadaluwarsa">Tanggal Kadaluwarsa</label>
                <input type="date" name="tanggal_kadaluwarsa" id="tanggal_kadaluwarsa" class="form-control">
            </div>
            <div class="form-group">
                <label for="keterangan">Catatan</label>
                <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>
  </div>
</div>

<!-- end modal -->

<!-- modal pembeli -->

<div class="modal fade" id="Customer" tabindex="-1" aria-labelledby="CustomerBuy" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CustomerBuy">Data Pembelian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="" method="post">
                @csrf 
                <div class="first-wrap">
                    <div class="row">
                        <div class="col-3">
                            <label for="nama_pembeli"><b>Nama Pembeli</b></label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="nama_pembeli[]" id="nama_pembeli" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="kode_cream"><b>Krim</b></label>
                        </div>
                        <div class="col-9">
                            <select name="kode_cream" id="kode_cream[]" class="form-control">
                                @foreach($stok_cream as $cream)
                                    <option value="{{ $cream->kode_cream }}">{{ $cream->nama_cream }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <label for="jumlah"><b>Jumlah</b></label>
                        </div>
                        <div class="col-7">
                            <input type="number" name="jumlah[]" id="jumlah" class="form-control">
                        </div>
                        <div class="col-2">
                            <span class="btn btn-success add-more"> <b>+</b> </span>
                        </div>
                    </div>
                </div>
            </form>


            <!-- hide section -->
                <div class="hidden">
                    <div class="new-section">
                        <hr>
                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="">Nama Pembeli</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="nama_pembeli[]" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="">Krim</label>
                            </div>
                            <div class="col-9">
                                <select name="kode_cream[]" id="" class="form-control">
                                    @foreach($stok_cream as $cream)
                                        <option value="{{ $cream->kode_cream }}">{{ $cream->nama_cream }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="">Jumlah</label>
                            </div>
                            <div class="col-7">
                                <input type="number" name="jumlah[]" class="form-control">
                            </div>
                            <div class="col-2">
                                <span class="btn btn-warning" onclick="deleteElement(this)"> <b>-</b> </span>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- hidden section -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>
  </div>
</div>
<!-- end modal pembeli -->

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
                                                <td>{{ $cream->jumlah }}</td>
                                                <td>{{ $cream->kode_cream }}</td>
                                                <td>{{ $cream->keterangan }}</td>
                                                <td>{{ $cream->harga }}</td>
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
    <script src="{{ asset('sweetalert.js') }}"></script>
    <script>

        // function for add more

        $(document).ready(function(){
            $('.add-more').click(function(){
                let html = $('.hidden').html();
                $('.first-wrap').after(html);
            });
        });

        // $('.trash').click(function(){
        //     console.log($(this).parent('.new-section'));
        // })
        function deleteElement(el){
            el.parentElement.parentElement.parentElement.remove();
        }


        // end function for add more

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