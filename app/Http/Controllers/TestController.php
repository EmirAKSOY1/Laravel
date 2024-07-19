<?php

namespace App\Http\Controllers;

use App\Models\SubBranchModel;
use App\Models\Term;
use App\Models\Test;
use App\Models\TestSubBranch;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $tests = Test::with('term', 'subBranches')->get();
        return view('admin.tests.tests', compact('tests'));
    }
    public function create(){
        $terms = Term::all();
        $subbranchs=SubBranchModel::all();
        return view('admin.tests.add_test', compact('terms','subbranchs'));
    }
    public function store(Request $request){
        $test = new Test();
        $test->test_name = $request->test_name;
        $test->start_time = $request->test_time;
        $test->term_id = $request->term_id;
        $test->date = $request->test_date;
        $test->active = $request->active;
        $test->save();

        $test_sub = new TestSubBranch();
        $test_sub->test_id = $test->test_id;
        $test_sub->sub_branch_id = $request->test_sub_branch;
        $test_sub->save();
        return redirect()->route('tests.index')->with('add', 'Test Başarıyla Eklendi.');
    }
    public function destroy(Test $test){
        TestSubBranch::where('test_id', $test->test_id)->delete();

        // Delete the test record
        $test->delete();

        return redirect()->route('tests.index')->with('delete', 'Test deleted successfully.');
    }
    public function edit($id){
        $tests = Test::with('term', 'subBranches')->find($id);
        $terms = Term::all();
        $subbranchs=SubBranchModel::all();
        return view('admin.tests.edit_test', compact('tests','terms','subbranchs'));
    }
    public function update(Request $request,$id){

        $test = Test::findOrFail($id);
        $test->test_name = $request->test_name;
        $test->date = $request->test_date;
        $test->start_time = $request->test_time;
        $test->term_id = $request->term_id;
        $test->active = $request->active;
        $test->save();
        // Sub-branch güncellemesi
        $test->subBranches()->sync($request->test_sub_branch);
        return redirect()->route('tests.index')->with('update', 'Test Başarıyla Eklendi.');


    }

}
