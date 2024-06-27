<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class Editusercontroller extends Controller
{
    public function showEdit(){
        return view('admin.edit_user');
    }
    public function fetch(Request $request)
    {
        $tc = $request->input('tc');
        $user = User::where('tc', $tc)->first();

        if ($user) {
            return view('admin.edit_user', compact('user'));
        } else {
            return redirect()->back()->with('error', 'Kullanıcı bulunamadı.');
        }
    }
    public function update(Request $request){
        $id = $request->input('id');
        $user = User::where('id', $id)->first();

        if ($user) {
            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->tc = $request->input('tc');


            $user->save();

            return redirect()->back()->with('success_update', 'Kullanıcı Bilgisi güncellendi.');
        } else {
            return redirect()->back()->with('error','Kullanıcı bulunamadı');
        }
    }
}
