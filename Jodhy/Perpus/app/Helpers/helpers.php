<?php

// namespace App\Helpers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;


function dateFormat($value)
{
    return date('H:i:s - d M Y', strtotime($value));
}

function dateFormatDays($value)
{
    return date('d M Y', strtotime($value));
}

function dataNotif()
{
    $transactions = Transaction::select('*', DB::raw("DATEDIFF(date_format(now(), '%Y-%m-%d'), date_end) as different"))
        ->with('members')
        ->whereRaw("date_format(now(), '%Y-%m-%d') >= date_end")
        ->where('status', '=', 0)
        ->orderBy('date_end', 'desc')
        ->get();

    return $transactions;
}

function countDataLateReturn()
{
    return count(dataNotif());
}

function lessBookQty($val)
{
    $book = Book::findOrFail($val);
    $book->qty = $book->qty - 1;
    $book->update();
}

function addBookQty($val)
{
    $book = Book::findOrFail($val);
    $book->qty = $book->qty + 1;
    $book->update();
}
