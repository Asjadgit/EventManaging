<?php

namespace Asjad\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('admin::auth.login');
    }

   public function login(Request $request)
{
    try {
        $email = $request->input('email');
        $pass = $request->input('pass');

        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($pass, $user->password)) {
            return back()->withErrors(['error' => 'Invalid email or password.']);
        }

        Auth::login($user);
        return redirect()->route('admin.dashboard');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => $e->getMessage()]);
    }
}

}
