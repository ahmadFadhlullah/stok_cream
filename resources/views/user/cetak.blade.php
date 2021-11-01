<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/css/laporan.css') }}">
</head>
<body>
    <div class="container">
    <div class="header mb-5 mt-5">
        <div class="detail">
            <div class="row mt-1">
                <div class="col-4">Admin</div>
                <div class="col-8">: {{ Auth::user()->name }}</div>
            </div>
            <div class="row mt-2">
                <div class="col-4">Email</div>
                <div class="col-8">: {{ Auth::user()->email }}</div>
            </div>
            <div class="row mt-2">
                <div class="col-4">Bulan Laporan</div>
                <div class="col-8">: {{ $bulanNow }}</div>
            </div>
            <div class="row mt-2">
                <div class="col-4">Tanggal Cetak</div>
                <div class="col-8">: {{ $timeNow }}</div>
            </div>
        </div>
        <div class="logo">
            <img src="{{ asset('img/amaryllis.png') }}" style="width:250px;" alt="" srcset="">
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Pembeli</th>
                <th>Nama Cream</th>
                <th>Jumlah</th>
                <th>Tanggal Pembelian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($search as $pembeli)
                <tr>
                    <td>{{ $pembeli->nama_pembeli }}</td>
                    <td>{{ $pembeli->nama_cream }}</td>
                    <td>{{ $pembeli->jumlah }}</td>
                    <td>{{ $pembeli->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</body>
</html>