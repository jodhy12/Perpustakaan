<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with('members')->get();
        return view('admin.transaction.index', compact('transactions'));
    }

    public function api(Request $request)
    {

        // // filter only one
        // if ($request->status) {
        //     $transactions = Transaction::with('books', 'members')->where('status', '=', $request->status - 1)->get();
        // } else if ($request->date) {
        //     $transactions = Transaction::with('books', 'members')->whereDate('date_start', '=', $request->date)->get();
        // } else {
        //     $transactions = Transaction::with('books', 'members')->get();
        // }

        // filter in the same time
        if ($request->status && $request->date) {
            $transactions = Transaction::with('books', 'members')->where('status', '=', $request->status - 1)->whereDate('date_start', '=', $request->date)->get();
        } else if ($request->status) {
            $transactions = Transaction::with('books', 'members')->where('status', '=', $request->status - 1)->get();
        } else if ($request->date) {
            $transactions = Transaction::with('books', 'members')->whereDate('date_start', '=', $request->date)->get();
        } else {
            $transactions = Transaction::with('books', 'members')->get();
        }

        $total = [];

        foreach ($transactions as $keyTx => $transaction) {
            $start = Carbon::parse($transaction->date_start);
            $end = Carbon::parse($transaction->date_end);
            $transaction->loanPeriod = $start->diffInDays($end);
            $transaction->totalBook = count($transaction->books);
            $transaction->dateStartFormat = dateFormatDays($transaction->date_start);
            $transaction->dateEndFormat = dateFormatDays($transaction->date_end);

            foreach ($transaction->books as $keyBook => $book) {
                $total[$keyBook] = $book->price * $book->pivot->qty;
            }
            $transaction->totalPayment = array_sum($total);
            $total = [];

            $transaction->urlButton = '<a href="' . route('transactions.show', $transaction->id) . '" class="btn btn-info btn-sm">Details</a>
            <form action="' . route('transactions.destroy', $transaction->id) . '" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" value="Delete" class="btn btn-danger btn-sm" onclick="return confirm(`are you sure ?`)">
            ' . csrf_field() . '
            </form>';
        }

        $datatables = datatables()->of($transactions)->addIndexColumn();

        return $datatables->rawColumns(['urlButton'])->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::all();
        $books = Book::where('qty', '!=', '0')->get();
        return view('admin.transaction.create', compact('members', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'member_id' => ['required'],
            'date_start' => ['required', 'before:date_end'],
            'date_end' => ['required'],
            'books' => ['required', 'array', 'min: 1'],
            'status' => ['required', 'boolean']

        ]);

        $data = $request->all();
        $data['status'] = intval($data['status']);

        $transaction = Transaction::create($data);
        $transaction->books()->attach($request->books, ['qty' => 1]);

        foreach ($request->books as $bookArray) {
            $books = Book::findOrFail($bookArray);
            $books->qty = $books->qty - 1;
            $books->update();
        }

        return redirect('transactions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $transaction = Transaction::with('books', 'members')->findOrFail($transaction->id);
        return view('admin.transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        // Redirect ketika status sudah dikembalikan
        if ($transaction->status) {
            return redirect('transactions/' . $transaction->id . '');
        }

        $members = Member::all();
        $books = Book::where('qty', '!=', '0')->get();
        $transaction = Transaction::with('books', 'members')->findOrFail($transaction->id);

        $bookId = [];
        foreach ($transaction->books as $key => $book) {
            $bookId[$key] = $book->id;
        }
        return view('admin.transaction.edit', compact('transaction', 'members', 'books', 'bookId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $this->validate($request, [
            'member_id' => ['required'],
            'date_start' => ['required', 'before:date_end'],
            'date_end' => ['required'],
            'books' => ['required', 'array', 'min: 1'],
            'status' => ['required', 'boolean']

        ]);
        $arrayOfBooks = [];

        $data = $request->all();
        $data['status'] = intval($data['status']);

        $transactions = Transaction::with('books')->findOrFail($transaction->id);

        // Get ID of Array in Books Transaction
        foreach ($transactions->books as $key => $bookArray) {
            $arrayOfBooks[$key] = $bookArray->id;
        }


        // When Request Status 0 / Belum dikembalikan
        if (!$request->status) {
            // Update Data to DB
            $transaction->books()->detach($arrayOfBooks);
            $transaction->books()->attach($request->books, ['qty' => 1]);
            $transaction->update($data);

            // Update Transaksi buku yang akan diEdit
            // Transaksi Buku Awal
            foreach ($arrayOfBooks as $bookArray) {
                $book = Book::findOrFail($bookArray);
                $book->qty = $book->qty + 1;
                $book->update();
            }

            // Transaksi Buku Setelah di Edit
            foreach ($data['books'] as $bookArray) {
                $book = Book::findOrFail($bookArray);
                $book->qty = $book->qty - 1;
                $book->update();
            }
            return redirect('transactions');
        }

        // When Status 1 / Sudah dikembalikan

        // When Update but old data not same with new update data will be error
        if (!($arrayOfBooks == $request->books)) {
            return redirect()->back();
        }

        $transaction->update($data);

        foreach ($data['books'] as $bookArray) {
            $book = Book::findOrFail($bookArray);
            $book->qty = $book->qty + 1;
            $book->update();
        }
        return redirect('transactions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {

        // Only delete data  when status sudah dikembalikan
        if ($transaction->status) {

            // Delete Data Transaction
            $transaction->delete();

            return redirect()->back();
        }

        $arrayOfBooks = [];

        $transactions = Transaction::with('books')->findOrFail($transaction->id);

        // Get ID Array of Books
        foreach ($transactions->books as $key => $bookArray) {
            $arrayOfBooks[$key] = $bookArray->id;
        }

        // Delete Data in Table Transaction Details
        $transaction->books()->detach($arrayOfBooks);

        // Delete Data Transaction
        $transaction->delete();

        // Get update the quantity of book
        foreach ($arrayOfBooks as $bookArray) {
            $book = Book::findOrFail($bookArray);
            $book->qty = $book->qty + 1;
            $book->update();
        }

        return redirect()->back();
    }
}
