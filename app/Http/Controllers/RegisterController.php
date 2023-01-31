<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register() {
        return view('register');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'type' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'name' => ['required'],
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        auth()->login($user);

        alert()->success('Registered Successfully!');

        return redirect()->to('/home');
    }
}
