<?php

use App\Mail\BidReminder;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Notifications\NovaNotification;

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

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required'],
        'name' => ['required'],
    ]);

    $data['password'] = bcrypt('password');
    $data['type'] = User::TYPE_BASIC;

    User::create($data);

    return 'Registered successfully, <a href="/app/login">Login here</a>';
});

Route::get('/cron', function (Request $request) {
    // check for bids

    $bids = [];

    $_bids = Bid::get();
    foreach ($_bids as $item) {
        $dif = $item->scheduled_date->diffInDays(now());

        if ($dif == 7 || $dif == 1) {
            $userIds = $item->participants->pluck('user_id')->all();
            $users = User::whereIn('id', $userIds)->get();
            foreach ($users as $user) {
                $user->notify(
                        NovaNotification::make()
                        ->message("Note you are participating in a bid and will take place on the date $item->scheduled_date.")
                        ->icon('calendar')

                );
                Mail::to($user)->send(new BidReminder($item));
            }
        }
    }

    return 200;
});
