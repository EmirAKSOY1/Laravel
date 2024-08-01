<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\CandidateDisability;
use App\Models\ClassLevel;
use App\Models\CognitiveModel;
use App\Models\DisabilityModel;
use App\Models\LearningOutcomeModel;
use App\Models\QuestionDisability;
use App\Models\QuestionModel;
use App\Models\SubBranchModel;
use App\Models\Test;
use Exception;
use Illuminate\Http\Request;


class QuestionController extends Controller
{
    public function show($id){
        $test = Test::find($id);
        $questions = QuestionModel::with('get_out_comes', 'get_cognitive','get_test')
            ->where('test_id', $id)
            ->get();

        return view('admin.question.question', compact('test','questions'));
    }
    public function create($id)
    {
        $test_id=$id;
        $classes=ClassLevel::all();
        $branches=Branch::all();
        $cognitivies=CognitiveModel::all();
        $disabilities=DisabilityModel::all();
        return view('admin.question.add_question',compact('classes','branches','cognitivies','disabilities','test_id'));
    }
    public function edit($id){
        $questions = QuestionModel::with('get_out_comes', 'get_cognitive','get_test')
            ->where('question_id', $id)
            ->first();
        $questionDisabilities = QuestionDisability::where('question_ID', $id)->pluck('disability_ID')->toArray();
        $cognitivies=CognitiveModel::all();
        $classes=ClassLevel::all();
        $branches=Branch::all();
        $sub_branches=SubBranchModel::all();
        $learningOutcome=LearningOutcomeModel::all();
        $disabilities=DisabilityModel::all();
        return view('admin.question.edit_question', compact('questions','learningOutcome','sub_branches','branches','classes','cognitivies','questionDisabilities','disabilities'));

    }
    public function update(Request $request , $id){
        try {
            $question = QuestionModel::findOrFail($id);
            $question->common_text = $request->common_text;
            $question->root_text = $request->root_text;
            $question->option_a = $request->a_option;
            $question->option_b = $request->b_option;
            $question->option_c = $request->c_option;
            $question->option_d = $request->d_option;
            $question->option_e = $request->e_option;
            $question->option_true = $request->true_option;
            $question->parameter_a = $request->a_parameter;
            $question->parameter_b = $request->b_parameter;
            $question->parameter_c = $request->c_parameter;
            $question->parameter_d = $request->d_parameter;
            $question->learning_out_comes = $request->learning_outcome;
            $question->cognitive_id = $request->cognivite_id;
            $question->is_active = $request->active;
            $question->text_synthesize = $request->text_synthesize ? 1 : 0;
            $question->module = $request->module;
            $question->save();

            // Mevcut engelleri sil
            QuestionDisability::where('question_ID', $id)->delete();

            // Yeni engelleri ekle
            $disabilities = $request->input('disabilities', []);
            foreach ($disabilities as $option) {
                $questionDisability = new QuestionDisability();
                $questionDisability->disability_ID = $option;
                $questionDisability->question_ID = $question->question_id;
                $questionDisability->save();
            }


            return redirect()->route('question.show',$question->test_ID )
                ->with('success', 'Madde başarıyla güncellendi.');
        } catch (Exception $e) {
            // Hata mesajını yakala ve ekrana yazdır

            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    public function detail($id) {
        $question = QuestionModel::with('get_out_comes', 'get_cognitive','get_test')
            ->where('question_id', $id)
            ->first();
        $question_disabilities=QuestionDisability::where('question_ID', $id)->get();

        return view('admin.question.detail_question',compact('question','question_disabilities'));
    }
    public function destroy($id){
        try {
            $question = QuestionModel::findOrFail($id);
            $question->delete();

            // İlgili QuestionDisability kayıtlarını bul ve sil
            QuestionDisability::where('question_id', $id)->delete();

            return redirect()->back()->with('success', 'Başarıyla Silindi');
        }catch (Exception $e) {
            // Hata mesajını yakala ve ekrana yazdır
            error_log($e);
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    public function getBranches(Request $request)
    {
        $class_id = $request->class_id;
        $Branches = Branch::where('class_id', $class_id)->get();
        return response()->json($Branches);
    }
    public function getSubBranches(Request $request)
    {
        $branch_id = $request->branch_id;
        $subBranches = SubBranchModel::where('branch_id', $branch_id)->get();
        return response()->json($subBranches);
    }
    public function getLearningOutcomes(Request $request)
    {
        $sub_branch_id = $request->sub_branch_id;
        $learningOutcomes = LearningOutcomeModel::where('sub_branch_id', $sub_branch_id)->get();
        return response()->json($learningOutcomes);
    }
    public function store(Request $request){
        try {
            $test_id =$request->test_id;
            $question= new QuestionModel();
            $question->common_text = $request->common_text;
            $question->test_ID = $request->test_id;
            $question->root_text = $request->root_text;
            $question->option_a = $request->a_option;
            $question->option_b = $request->b_option;
            $question->option_c = $request->c_option;
            $question->option_d = $request->d_option;
            $question->option_true = $request->true_option;
            $question->parameter_a = $request->a_parameter;
            $question->parameter_b = $request->b_parameter;
            $question->parameter_c = $request->c_parameter;
            $question->parameter_d = $request->d_parameter;
            $question->learning_out_comes = $request->learning_outcome;
            $question->cognitive_id = $request->cognivite_id;
            $question->is_active = $request->active;
            $question->text_synthesize = $request->text_synthesize?1:0;
            $question->module = $request->module;
            $question->save();
            $disabilities = $request->input('disability', []);
            foreach ($disabilities as $option) {
                $questionDisability = new QuestionDisability();
                $questionDisability->disability_ID =$option;
                $questionDisability->question_ID =$question->question_id;
                $questionDisability->save();
            }
            return redirect()->route('question.show',$test_id)
                ->with('success', 'Madde başarıyla Eklendi.');
        }catch (Exception $e) {
            // Hata mesajını yakala ve ekrana yazdır
            error_log($e);
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }

        }
}
