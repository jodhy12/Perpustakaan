<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = "anggota";
    public function user()
    {
        return $this->hasOne('App\user', 'id_anggota');
    }
    public function peminjaman()
    {
        return $this->hasMany('App\peminjaman', 'id_anggota');
    }
}
