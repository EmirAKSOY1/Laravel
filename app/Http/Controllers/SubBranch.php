<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\SubBranchModel;
use Illuminate\Http\Request;

class SubBranch extends Controller
{
    public function show($branch_id)
    {
        $branch = Branch::with('subBranches')->find($branch_id);
        if (!$branch) {
            return response()->json(['message' => 'Branch not found'], 404);
        }

        return view('admin.branches.sub_branch.subbranch', compact( 'branch'));
    }
    public function create($id){
        $branch = Branch::findOrFail($id);
        return view('admin.branches.sub_branch.add_subbranch', compact('branch'));
    }
    public function store(Request $request){
        $subbranch = new SubBranchModel();
        $subbranch->sub_branch_name = $request->sub_branch_name;
        $subbranch->branch_id = $request->branch_id;
        $subbranch->save();

        return redirect()->route('subbranch.show', $request->branch_id)
            ->with('success', 'Alan Düzey başarıyla silindi.');
    }
    public function destroy($id){
        $subBranch = SubBranchModel::findOrFail($id);
        $branch_id =$subBranch->branch_id;
        $subBranch->delete();

        return redirect()->route('subbranch.show',$branch_id)
            ->with('delete', 'Alt-Alan başarıyla silindi.');
    }
    public function edit($id)
    {
        $subBranch = SubBranchModel::findOrFail($id);
        return view('admin.branches.sub_branch.edit_subbranch', compact('subBranch'));
    }
    public function update(Request $request,$id){
        $subBranch = SubBranchModel::findOrFail($id);
        $subBranch->update([
            'sub_branch_name' => $request->input('sub_branch_name'),
        ]);
        return redirect()->route('subbranch.show',$subBranch->branch_id)
            ->with('update', 'Alt-Alan başarıyla silindi.');
    }
}
