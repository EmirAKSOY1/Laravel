<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('auth.personal_contact',compact('user'));
    }
}
