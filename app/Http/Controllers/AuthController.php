<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NoticeModel;
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
        $notices=NoticeModel::all();
        $user = Auth::user();
        if ($user->hasRole('aday')) {
            return view('dashboard.candidate',compact('notices'));
        } elseif ($user->hasRole('test uygulayıcısı')) {
            return view('dashboard.tester',compact('notices'));
        } elseif ($user->hasRole('sistem yöneticisi',compact('notices'))) {
            return view('dashboard.admin',compact('notices'));
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
