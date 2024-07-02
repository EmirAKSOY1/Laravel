<?php

namespace App\Http\Controllers;

use App\Models\NoticeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Notices extends Controller
{
    public function index()
    {
        $notices=NoticeModel::all();
        return view('admin.notices',compact('notices'));
    }
    public function create(){
        return view('admin.add_notice');
    }
    public function destroy($id)
    {
        $notice = NoticeModel::findOrFail($id);
        $notice->delete();

        return redirect()->route('notices.index')
            ->with('success', 'Duyuru başarıyla silindi.');
    }
    public function edit($id)
    {
        $notices = NoticeModel::findOrFail($id);
        return view('admin.edit_notice', compact('notices'));
    }
    public function update(Request $request, $id){

        $request->validate([
            'notice_title' => 'required|string|max:255',
            'notice_content' => 'required|string',
            'notice_start_date' => 'required|date',
            'notice_end_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB maks boyut
        ]);
        $notice = NoticeModel::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($notice->image_path) {

                Storage::disk('public')->delete($notice->image_path);
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $notice->image_path = $imageName;
        }

        $notice->title = $request->notice_title;
        $notice->content = $request->notice_content;
        $notice->start_date = $request->notice_start_date;
        $notice->end_date = $request->notice_end_date;

        $notice->save();

        return redirect()->route('notices.index')
            ->with('success', 'Duyuru başarıyla güncellendi.');

    }

}
