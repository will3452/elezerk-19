<?php

use App\Models\Coordinator;
use App\Models\SchoolYear;
use App\Models\Trainee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
    return redirect()->to('/app');
    return view('welcome');
});


Route::get('/app/login', function() {
    return view('login');
});


Route::post('/login', function (Request $request) {

    if (! $request->id) {
        alert()->warning('ID is required');
    }

    if (! $request->password) {
        alert()->warning('Password is required');
    }

    $user = Coordinator::whereEmployeeNo($request->id)->first();

    if (! $user) {
        $user = Trainee::whereStudentNo($request->id)->first();
    }

    if ($user) {
        $user = $user->user;
    }



    if (strpos($request->id, '@')) {
        $user = User::whereEmail($request->id)->first();
    }


    if (! $user) {
        alert()->warning('Record Not found!');

        return back();
    }

    if ($user->type == User::TYPE_TRAINEE) {
        $sy = $user->trainee->school_year;
        $sy = explode(' - ', $sy);

        $dSy = SchoolYear::default();

        if ($dSy->from != $sy[0] || $dSy->to != $sy[1]) {
            alert("You're not allowed to login.");
            return back();
        }

    }

    if (Hash::check($request->password, $user->password)) {
        auth()->login($user);

        return redirect()->to('/app/dashboards/main');
    }

    alert()->warning('Invalid Credentials.');
    return back();
});
