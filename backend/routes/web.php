<?php

use App\Models\User;
use App\Models\Citizen;
use App\Models\Feedback;
use Illuminate\Http\Request;
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
    return view('welcome');
});


Route::post('/feedback', function (Request $request) {
    $data = $request->validate([
        'name' => 'required',
        'email' => ['required', 'email'],
        'body' => ['required'],
    ]);

    Feedback::create($data);

    return 'Your feedback has been sent to the administrator.';
});


Route::view('register', 'register');

Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'first_name' => ['required'],
        'last_name' => ['required'],
        'middle_name' => ['required'],
        'gender' => ['required'],
        'dob' => ['required'],
        'mobile' => ['required'],
        'email' => ['required', 'unique:users,email'],
        'valid_id' => ['required', 'image', 'max:5000'],
    ]);

    $storedFile = $request->valid_id->store('public');

    $arrFile = explode('/', $storedFile);

    $data['valid_id'] = $arrFile[count($arrFile) - 1];

    $citizen = Citizen::create([
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'middle_name' => $data['middle_name'],
        'gender' => $data['gender'],
        'mobile' => $data['mobile'],
        'dob' => $data['dob'],
        'valid_id' => $data['valid_id'],
    ]);

    User::create([
        'name' => "$citizen->first_name $citizen->middle_name $citizen->last_name",
        'email' => $data['email'],
        'password' => 'notverified',
        'type' => User::TYPE_CITIZEN,
    ]);

    return "You're data in being processed.";
});

Route::get('/print/{citizen}', function (Request $request, Citizen $citizen) {
    $document = $request->document;
    return view('templates.' . $document, compact('citizen'));
});
