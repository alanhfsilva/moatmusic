<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/artists', [ArtistController::class, 'index'])->name('api.artists');
Route::get('/artists/json', [ArtistController::class, 'indexJson'])->name('api.artists.json');
Route::get('/artists/{id}', [ArtistController::class, 'show'])->name('api.artists.get');