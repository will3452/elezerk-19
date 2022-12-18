<?php

use App\Models\User;
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
