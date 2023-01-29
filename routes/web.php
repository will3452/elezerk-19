<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RegisterController;
use App\Models\LocationHistory;
use App\Models\Transaction;

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



Route::get('/cars/{car}', [CarController::class, 'viewCar']);


Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'register']);
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware(['auth'])->group(function() {

    Route::get('/home', function () {
        return view('dashboard');
    });

    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/book/{car}', [BookingController::class, 'book']);
    Route::get('/book-cancel/{booking}', [BookingController::class, 'bookCancel']);
    Route::get('/book-pay/{booking}', [BookingController::class, 'bookPay']);
    Route::post('/book', [BookingController::class, 'store']);
    Route::get('/bookings', [BookingController::class, 'index']);

    Route::get('/send-verification', function () {
        Mail::to(auth()->user()->email)->send(new EmailVerification(auth()->user()->email));
        alert()->success('Verification link has been sent to your email!');
        return back();
    });

    Route::post('/change-password', function (Request $request) {
        $data = $request->validate([
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
        $data['password'] = bcrypt($data['password']);

        auth()->user()->update($data);

        alert()->success("Your password has been changed!");
        return back();
    });

    Route::post('/cash-in', function (Request $request) {

        $request->validate([
            'amount' => ['numeric', 'min:10'],
        ]);
        $newBalance = auth()->user()->balance + $request->amount;
        auth()->user()->update(['balance' => $newBalance]);

        Transaction::create(['user_id' => auth()->id(), 'amount' => $request->amount, 'description' => 'Cash in']);

        alert()->success('Success!');

        return back();
    });

    Route::get('/share-location', function (Request $request) {
        LocationHistory::create([
            'user_id' => auth()->id(),
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);

        alert()->success('Your Location has been shared!');

        return back();
    });
});




Route::get('/verify-email', function (Request $request) {
    $user = User::whereEmail($request->email)->first();
    $user->update(['email_verified_at' => now()]);

    auth()->login($user);
    alert()->success('Your email has been verified.');
    return redirect('/home');
})->name('verify-email');
