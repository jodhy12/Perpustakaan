<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Peminjaman;
use App\DetailPeminjaman;
use App\Buku;
use Illuminate\Http\Request;

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
                // $total->total_bayar = $total->grandTotal[0]['total_harga'];   
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
        $this->validate($request , [
            'id_anggota'=>'required',
            'tgl_pinjam'=>'required',
            'tgl_kembali'=>'required',
            // 'status'=>'required'
        
        ]);
        
        $datapinjam = Peminjaman::create($request->all());

        $bukus = $request->buku;
        $simpan_buku = [];

        foreach($bukus as $key => $value){
            $simpan_buku[] = [
                'id_peminjaman' => $datapinjam->id ,
                'id_buku' => $value,
                'qty'=> 1

            ];

            $stok_buku = Buku::find($value);
            $stok_update = $stok_buku->qty_stok - 1 ;
            $stok_buku->update(['qty_stok' => $stok_update]);


        }
        DetailPeminjaman::insert($simpan_buku);
        return back();
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
        $this->validate($request , [
            'id_anggota'=>'required',
            'tgl_pinjam'=>'required',
            'tgl_kembali'=>'required',
            // 'status'=>'required'
        
        ]);

        $peminjaman->id_anggota = $request->id_anggota;
        $peminjaman->tgl_pinjam = $request->tgl_pinjam;
        $peminjaman->tgl_kembali = $request->tgl_kembali;
        $peminjaman->status = $request->status;
        $peminjaman->save();


        DetailPeminjaman::where('id_peminjaman', $peminjaman->id)->delete();

        foreach ($request->buku as $value){
            $detail = new DetailPeminjaman;
            $detail->id_peminjaman = $peminjaman->id;
            $detail->id_buku = $peminjaman->$value;
            $detail->qty = 1;
            $detail->save();

        // status dikembalika
        if ($request->status == 1) {
            $stok_buku = Buku::find($value);
            $stok_update = $stok_buku->qty_stok + 1 ;
            $stok_buku->update(['qty_stok' => $stok_update]);
        }


     }

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
