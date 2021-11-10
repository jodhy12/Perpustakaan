<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    protected $table = 'detail_peminjaman';

    protected $fillable = [
        'id_peminjaman',
        'id_buku',
        'qty'
    ];

    public function peminjaman()
    {
        return $this->belongsTo('App\Peminjaman', 'id_peminjaman');
    }
}
