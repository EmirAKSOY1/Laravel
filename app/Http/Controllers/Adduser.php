<?php

namespace App\Http\Controllers;

use App\Models\UserRol;
use App\Models\User;
use Illuminate\Http\Request;

class Adduser extends Controller
{
    public function showAdd()
    {
        return view('admin.add_user');
    }
    public function add_user(Request $request){
        // Veritabanına veri ekleme
        $user = new User();
        $user->name = $request->input('user_name');
        $user->surname = $request->input('user_surname');
        $user->username = $request->input('username');
        $user->email = $request->input('user_mail');
        $user->tc = $request->input('user_tc');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $user_id = $user->id;

        $user_role = new UserRol();
        $user_role->user_id = $user_id;
        $user_role->role_id =$request->input('flexRadioDefault');
        $user_role->save();
        return redirect()->back()->with('success', 'Data has been saved successfully!');
    }
}
