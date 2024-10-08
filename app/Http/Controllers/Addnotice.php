<?php

namespace App\Http\Controllers;

use App\Models\NoticeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Addnotice extends Controller
{
    public function showNotice()
    {
        return view('admin.add_notice');
    }
    public function index()
    {

        $notices=NoticeModel::all();
        return view('admin.notices',compact('notices'));
    }
    public function notice_add(Request $request){

        $request->validate([
            'notice_title' => 'required|string|max:255',
            'notice_content' => 'required|string',
            'notice_start_date' => 'required|date',
            'notice_end_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB maks boyut
        ]);
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
        // Veritabanına veri ekleme
        $notice = new NoticeModel;
        $notice->title = $request->notice_title;
        $notice->content = $request->notice_content;
        $notice->start_date = $request->notice_start_date;
        $notice->end_date = $request->notice_end_date;
        $notice->image_path = $imageName;
        $notice->save();

        return redirect()->back()->with('success', 'Data has been saved successfully!');
    }
}
