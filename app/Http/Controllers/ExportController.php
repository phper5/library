<?php

namespace App\Http\Controllers;

use App\Exports\Export;
use App\Exports\ExportBooks;
use App\Exports\ExportOrders;
use App\Exports\ExportUsers;
use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    /**
     * Export books
     * @param Request $request
     * format:  pdf or excel
     * download_fields: the cols needed
     * @return string|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportBooks(Request $request)
    {
        ini_set('memory_limit', '500m');
        set_time_limit(0);
        $columns = $request->input('download_fields');
        if (!$columns) {
            $columns = ExportBooks::COLUMN;
        }
        $format =$request->input('format', Export::TYPE_EXCEL) ;
        $query = Book::with('category');
        return (new Export($query, $columns, ExportBooks::getMappingData()))->to($format, 'books.xlsx');
    }

    /**
     * Exprot orders to excel or pdf
     * @param Request $request
     * @return string|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportOrders(Request $request)
    {
        ini_set('memory_limit', '500m');
        set_time_limit(0);
        $columns = $request->input('download_fields');
        if (!$columns) {
            $columns = ExportOrders::COLUMN;
        }
        $format =$request->input('format', Export::TYPE_EXCEL) ;
        $query = Order::with('book')->with('user');
        return (new Export($query, $columns, ExportOrders::getMappingData()))->to($format, 'orders.xlsx');
    }

    /**
     * Export users
     * @param Request $request
     * @return string|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportUsers(Request $request)
    {
        ini_set('memory_limit', '500m');
        set_time_limit(0);
        $columns = $request->input('download_fields');
        if (!$columns) {
            $columns = ExportUsers::COLUMN;
        }
        $format =$request->input('format', Export::TYPE_EXCEL) ;
        $query = User::query();
        return (new Export($query, $columns, ExportUsers::getMappingData()))->to($format, 'users.xlsx');
    }
}
