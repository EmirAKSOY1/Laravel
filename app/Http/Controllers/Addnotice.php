<?php

namespace App\Http\Controllers;

use App\Models\NoticeModel;
use Illuminate\Http\Request;

class Addnotice extends Controller
{
    public function showNotice()
    {
        return view('admin.add_notice');
    }
    public function notice_add(Request $request){
        // Veritabanına veri ekleme
        $notice = new NoticeModel;
        $notice->title = $request->notice_title;
        $notice->content = $request->notice_content;
        $notice->save();

        return redirect()->back()->with('success', 'Data has been saved successfully!');
    }
}
