<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Member;
use App\Models\Publisher;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $total_member = Member::count();
        $total_book = Book::count();
        $total_transaction = Transaction::whereMonth('date_start', date('m'))->count();
        $total_publisher = Publisher::count();

        // DataDonut
        $data_donut = Book::selectRaw('count(publisher_id) as total')->groupBy('publisher_id')->orderBy('publisher_id')->pluck('total');
        $label_donut = Publisher::join('books as b', 'b.publisher_id', '=', 'publishers.id')->groupBy('publishers.id')->orderBy('publishers.id')->pluck('publishers.name');

        // Data Bar
        $labelBar = ['Peminjaman', 'Pengembalian'];
        $dataBar = [];

        foreach ($labelBar as $key => $value) {
            $dataBar[$key]['label'] = $labelBar[$key];
            $dataBar[$key]['backgroundColor'] = $key == 0 ? 'blue' : 'white';
            $dataMonth = [];

            foreach (range(1, 12) as $month) {
                if ($key == 0) {
                    $dataMonth[] = Transaction::selectRaw('count(*) as total')->whereMonth('date_start', $month)->first()->total;
                } else {
                    $dataMonth[] = Transaction::selectRaw('count(*) as total')->whereMonth('date_end', $month)->first()->total;
                }
            }

            $dataBar[$key]['data'] = $dataMonth;
        }

        // Data Pie
        $dataPie = Book::selectRaw('count(author_id) as total')->groupBy('author_id')->orderBy('author_id')->pluck('total');
        $labelPie = Author::join('books', 'books.author_id', '=', 'authors.id')->groupBy('authors.id')->orderBy('authors.id')->pluck('authors.name');

        return view('admin.dashboard', compact('total_member', 'total_book', 'total_transaction', 'total_publisher', 'data_donut', 'label_donut', 'dataBar', 'labelPie', 'dataPie'));
    }
}
