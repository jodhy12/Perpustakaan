<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    public function penerbit()
    {
        return $this->belongsTo('App\Penerbit', 'id_penerbit');
    }
    public function pengarang()
    {
        return $this->belongsTo('App\Pengarang', 'id_pengarang');
    }
    public function katalog()
    {
        return $this->belongsTo('App\Katalog', 'id_katalog');
    }
}
