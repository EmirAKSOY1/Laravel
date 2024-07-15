<?php

namespace App\Http\Controllers;

use App\Models\CognitiveModel;
use App\Models\DisabilityModel;
use Illuminate\Http\Request;

class Disability extends Controller
{
    public function index()
    {
        $disabilities = DisabilityModel::all();
        return view('admin.disability.disability', compact('disabilities'));
    }
    public function create(){
        return view('admin.disability.add_disability');
    }
    public function store(Request $request)
    {
        $disabilities = new DisabilityModel();
        $disabilities->name = $request->input('disability_name');
        $disabilities->save();
        return redirect()->route('disabilities.index')
            ->with('success', 'Bilişsel Düzey başarıyla Eklendi.');
    }
    public function destroy($id)
    {
        $disabilities = DisabilityModel::findOrFail($id);
        $disabilities->delete();

        return redirect()->route('disabilities.index')
            ->with('success', 'Bilişsel Düzey başarıyla silindi.');
    }
    public function edit($id){
        $disabilities = DisabilityModel::findOrFail($id);
        return view('admin.disability.edit_disability',compact('disabilities'));
    }
    public function update(Request $request , $id){
        // Validation
        $request->validate([
            'disability_name' => 'required|string|max:255',
        ]);

        // Update school in organisation table
        $disabilities = DisabilityModel::findOrFail($id);
        $disabilities->name = $request->disability_name;
        $disabilities->save();
        return redirect()->route('disabilities.index')
            ->with('success', 'Özel Gereksinim başarıyla Güncellendi.');
    }
}
