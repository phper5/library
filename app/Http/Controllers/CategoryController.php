<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Proengsoft\JsValidation\Facades\JsValidatorFacade;

class CategoryController extends Controller
{
    /**
     * Return the rules for add a new category
     * @param $id
     * @return \string[][]
     */
    public static function getUpdateRules($id)
    {
        return  [
            'name' => ['required','max:200','unique:categories,name,'.$id],
        ];
    }

    /**
     * Return the rules for update a category
     * @return \string[][]
     */
    public static function getCreateRules()
    {
        return [
            'name' => ['required','max:200','unique:categories'],
        ];
    }
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $per_page = config('book.category_per_page', 15);
        $categories = Category::orderBy('id', 'desc')->paginate($per_page);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validator = JsValidatorFacade::make(self::getCreateRules());
        return view('categories.create', compact('validator'));
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(self::getCreateRules());
        $category = new Category();
        $category->name = $request->input('name');
        $category->save();
        return redirect()->route('categories.index')
            ->with('success', __('category.add_success'));
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $validator = JsValidatorFacade::make(self::getUpdateRules($id));
        return view('categories.edit', compact('category', 'validator'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(self::getUpdateRules($id));
        $cate = Category::find($id);
        $cate->name = $request->input('name');
        $cate->save();
        return redirect()->route('categories.index')
            ->with('success', __('category.update_success'));
    }

    /**
     * Remove the specified category from storage, and update the books to uncategorized
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::where('category_id', $id)
            ->update(['category_id' => 0]);
        Category::where("id", $id)->delete();
        return redirect()->route('categories.index')
            ->with('success', __('category.delete_success'));
    }
}
