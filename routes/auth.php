<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisterController::class, 'register'])
                ->middleware('guest');

Route::get('/login', [LoginController::class, 'showLoginForm'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [LoginController::class, 'login'])
                ->middleware('guest');

Route::any('/logout', [LoginController::class, 'logout'])
                ->middleware('auth')
                ->name('logout');
