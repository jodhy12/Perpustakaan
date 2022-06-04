<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'date_start', 'date_end', 'status'];

    public function members()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'transaction_details')->withTimestamps()->withPivot('qty');
    }
}
