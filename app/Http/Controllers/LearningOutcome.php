<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\SubBranchModel;
use App\Models\LearningOutcomeModel;
use Illuminate\Http\Request;

class LearningOutcome extends Controller
{
    public function show($sub_branch_id)
    {
        $sub_branch = SubBranchModel::with('learningOutcomes')->find($sub_branch_id);
        if (!$sub_branch) {
            return response()->json(['message' => 'Sub-Branch not found'], 404);
        }

    return view('admin.branches.learning_outcome.learning_outcome', compact('sub_branch'));
    }
    public function create($id){
        $sub_branch = SubBranchModel::findOrFail($id);
        return view('admin.branches.learning_outcome.add_learning_outcome', compact('sub_branch'));
    }
    public function store(Request $request){
        $learnOutcome = new LearningOutcomeModel();
        $learnOutcome->learning_outcomes_name = $request->outcome_name;
        $learnOutcome->sub_branch_id = $request->sub_branch_id;
        $learnOutcome->save();

        return redirect()->route('learningoutcome.show', $request->sub_branch_id)
            ->with('success', 'Alan Düzey başarıyla silindi.');
    }
    public function destroy($id){
        $learnOutcome = LearningOutcomeModel::findOrFail($id);
        $sub_branch_id =$learnOutcome->sub_branch_id;
        $learnOutcome->delete();

        return redirect()->route('learningoutcome.show',$sub_branch_id)
            ->with('delete', 'Alt-Alan başarıyla silindi.');
    }
    public function edit($id)
    {
        $learnOutcome = LearningOutcomeModel::findOrFail($id);
        return view('admin.branches.learning_outcome.edit_learning_outcome', compact('learnOutcome'));
    }
    public function update(Request $request,$id){
        $learnOutcome = LearningOutcomeModel::findOrFail($id);
        $learnOutcome->update([
            'learning_outcomes_name' => $request->input('learning_outcomes_name'),
        ]);
        return redirect()->route('learningoutcome.show',$learnOutcome->sub_branch_id)
            ->with('update', 'Alt-Alan başarıyla silindi.');
    }
}
