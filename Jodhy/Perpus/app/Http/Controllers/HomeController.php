<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Publisher;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $member = Member::with('user')->get();
        // $publisher = Publisher::with('books')->get();
        // $author = Author::with('books')->get();
        // $books = Book::with('publisher', 'author', 'catalog')->get();
        // $books = Book::find(2);
        $tx = Transaction::with('books')->get();

        return $tx;
        // return $book->transactions()->get();
        // return $member;
        // return $txdetail;
        // return $books;
        return view('home');
    }
}
