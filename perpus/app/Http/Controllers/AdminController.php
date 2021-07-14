<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;
use App\Peminjaman;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function dashboard()
    {
        $data = Buku::with('penerbit', 'pengarang', 'katalog')->get();
        return $data;
        return view('admin.dashboard');
    }
    public function katalog()
    {
        return view('admin.katalog');
    }

    public function penerbit()
    {
        return view('admin.penerbit');
    }
    public function pengarang()
    {
        return view('admin.pengarang');
    }
    public function anggota()
    {
        return view('admin.anggota');
    }
}
