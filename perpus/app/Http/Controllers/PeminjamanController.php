<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Peminjaman;
use App\DetailPeminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->status) {
            $datas = Peminjaman::select('*', DB::raw("DATEDIFF( tgl_kembali ,tgl_pinjam ) as lama_pinjam"))->with('anggota')->where('status', $request->status)->get();
        } else {
            $datas = Peminjaman::select('*', DB::raw("DATEDIFF( tgl_kembali ,tgl_pinjam ) as lama_pinjam"))->with('anggota')->get();
        }
        foreach ($datas as $data) {
            $data->listbuku = DB::table('detail_peminjaman')
                ->select('detail_peminjaman.id', 'judul', 'buku.id as id_buku', 'harga_pinjam', 'qty', 'id_peminjaman')
                ->join('peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
                ->join('buku', 'buku.id', '=', 'detail_peminjaman.id_buku')
                ->where('detail_peminjaman.id_peminjaman', '=', $data->id)
                ->get();

            foreach ($data->listbuku as $buku) {
                $buku->dipinjam = DB::table('detail_peminjaman')
                    // ->select(DB::raw("SUM(qty*harga_pinjam)as subtotal"))
                    // ->join('peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
                    // ->join('buku', 'buku.id', '=', 'detail_peminjaman.id_buku')
                    ->where('id_buku', '=', $buku->id_buku)
                    ->where('detail_peminjaman.id_peminjaman', '=', $buku->id_peminjaman)
                    ->get();
            }
            // foreach ($data->listbuku as $subtotal) {
            //     $subtotal->subtotal = DB::table('detail_peminjaman')
            //         ->select(DB::raw("SUM(qty*harga_pinjam)as subtotal"))
            //         ->join('peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
            //         ->join('buku', 'buku.id', '=', 'detail_peminjaman.id_buku')
            //         ->where('id_buku', '=', $subtotal->id_buku)
            //         ->where('detail_peminjaman.id_peminjaman', '=', $subtotal->id_peminjaman)
            //         ->get();
            // }
        }
        foreach ($datas as $total) {
            $total->grandtotal = DB::table('detail_peminjaman')
                ->select(DB::raw("SUM(qty)as totalbuku"), DB::raw("SUM(qty*harga_pinjam)as totalharga"))
                ->join('peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
                ->join('buku', 'buku.id', '=', 'detail_peminjaman.id_buku')
                // ->where('id_buku', '=', $total->id_buku)
                ->where('detail_peminjaman.id_peminjaman', '=', $total->id)
                ->get();
        }




        $datatables = datatables()->of($datas)->addIndexColumn();
        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
}
