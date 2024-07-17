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
}
