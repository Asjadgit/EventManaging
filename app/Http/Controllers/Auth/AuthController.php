<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $pass = $request->input('password');

        // Find user by email
        $user = User::where('email', $email)->first();

        // Check if user exists and password matches
        if ($user && Hash::check($pass, $user->password)) {
            Auth::login($user);
            return 'logged in';
        }

        return 'invalid credentials';
    }
}
