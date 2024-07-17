<?php

namespace App\Http\Controllers;

use App\Models\ClassLevel;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::with('classLevel')->get();
        return view('admin.branches.branches', compact('branches'));
    }
    public function destroy($id){
        $branches = Branch::findOrFail($id);
        $branches->delete();

        return redirect()->route('branches.index')
            ->with('delete', 'Alan Düzey başarıyla silindi.');
    }
    public function create(){
        $class_levels = ClassLevel::all();
        return view('admin.branches.add_branches',compact('class_levels'));
    }
    public function store(Request $request){
        $branch = new Branch();
        $branch->branch_name = $request->branch_name;
        $branch->class_id = $request->class_level_id;
        $branch->save();

        return redirect()->route('branches.index')
            ->with('success', 'Alan Düzey başarıyla silindi.');
    }
    public function edit($id){
        $branch = Branch::findOrFail($id);
        $class_levels = ClassLevel::all();
        return view('admin.branches.edit_branches',compact('class_levels','branch'));
    }
    public function update(Request $request, $id)
    {


        $branch = Branch::findOrFail($id);
        $branch->update([
            'branch_name' => $request->input('branch_name'),
            'class_id' => $request->input('class_level_id'),

        ]);
        return redirect()->route('branches.index')->with('success', 'Branch updated successfully');
    }
}
