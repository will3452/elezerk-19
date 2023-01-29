<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login () {
        return view('login');
    }

    public function store (Request $request) {
        $data = $request->validate([
            'email' => ['required', 'exists:users,email'],
            'password' => ['required'],
        ]);

        $user = User::whereEmail($data['email'])->first();

        if (Hash::check($data['password'], $user->password)) {
            auth()->login($user);
        }
        alert()->warning('Incorrect credentials!');
        return back();
    }

    public function logout (Request $request) {
        auth()->logout();
        return back();
    }
}
