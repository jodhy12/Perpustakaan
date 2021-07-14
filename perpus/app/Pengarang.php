<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    protected $table = 'pengarang';
    public function buku()
    {
        return $this->hasMany('App\Buku', 'id_pengarang');
    }
}
