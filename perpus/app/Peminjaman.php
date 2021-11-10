<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $fillable = [
        'id_anggota',
        'tgl_pinjam',
        'tgl_kembali',
        'status'
    ];


    public function buku()
    {
        return $this->belongsToMany('App\Buku', 'detail_peminjaman', 'id_peminjaman', 'id_buku');
    }
    public function anggota()
    {
        return $this->belongsTo('App\Anggota', 'id_anggota');
    }
    public function detail()
    {
        return $this->hasOne('App\DetailPeminjaman','id_peminjaman');
    }
}
