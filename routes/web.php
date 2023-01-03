<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourtController;

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


Route::get('/test', function ()
{
    dump(auth()->check());
    // dump(mt_rand(1000, 9999)."-".strtoupper(Str::random(4)));

});
Route::get('/', function () {
    return view('welcome', ['name' => 'Ali']);
});




Auth::routes();

Route::controller(App\Http\Controllers\AdminController::class)->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {
            Route::get('/', [App\Http\Controllers\Auth\AdminController::class, 'index'])->name('home');
            Route::get('/sandbox', [App\Http\Controllers\Auth\AdminController::class, 'sandbox'])->name('sandbox');
        });
    });
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('courts',[CourtController::class,'courts'])->name('courts.home');

Route::controller(App\Http\Controllers\BookController::class)->group(function () {
    Route::prefix('book')->group(function () {
        Route::name('book.')->group(function () {
            Route::get('/{court?}','book')->name('home');
            Route::post('/', 'bookCourt')->name('add');
            Route::put('/edit/{book}', 'updateBook')->name('edit');
            Route::delete('/delete/{book}', 'destroyBook')->name('delete');
            Route::post('/track', 'trackBook')->name('track');
            Route::get('stripe', 'stripe')->name('stripe.get');
            Route::post('stripe', 'stripePost')->name('stripe.post');

        });
    });
});
