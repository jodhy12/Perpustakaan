<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public function members()
    {
        return $this->hasMany(Member::class, 'member_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'transaction_details');
    }
}
