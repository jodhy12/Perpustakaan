<?php

use App\Peminjaman;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

function get_selisih_hari()
{
    $now = date('Y-m-d');
    return Peminjaman::select('*', DB::raw("DATEDIFF( ' $now ' ,tgl_kembali ) as selisih"))
        ->with('anggota')
        ->where('tgl_kembali', '<', date('Y-m-d'))
        ->where('status', '=', 1)
        ->orderBy('tgl_kembali', 'desc')
        ->get();
}
function get_notifikasi()
{
    return Count(get_selisih_hari());
}

function rupiah($rp)
{
    return 'Rp. ' . number_format($rp, 0, '', '.');
    
}