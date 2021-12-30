<?php

namespace App\Http\Controllers;

use App\Exports\ExportBooks;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Proengsoft\JsValidation\Facades\JsValidatorFacade;

class BookController extends Controller
{
    /**
     * Return the rules for add a new book
     * @param $id
     * @return \string[][]
     */
    public static function getUpdateRules($id): array
    {
        return  [
            'title' => ['required','max:200'],
            'edition' => ['max:200'],
        ];
    }

    /**
     * Return the rules for update a book detail
     * @return \string[][]
     */
    public static function getCreateRules(): array
    {
        return [
            'title' => ['required','max:200'],
            'edition' => ['max:200'],
        ];
    }
    /**
     * Display a listing of the books.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = config('book.book_per_page', 15);
        $where = [];
        $query = Book::with('category');
        $category_id = $request->input('category_id', -1);
        if ($category_id === null) {
            $category_id = -1;
        }
        if ($category_id!=-1) {
            $where[] = ['category_id' ,'=',$category_id];
        }
        if ($keyword = trim($request->input('keyword'))) {
            $where[] = ['title','like','%'.$keyword.'%'];
        }
        if ($where) {
            $query = $query->where($where);
        }
        $books = $query->orderBy('id', 'desc')->paginate($per_page);
        $columns = ExportBooks::COLUMN;
        $categories = Category::orderBy('name', 'asc')->get();
        return view('books.index', compact('categories', 'books', 'keyword', 'category_id', 'columns'));
    }

    /**
     * Show the form for creating a new book.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $validator = JsValidatorFacade::make(self::getCreateRules());
        return view('books.create', compact('categories', 'validator'));
    }

    /**
     * Store a newly created book.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(self::getCreateRules());
        $book = new Book();
        $book->title = $request->input('title');
        $book->edition = $request->input('edition', '');
        $book->category_id = $request->input('category_id', 0);
        $book->save();
        return redirect()->route('books.index')
            ->with('success', __('book.add_success'));
    }

    /**
     * Display the specified book.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $categories = Category::orderBy('name', 'asc')->get();
        $validator = JsValidatorFacade::make(self::getUpdateRules($id));
        return view('books.edit', compact('book', 'categories', 'validator'));
    }

    /**
     * Update the specified book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(self::getUpdateRules($id));
        $book = Book::find($id);
        $book->title = $request->input('title');
        $book->edition = $request->input('edition', '');
        $book->category_id = $request->input('category_id', 0);
        $book->save();
        return redirect()->route('books.index')
            ->with('success', __('book.update_success'));
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::where("id", $id)->delete();
        return redirect()->route('books.index')
            ->with('success', __('book.delete_success'));
    }
}
