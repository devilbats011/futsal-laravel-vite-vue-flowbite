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
    return view('welcome', ['name' => 'Ali']);
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\Auth\AdminController::class, 'index'])->name('admin.home');

Route::controller(App\Http\Controllers\BookController::class)->group(function () {
    Route::prefix('book')->group(function () {
        Route::name('book.')->group(function () {
            Route::post('/', 'bookCourt')->name('add');

        });
    });
});
