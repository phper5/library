<?php

namespace App\Http\Controllers;

use App\Exports\ExportOrders;
use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController
{
    /**
     * Display a listing of the orders for current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $per_page = config('book.order_per_page');
        $status = $request->input('status', 0);
        $query = Order::with('book')->where('orders.user_id', $user->id);
        if ($status == 0) {
            $query = $query->whereNull('orders.returned_at');
        }
        if ($keyword = trim($request->input('keyword'))) {
            $query = $query->leftJoin('books', 'orders.book_id', 'books.id')->where('books.title', 'like', '%'.$keyword.'%');
        }
        $orders = $query->orderBy('orders.id', 'desc')->paginate($per_page);
        return view('orders.index', compact('orders', 'status', 'keyword'));
    }

    /**
     * Display a listing of the orders
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allOrders(Request $request)
    {
        $per_page = config('book.order_per_page');
        $status = $request->input('status', 0);
        $user = null;
        $query = Order::with('book')->with('user');
        if ($user_id = $request->input('user_id')) {
            $user = User::find($user_id);
            $query = $query->where('orders.user_id', $user_id);
        }
        if ($status == 0) {
            $query = $query->whereNull('orders.returned_at');
        }
        if ($keyword = trim($request->input('keyword'))) {
            $query = $query->leftJoin('books', 'orders.book_id', 'books.id')->where('books.title', 'like', '%'.$keyword.'%');
        }
        $orders = $query->orderBy('orders.id', 'desc')->paginate($per_page);
        $columns = ExportOrders::COLUMN;
        return view('orders.all', compact('orders', 'status', 'keyword', 'columns', 'user'));
    }

    /**
     * Borrow a book
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function order(Request $request, $book_id)
    {
        $user = Auth::user();
        if (Book::where('id', $book_id)
                ->where('in_library', Book::STATUS_IN_LIB)
                ->update(['in_library' => Book::STATUS_NOT_IN_LIB])) {
            $order = new Order();
            $order->book_id = $book_id;
            $order->user_id = $user->id;
            $order->borrowed_at = date("Y-m-d H:i:s");
            $order->save();
            return redirect(url()->previous())->with('success', __('order.borrow_success'));
        } else {
            return redirect(url()->previous())->with('error', __('order.checked_out'));
        }
    }

    /**
     * Return a book to library
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function return(Request $request, $id)
    {
        $user = Auth::user();
        if (Order::where('id', $id)
            ->where('user_id', $user->id)
            ->whereNull('returned_at')
            ->update(['returned_at' => date("Y-m-d H:i:s")])) {
            $order = Order::find($id);
            Book::where('id', $order->book_id)->update(['in_library' => Book::STATUS_IN_LIB]);
            return redirect(url()->previous())->with('success', __('order.return_success'));
        }
        return redirect(url()->previous())->with('success', __('order.not_borrowed'));
    }
}
