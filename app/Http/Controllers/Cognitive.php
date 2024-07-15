<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CognitiveModel;
class Cognitive extends Controller
{
    public function index(){
        $cognitives=CognitiveModel::all();
        return view('admin.cognitive.cognitive',compact('cognitives'));
    }
    public function create(){
        return view('admin.cognitive.add_cognitive');
    }
    public function destroy($id)
    {
        $cognitive = CognitiveModel::findOrFail($id);
        $cognitive->delete();

        return redirect()->route('cognitive.index')
            ->with('success', 'Bilişsel Düzey başarıyla silindi.');
    }
    public function store(Request $request)
    {
        $cognitive = new CognitiveModel();
        $cognitive->taksonomi_name = $request->input('taksonomi_name');
        $cognitive->cognitive_name = $request->input('level_name');
        $cognitive->save();
        return redirect()->route('cognitive.index')
            ->with('success', 'Bilişsel Düzey başarıyla Eklendi.');
    }
    public function edit($id){
        $cognitive = CognitiveModel::findOrFail($id);
        return view('admin.cognitive.edit_cognitive',compact('cognitive'));
    }
    public function update(Request $request , $id){
        // Validation
        $request->validate([
            'taksonomi_name' => 'required|string|max:255',
            'level_name' => 'required|string|max:255',
        ]);

        // Update school in organisation table
        $cognitive = CognitiveModel::findOrFail($id);
        $cognitive->taksonomi_name = $request->taksonomi_name;
        $cognitive->cognitive_name = $request->level_name;
        $cognitive->save();
        return redirect()->route('cognitive.index')
            ->with('success', 'Bilişsel Düzey başarıyla Güncellendi.');
    }
}
