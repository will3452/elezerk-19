<?php

use Carbon\Carbon;
use App\Models\Bid;
use App\Models\User;
use App\Models\Visit;
use App\Mail\BidReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Notifications\NovaNotification;

Route::get('/', function () {
    $alreadyVisited = Visit::whereIp(request()->ip())->whereDate('created_at', Carbon::today())->exists();

    if (! $alreadyVisited) {
        Visit::create(['ip' => request()->ip()]);
    }


    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});


Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'min:8', 'confirmed'],
        'name' => ['required'],
    ]);

    $data['password'] = bcrypt('password');
    $data['type'] = User::TYPE_BASIC;

    User::create($data);

    return view('register_success');
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

Route::get('verify/{file}', function (Request $request, $file) {
    if (! auth()->check()) {
        return "error 403";
    }
    return view('verify', compact('file'));
});

Route::get('/verify-validate/{file}', function (Request $request, $file) {
    if (Hash::check($request->password, auth()->user()->password)) {
        return redirect('/storage/' . $file);
    }

    return "Error 403, Unauthorized!";
});
Route::view('about', 'about');

Route::view('calendar', 'calendar');
