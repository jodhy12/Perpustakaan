<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function dashboard()
    {
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
