<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('Auth')->group(function () {
    Route::get('/login',[App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
    Route::post('/logout',[App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    Route::post('/login',[App\Http\Controllers\Auth\LoginController::class, 'logon'])->name('login');
    Route::get('/register',[App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register');
    Route::post('/register',[App\Http\Controllers\Auth\RegisterController::class, 'store']);
});

Route::group( ['middleware' => 'auth' ], function() {
    Route::resource('/albums', App\Http\Controllers\AlbumController::class);
    Route::get('/artists', [App\Http\Controllers\ArtistController::class,'index'])->name('artists');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');