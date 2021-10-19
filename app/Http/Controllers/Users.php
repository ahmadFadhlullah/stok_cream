<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\StokCream;

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
        return view('user.tabel_cream', compact('fetch_cream_all'));
    }

    public function hapus_cream(Request $request)
    {
        $id = $request->id;
        $find = StokCream::find($id);
        $find->delete();
        return 'berhasil';
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
}
