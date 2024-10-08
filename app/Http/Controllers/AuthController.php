<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NoticeModel;
use App\Models\User;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function changepasswordshow()
    {
        return view('auth.changepassword');
    }
    public function changepassword(Request $request){
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Kullanıcının mevcut şifresini doğrula
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mevcut şifre yanlış.']);
        }

        // Yeni şifreyi güncelle
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('changepasswordshow')->with('success', 'Şifreniz başarıyla güncellendi.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');


        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            if ($user->is_active == 0) {
                return redirect()->back()->withErrors(['email' => 'Kaydınız pasif hale getirilmiştir.']);
            }

            if (Auth::attempt($credentials)) {
                return redirect()->intended('/dashboard');
            }
        }

        return redirect()->back()->withErrors(['email' => 'Giriş bilgileri hatalı.']);
    }

    public function dashboard()
    {
        $today = date('Y-m-d');
        $notices=NoticeModel::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->get();;
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
