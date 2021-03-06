<?php

use App\Http\Controllers\API\BookBatchController;
use App\Http\Controllers\API\BookController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(BookBatchController::class)->group(function () {
    Route::post('books/batch', 'batchStore')->name('books.batch.store');
    Route::put('books/batch', 'batchUpdate')->name('books.batch.update');
    Route::delete('books/batch', 'batchDestroy')->name('books.batch.destroy');
});

Route::apiResource('books', BookController::class);
