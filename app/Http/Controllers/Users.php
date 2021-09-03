<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
}
