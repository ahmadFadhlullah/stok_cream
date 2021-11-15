<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use App\StokCream;
use App\HistoryPembeli;
use App\HistoryUpdateCream;

class Users extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.index');
    }

    public function tabel_cream()
    {
        $fetch_cream_all = StokCream::all();
        $stok_cream = DB :: table('stok_cream')->select('stok_cream.nama_cream','stok_cream.kode_cream')->get();
        return view('user.tabel_cream', compact('fetch_cream_all','stok_cream'));
    }

    public function pembelianForm(Request $request)
    {
        
        
        for($x = 0; $x < count($request->nama_pembeli); $x++)
        {

            $kode_cream = $request->kode_cream[$x];
            $find_cream = DB :: table('stok_cream')->select('id','kode_cream','nama_cream','jumlah')->where([
                ['kode_cream','=',"$kode_cream"]
            ])->get();
            
            $id_cream = $find_cream[0]->id;
            $find_cream_model = StokCream::find($id_cream);
            $find_cream_model->jumlah = $find_cream[0]->jumlah - $request->jumlah[$x];
            $find_cream_model->update();
            // array_push($nama_pembeli, $request->nama_pembeli[$x]);
            $historyPembeli = new HistoryPembeli;
            $historyPembeli->nama_pembeli = $request->nama_pembeli[$x];
            $historyPembeli->kode_cream = $request->kode_cream[$x];
            $historyPembeli->jumlah = $request->jumlah[$x];
            // $historyPembeli->tanggal_masuk = $request->tanggal_masuk[$x];
            if($request->tanggal_masuk[$x] == null)
            {
                $historyPembeli->tanggal_masuk = Carbon::now();
            } else 
            {
                $historyPembeli->tanggal_masuk = $request->tanggal_masuk[$x];
            }
            $historyPembeli->save();
        }

        return redirect()->back()->with('pesan','berhasil menambahkan data pembeli baru');
        // dd($nama_pembeli);
    }

    public function hapusPembeli(Request $request)
    {
        $id = $request->id;
        $findFromHistoryPembeli = HistoryPembeli::find($id);
        $findFromHistoryPembeli->delete();
        return "berhasil menghapus";
    }

    public function editPembeli($id)
    {
        $find = HistoryPembeli::find($id);
        $produk = DB :: table('stok_cream')->select('nama_cream','kode_cream')->get();
        return view('user.editpembeli', compact('find','produk'));
    }

    public function editPembeliForm(Request $request, $id)
    {
        $pembeli = HistoryPembeli::find($id);
        $pembeli->nama_pembeli = $request->nama_pembeli;
        $pembeli->kode_cream = $request->kode_cream;
        $pembeli->jumlah = $request->jumlah;
        $pembeli->created_at = $request->created_at;
        $pembeli->update();
        return redirect()->back()->with('pesan', 'berhasil mengupdate data pembeli');
    }

    public function tambah_cream(Request $request)
    {

        $keterangan = $request->keterangan;
        
        $stokcream = new StokCream;
        $stokcream->nama_cream = $request->nama_cream;
        $stokcream->kode_cream = $request->kode_cream;
        $stokcream->jumlah = $request->jumlah;
        $stokcream->harga = $request->harga;
        $stokcream->tanggal_kadaluwarsa = $request->tanggal_kadaluwarsa;
        $stokcream->keterangan = $keterangan;
        $stokcream->status = 'long';
        $stokcream->save();
        return redirect()->back()->with('pesan','berhasil menambahkan krim baru');

    }

    public function edit_cream($id)
    {
        $find_cream = StokCream::find($id);
        return view('user.editcream', compact('find_cream'));
    }

    public function update_stok_cream(Request $request, $id)
    {
        $find_cream = StokCream::find($id);

        
        $find_cream->nama_cream = $request->nama_cream;
        $find_cream->jumlah = $request->jumlah;
        $find_cream->harga = $request->harga;
        $find_cream->kode_cream = $request->kode_cream;
        $find_cream->tanggal_kadaluwarsa = $request->tanggal_kadaluwarsa;
        $find_cream->keterangan = $request->keterangan;
        $find_cream->update();
        $historyupdatecream = new HistoryUpdateCream;
        $historyupdatecream->nama_cream = $request->nama_cream;
        $historyupdatecream->jumlah = $request->jumlah;
        $historyupdatecream->harga = $request->harga;
        $historyupdatecream->kode_cream = $request->kode_cream;
        $historyupdatecream->tanggal_kadaluwarsa = $request->tanggal_kadaluwarsa;
        $historyupdatecream->keterangan = $request->keterangan;
        $historyupdatecream->bagian = 'edit_stok_cream';
        $historyupdatecream->save();
        
        return redirect()->back()->with('success', 'berhasil mengedit produk');
    }
    public function update_cream(Request $request)
    {
        $find_cream = StokCream::find($request->id);
        $stok_terkini = $find_cream->jumlah;

        $historyupdatecream = new HistoryUpdateCream;
        $historyupdatecream->kode_cream = $find_cream->kode_cream;
        $historyupdatecream->jumlah_update = $request->jumlah_update;
        $historyupdatecream->jumlah_sebelum = $stok_terkini;
        $historyupdatecream->jumlah_setelah = $stok_terkini + $request->jumlah_update;
        $historyupdatecream->keterangan = $request->catatan;
        $historyupdatecream->bagian = 'update_cream';
        $historyupdatecream->save();

        $find_cream->jumlah = $request->jumlah_update + $stok_terkini;
        $find_cream->update();
        return redirect()->back()->with('success', 'berhasil update stok cream');
    }

    public function hapus_cream(Request $request)
    {
        $id = $request->id;
        $find = StokCream::find($id);
        $find->delete();
        return 'berhasil';
    }

    // pembelian

    public function pembelian()
    {
        $history_pembelis = DB :: table('history_pembelis')->join('stok_cream','history_pembelis.kode_cream','=','stok_cream.kode_cream')->select('history_pembelis.*','stok_cream.nama_cream')->get();
        return view('user.pembelian', compact('history_pembelis'));
    }

    // profile
    public function profile()
    {
        $profil = User::find(Auth::user()->id);
        $profilFoto = $profil->url_image;
        return view('user.profile', compact('profilFoto'));
    }
    public function ubahFoto(Request $request)
    {
        $find = User::find(Auth::user()->id);
        $foto = $request->url_image;
        $fotoName = time().'.'.$foto->getClientOriginalExtension();
        $foto->move('profil/', $fotoName);
        $find->url_image = $fotoName;
        $find->update();
        return redirect()->back()->with('pesan', 'berhasil update foto profile');
        // dd($request);
    }
    public function ubahProfil(Request $request)
    {
        $find = User::find(Auth::user()->id);
        $find->name = $request->name;
        $find->update();
        return redirect()->back()->with('pesan', 'berhasil ');
    }
    // end profile

    public function buatLaporan()
    {
        return view('user.laporan');
    }
    public function cetakLaporan(Request $request)
    {
        $bulan = $request->bulan;
        $timeNow = Carbon::now();
        $bulanNow;
        // array time
        $timeArr = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];

        foreach($timeArr as  $key => $value)
        {
            if($bulan == $key)
            {
                $bulanNow = $value;
            }
        }

        // $search = DB :: table("history_pembelis")->join('stok_cream','history_pembelis.kode_cream','=','stok_cream.kode_cream')->select(DB::raw('SUM(history_pembelis.jumlah) AS banyaknya'),'stok_cream.kode_cream','stok_cream.created_at','stok_cream.nama_cream')->whereMonth('history_pembelis.created_at','=',"$bulan")->groupBy('stok_cream.nama_cream')->get();
        $search = DB :: table('history_pembelis')->join('stok_cream','history_pembelis.kode_cream','=','stok_cream.kode_cream')->select('stok_cream.jumlah','history_pembelis.kode_cream','stok_cream.nama_cream','stok_cream.nama_cream',DB::raw('SUM(history_pembelis.jumlah) AS total'))->whereMonth('history_pembelis.tanggal_masuk','=',$bulan)->groupBy('history_pembelis.kode_cream')->get();
        return view('user.cetak', compact('search','timeNow','bulanNow'));
        // return $search;

    }

    public function stokMenipis()
    {
        $carbonNow = Carbon::now();

        $arr_diff = [];
        $selectTanggal = DB :: table('stok_cream')->select('stok_cream.*')->get();
        foreach($selectTanggal as $selecttanggal)
        {
            // $diffcarbon = new Carbon($selecttanggal->tanggal_kadaluwarsa);
            // array_push($arr_diff,$diffcarbon);
            $diffcarbon = new Carbon($selecttanggal->tanggal_kadaluwarsa);
            $arr = [
                "id" => $selecttanggal->id,
                "nama_cream" => $selecttanggal->nama_cream,
                "kode_cream" => $selecttanggal->kode_cream,
                "tanggal_kadaluwarsa" => $diffcarbon,
                "sisa hari" => $diffcarbon->diff($carbonNow)->days,
            ];
            array_push($arr_diff,$arr);
        }
        return $this->changeStatus($arr_diff);
    }

    protected function changeStatus($arr)
    {
        foreach($arr as $item)
        {
            if($item['sisa hari'] < 30)
            {
                $status = StokCream::find($item['id']);
                $status->status = 'warning';
                $status->update();
                return redirect()->back();
            } else if($item['sisa hari'] < 1)
            {
                $status = StokCream::find($item['id']);
                $status->status = 'expired';
                $status->update();
                return redirect()->back();
            }
        }
    }
}
