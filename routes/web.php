<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Session;

Route::get('/', [\App\Http\Controllers\BookController::class,'index'])->name('home');
Route::get('lang/{locale}', function ($locale) {
    Session::put('locale',$locale);
    \Illuminate\Support\Facades\App::setLocale($locale);
    return redirect(url()->previous())->with('success', __('layout.switch_lang_success'));
})->name('lang');

Route::middleware(['admin'])->group(function () {
    Route::view('admin', 'admin')->name('admin');
    Route::resource('categories', CategoryController::class);
    Route::resource('books', BookController::class)->except([
        'index', 'show'
    ]);;
    Route::resource('users', UserController::class);
    Route::get('export/orders', [\App\Http\Controllers\ExportController::class,'exportOrders'])->name('export.orders');
    Route::get('export/users', [\App\Http\Controllers\ExportController::class,'exportUsers'])->name('export.users');
    Route::get('orders', [\App\Http\Controllers\OrderController::class,'allOrders'])->name('orders.all');
});
Route::middleware(['auth'])->group(function () {
    Route::view('member', 'member')->name('member');
    Route::resource('books', BookController::class)->only([
        'index', 'show'
    ]);
    Route::get('profile',[\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile',[\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('export/books', [\App\Http\Controllers\ExportController::class,'exportBooks'])->name('export.books');
    Route::post('order/{book_id}', [\App\Http\Controllers\OrderController::class,'order'])->name('orders.create');
    Route::post('return/{id}', [\App\Http\Controllers\OrderController::class,'return'])->name('orders.return');
    Route::get('borrowing', [\App\Http\Controllers\OrderController::class,'index'])->name('orders.index');
});

require __DIR__.'/auth.php';

