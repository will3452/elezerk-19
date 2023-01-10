<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
        ]);

        $data['password'] = bcrypt($data['password']);

        $data['type'] = User::TYPE_STUDENT;

        $user = User::create($data);

        alert()->success("Register Successfully!");

        Auth::login($user);

        return redirect()->to('/app/');
    }
}
