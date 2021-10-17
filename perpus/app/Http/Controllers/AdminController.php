<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Buku;
use App\Katalog;
use App\Penerbit;
use App\Pengarang;
use App\Anggota;
use App\Peminjaman;
use Carbon\Carbon;

use PHPUnit\Framework\Constraint\Count;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function dashboard()
    {
        $total_buku = Buku::count();
        $total_anggota = Anggota::count();
        $total_penerbit = Penerbit::count();
        $total_peminjaman = Peminjaman::whereMonth('tgl_pinjam', date('m'))->count();

        // Untuk data grafik donut
        $data_donut = Buku::select(DB::raw("COUNT(id_penerbit) as total"))->groupBy('id_penerbit')->orderBy('id_penerbit')->pluck('total');
        $label_donut = Penerbit::orderBy('penerbit.nama_penerbit', 'asc')->join('buku', 'buku.id_penerbit', '=', 'penerbit.id')->groupBy('nama_penerbit')->pluck('nama_penerbit');

        // Untuk Bar Chart
        $label_bar = ['Peminjaman'];
        $data_bar = [];
        foreach ($label_bar as $key => $value) {
            $data_bar[$key]['label'] = $label_bar[$key];
            $data_bar[$key]['backgroundColor'] = 'rgba(60,141,188,0.9)';
            $data_month = [];
            foreach (range(1, 12) as $month) {
                $data_month[] = Peminjaman::select(DB::raw("COUNT(*) as total"))->whereMonth('tgl_pinjam', $month)->first()->total;
            }
            $data_bar[$key]['data'] = $data_month;
        }
        // Untuk Pie Diagram
        $data_pie = Buku::select(DB::raw("COUNT(id_katalog) as total"))->groupBy('id_katalog')->orderBy('id_katalog')->pluck('total');
        $label_pie = Katalog::orderBy('katalog.nama', 'asc')->join('buku', 'buku.id_katalog', '=', 'katalog.id')->groupBy('nama')->pluck('nama');

        return view('admin.dashboard', compact('total_buku', 'total_anggota', 'total_penerbit', 'total_peminjaman', 'data_donut', 'label_donut', 'data_bar', 'data_pie', 'label_pie'));
    }
    public function katalog()
    {
        $data_katalog = Katalog::all();
        return view('admin.katalog.katalog', compact('data_katalog'));
    }
    public function peminjaman()
    {
        $data_peminjaman = Peminjaman::all();
        $data['anggota'] = Anggota::all();
        $databuku = Buku::where('qty_stok', '>', 0)->get();
        return view('admin.peminjaman', compact('data_peminjaman', 'data', 'databuku'));
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
        $data['penerbit'] = Penerbit::all();
        $data['pengarang'] = Pengarang::all();
        $data['katalog'] = Katalog::all();
        // $data_buku = Buku::all();
        return view('admin.buku', compact('data'));
    }
}
