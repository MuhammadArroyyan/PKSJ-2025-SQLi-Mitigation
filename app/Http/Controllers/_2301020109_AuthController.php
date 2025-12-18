<?php

namespace App\Http\Controllers;

use App\Models\_2301020109_User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class _2301020109_AuthController extends _2301020074_Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Redirect based on role
            return redirect()->intended(route($user->role . '.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak sesuai',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
