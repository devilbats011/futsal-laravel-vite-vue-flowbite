<?php

use Carbon\Carbon;
use App\Models\Book;
use App\Jobs\SendEmail;
use App\Mail\BookNumber;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
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
Route::prefix('test')->group(function (){
    Route::get('/a', function ()
    {
        dump(route('real.home'),URL('futsal-logo.jpg'),auth()->check());
        // dump(mt_rand(1000, 9999)."-".strtoupper(Str::random(4)));

    })->name('test.a');

    Route::get('/b',function () {
        dump(route("payment.success", [GenerateSomeSaltyRandomCode(), 'session_id' => '{CHECKOUT_SESSION_ID}'],true));
        dump(route("payment.success", [GenerateSomeSaltyRandomCode()]).'?session_id={CHECKOUT_SESSION_ID}');
        dump(route("payment.success", [],true).'?session_id={CHECKOUT_SESSION_ID}');
        dump(route("payment.success",[generateSomeSaltyRandomCode(),'id'=> 1]));
        dd(route("payment.success",['id'=> 1,GenerateSomeSaltyRandomCode()]));
    });
    Route::get('/c',function () {
        $book = Book::find(1);
        return redirect()->route('payment.success', [$book,$book->book_number]);
        // echo route('payment.success', [$book,$book->book_number]);
    });
    Route::get('/d',function () {
        $book = Book::find(1);
        $sec = 10;
        $emailJob = (new SendEmail($book))->delay(Carbon::now()->addSeconds($sec));
        dispatch($emailJob);
        // return new BookNumber($book);
        return "sending...in {$sec} sec..1";
    });

});

Route::get('/', function () {
    // return view('welcome', ['name' => 'Ali']);
    return view('welcome');
})->name('real.home');

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
            Route::post('/stripe', 'stripePost')->name('stripe.post');
            Route::get('/payment/{book}','paymentBookOption')->name('payment');
            Route::post('/payment-decision/{book}','paymentDecision')->name('payment.decision');
        });
    });
});

Route::prefix('payment')->group(function() {
    Route::get('/success/{book}/{data?}',[App\Http\Controllers\BookController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/cancel/{data?}',[App\Http\Controllers\BookController::class, 'paymentSuccess'])->name('payment.cancel');
    Route::get('/stripe',[App\Http\Controllers\BookController::class, 'stripe'])->name('payment.stripe');
});

Route::post('/create-checkout-session',[App\Http\Controllers\BookController::class, 'stripe_v3'])->name('payment.stripe.v3');

// Route::get('/test',[App\Http\Controllers\BookController::class, 'paymentSuccess'])->name('test.test');
// Route::get('/test-stripe',[App\Http\Controllers\BookController::class, 'stripe'])->name('test.stripe');
