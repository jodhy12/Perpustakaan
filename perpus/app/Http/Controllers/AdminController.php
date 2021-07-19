<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;
use App\Katalog;
use App\Penerbit;
use App\Pengarang;
use App\Anggota;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function dashboard()
    {
        $data_buku = Buku::orderBy('isbn', 'desc')->get();
        return $data_buku;
        return view('admin.dashboard');
    }
    public function katalog()
    {
        $data_katalog = Katalog::all();
        return view('admin.katalog.katalog', compact('data_katalog'));
    }

    public function penerbit()
    {
        $data_penerbit = Penerbit::count();
        return $data_penerbit;
        return view('admin.penerbit');
    }
    public function pengarang()
    {
        $data_pengarang = Pengarang::whereBetween('id', [2, 4])->get();
        return $data_pengarang;
        return view('admin.pengarang');
    }
    public function anggota()
    {
        $data_anggota = Anggota::where('alamat', 'like', '%bandung%')->get();
        return $data_anggota;
        return view('admin.anggota');
    }
}
