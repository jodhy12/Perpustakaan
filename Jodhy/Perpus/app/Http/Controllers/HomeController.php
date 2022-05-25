<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Catalog;
use App\Models\Member;
use App\Models\Publisher;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // $tx = Transaction::with('books')->get();

        // return $tx;
        // return $book->transactions()->get();
        // return $member;
        // return $txdetail;
        // return $books;

        // No 1
        $data = Member::select('*')
            ->join('users', 'users.member_id', '=', 'members.id')
            ->get();

        // No 2
        $data02 = Member::select('*')
            ->leftJoin('users', 'members.id', '=', 'users.member_id')
            ->where('users.id', NULL)
            ->get();

        // No 3
        $data03 = Member::leftJoin('transactions as t', 'members.id', '=', 't.member_id')
            ->where('t.id', NULL)
            ->get(['members.id', 'members.name']);

        // No 4
        $data04 = Member::join('transactions as t', 'members.id', '=', 't.member_id')
            ->orderBy('members.id', 'asc')
            ->get(['members.id', 'members.name', 'members.phone_number']);

        // No 5
        $data05 = Member::select('members.id', 'members.name', 'members.phone_number')
            ->join('transactions as t', 'members.id', '=', 't.member_id')
            ->groupBy('members.id')
            ->havingRaw('count(members.id) > 1')
            ->get();

        // No 6
        $data06 = Member::from('members as m')
            ->select('m.name', 'm.phone_number', 'm.address', 't.date_start', 't.date_end')
            ->join('transactions as t', 'm.id', '=', 't.member_id')
            ->get();

        // No 7
        $data07 = Member::from('members as m')
            ->select('m.name', 'm.phone_number', 'm.address', 't.date_start', 't.date_end')
            ->join('transactions as t', 'm.id', '=', 't.member_id')
            ->whereMonth('t.date_end', '=', '06')
            ->get();

        // No 8
        $data08 = Member::from('members as m')
            ->select('m.name', 'm.phone_number', 'm.address', 't.date_start', 't.date_end')
            ->join('transactions as t', 'm.id', '=', 't.member_id')
            ->where('t.date_start', 'like', '%2022-05%')
            ->get();

        // No 9
        $data09 = Member::from('members as m')
            ->select('m.name', 'm.phone_number', 'm.address', 't.date_start', 't.date_end')
            ->join('transactions as t', 'm.id', '=', 't.member_id')
            ->where('t.date_start', 'like', '%2022-05%')
            ->where('t.date_end', 'like', '%2022-06%')
            ->get();

        // No 10
        $searchName = 'vista';
        $data10 = Member::from('members as m')
            ->select('m.name', 'm.phone_number', 'm.address', 't.date_start', 't.date_end')
            ->join('transactions as t', 'm.id', '=', 't.member_id')
            ->whereRaw('m.address like ?', '%' . $searchName . '%')
            ->get();

        // No 11
        $data11 = Member::from('members as m')
            ->select('m.name', 'm.phone_number', 'm.address', 't.date_start', 't.date_end')
            ->join('transactions as t', 'm.id', '=', 't.member_id')
            ->whereRaw('m.address like ?', '%' . $searchName . '%')
            ->where('m.gender', '=', 'P')
            ->get();

        // No 12
        $data12 = Member::from('members as m')
            ->select('m.name', 'm.phone_number', 'm.address', 't.date_start', 't.date_end', 'b.isbn', 'td.qty')
            ->join('transactions as t', 'm.id', '=', 't.member_id')
            ->join('transaction_details as td', 't.id', '=', 'td.transaction_id')
            ->join('books as b', 'b.id', '=', 'td.book_id')
            ->where('td.qty', '>', 1)
            ->get();

        // No 13
        $data13 = Member::from('members as m')
            ->selectRaw('m.name, m.phone_number, m.address, t.date_start, t.date_end, b.isbn, b.title, td.qty, b.price, (td.qty * b.price) as price_total')
            ->join('transactions as t', 'm.id', '=', 't.member_id')
            ->join('transaction_details as td', 't.id', '=', 'td.transaction_id')
            ->join('books as b', 'b.id', '=', 'td.book_id')
            ->get();

        // // Another Way
        // $data13 = Member::from('members as m')
        //     ->select('m.name', 'm.phone_number', 'm.address', 't.date_start', 't.date_end', 'b.isbn', 'b.title', 'td.qty', 'b.price', DB::raw(('(td.qty * b.price) as total')))
        //     ->join('transactions as t', 'm.id', '=', 't.member_id')
        //     ->join('transaction_details as td', 't.id', '=', 'td.transaction_id')
        //     ->join('books as b', 'b.id', '=', 'td.book_id')
        //     ->get();

        // No 14
        $data14 = Member::from('members as m')
            ->select('m.name', 'm.phone_number', 'm.address', 't.date_start', 't.date_end', 'b.isbn', 'b.title', 'td.qty', 'p.name as publiher_name', 'a.name as author_name', 'c.name as catalog_name')
            ->join('transactions as t', 'm.id', '=', 't.member_id')
            ->join('transaction_details as td', 't.id', '=', 'td.transaction_id')
            ->join('books as b', 'td.book_id', '=', 'b.id')
            ->join('publishers as p', 'b.publisher_id', '=', 'p.id')
            ->join('authors as a', 'b.author_id', '=', 'a.id')
            ->join('catalogs as c', 'b.author_id', '=', 'c.id')
            ->get();

        // No 15
        $data15 = Catalog::from('catalogs as c')
            ->select('c.id', 'c.name', 'b.title')
            ->join('books as b', 'c.id', '=', 'b.catalog_id')
            ->get();

        // No 16
        $data16 = Book::from('books as b')
            ->select('b.*', 'p.name')
            ->rightJoin('publishers as p', 'b.publisher_id', '=', 'p.id')
            ->get();

        // No 17
        $data17 = Book::selectRaw('author_id, count(author_id) as total_author')
            ->groupBy('author_id')
            ->having('author_id', '=', '13')
            ->get();

        // No 18
        $data18 = Book::where('price', '>', 10000)
            ->get('*');

        // No 19
        $data19 = Book::where('publisher_id', '=', 18)
            ->where('qty', '>', 5)
            ->get('*');

        // No 20
        $data20 = Member::where('created_at', 'like', '%2022-05%')
            ->get('*');

        return $data20;
        return view('home');
    }
}
