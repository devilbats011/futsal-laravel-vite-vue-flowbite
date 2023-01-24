<?php

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Court;
use App\Jobs\SendEmail;
use App\Mail\BookNumber;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
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

// ! this does not work because two model binding (laravel limitation)
Route::get('testing-route/{user}/{book}/a', function (Book $book,User $user)
{
    dump($book,$user);
    echo true;

})->name('test.a.route');

// ! this route DOES NOT WORK / error because model binding work only place it at the front, (laravel limitation)
Route::get('testingroute/b/{b}/{book}', function (Book $book)
{
    dump($book);
    echo true;

})->name('test.b.route');


// ! model binding working because place it at the front
Route::get('testingroute/{book}/{c}/c', function (Book $book)
{
    dump($book);
    echo true;

})->name('test.c.route');

Route::prefix('test')->group(function (){
    Route::get('/aa', function ()
    {

        // dump(route('test.a.route',['user'=>1,'book'=>1]));
        // dump(route('test.b.route',[1,'b'=>1]).'?-extra-string-2');

        dump(route('test.c.route',[1,'c'=>1]).'?-extra-string-3');
        dump(route('test.c.route',['book'=>1,'c'=>1]).'?-extra-string-3');
    });

    Route::get('/a', function ()
    {

        dd(Court::Create([]));
        dd(Auth::user());
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
        session()->flash('message','test messages');
        return view('sandbox');
        // $book = Book::find(1);
        // return redirect()->route('payment.success', [$book,$book->book_number]);
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
    return view('welcome', ['bgUrl' => URL('bg-futsal-1.jpeg'),'bgGridUrl' => URL('bg-grid.svg')]);
})->name('real.home');

Auth::routes();

Route::controller(App\Http\Controllers\AdminController::class)->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {
            Route::get('/', [App\Http\Controllers\Auth\AdminController::class, 'index'])->name('home');
            Route::get('/courts', [App\Http\Controllers\Auth\AdminController::class, 'adminCourts'])->name('courts');
            Route::get('/sandbox', [App\Http\Controllers\Auth\AdminController::class, 'sandbox'])->name('sandbox');
            // Route::get('/log', [App\Http\Controllers\Auth\AdminController::class, 'log'])->name('log');
        });
    });
});

Route::controller(App\Http\Controllers\UserController::class)->group(function () {
    Route::get('/home', 'index')->name('home');

});

// Route::get('courts',[CourtController::class,'courts'])->name('courts.home');
Route::resource('courts',CourtController::class);

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
    Route::get('/cancel/{book}/{data?}',[App\Http\Controllers\BookController::class, 'paymentCancel'])->name('payment.cancel');
    Route::get('/stripe/{book}',[App\Http\Controllers\BookController::class, 'stripe'])->name('payment.stripe');
});

Route::post('/create-checkout-session/{book}',[App\Http\Controllers\BookController::class, 'stripe_v3'])->name('payment.stripe.v3');

// Route::get('/test',[App\Http\Controllers\BookController::class, 'paymentSuccess'])->name('test.test');
// Route::get('/test-stripe',[App\Http\Controllers\BookController::class, 'stripe'])->name('test.stripe');
