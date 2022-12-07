<?php

use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Http\Request;
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

Route::post('inquiry', function (Request $request) {
    $data = $request->validate([
        'message' => 'required',
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'subject' => 'required',
    ]);
    $i = Inquiry::create($data);
    $users = User::whereType(User::TYPE_ADMIN)->get();

    foreach ($users as $user) {
        $user->notify(
            NovaNotification::make()
                ->message('New Inquiry!')
                ->action('Check', '/resources/inquiries/' . $i->id)
                ->icon('message')
                ->type('warning')
        );
    }
    return back()->withSuccess("You're inquiry has been sent!");
})->name('inquiry');
