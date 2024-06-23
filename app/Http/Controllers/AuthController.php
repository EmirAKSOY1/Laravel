<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Giriş bilgileri hatalı.']);
    }

    public function dashboard()
    {
        $user = Auth::user();
        if ($user->hasRole('aday')) {
            return view('dashboard.candidate');
        } elseif ($user->hasRole('test uygulayıcısı')) {
            return view('dashboard.tester');
        } elseif ($user->hasRole('sistem yöneticisi')) {
            return view('dashboard.admin');
        } else {
            abort(403);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
