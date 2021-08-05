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
        // $data_buku = Buku::orderBy('isbn', 'desc')->get();
        // return $data_buku;
        // return view('admin.dashboard');
    }
    public function katalog()
    {
        $data_katalog = Katalog::all();
        return view('admin.katalog.katalog', compact('data_katalog'));
    }

    public function penerbit()
    {
        $data_penerbit = Penerbit::all();
        return view('admin.penerbit', compact('data_penerbit'));
    }
    public function pengarang()
    {
        $data_pengarang = Pengarang::all();
        return view('admin.pengarang', compact('data_pengarang'));
    }
    public function anggota()
    {
        $data_anggota = Anggota::all();
        return view('admin.anggota', compact('data_anggota'));
    }
    public function buku()
    {
        $data_buku = Buku::all();
        return view('admin.buku', compact('data_buku'));
    }
}
