<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Organisation;
use App\Http\Controllers\Adduser;
use App\Http\Controllers\Addnotice;
use App\Http\Controllers\Notices;
use App\Http\Controllers\User;
use App\Http\Controllers\Candidate;
use App\Http\Controllers\Editusercontroller;
use App\Http\Controllers\Disability;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\SubBranch;
use App\Http\Controllers\LearningOutcome;
use App\Http\Controllers\TestController;
Route::get('/',function(){
   return view('index');
});
Route::get('/about',function(){
    return view('about');
});
Route::get('/contact_page',function(){
    return view('contact');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/changepassword', [AuthController::class, 'changepasswordshow'])->name('changepasswordshow');
Route::post('/changepassword', [AuthController::class, 'changepassword'])->name('changepassword');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/notices', [Addnotice::class, 'showNotices'])->name('show_notices');
Route::get('/add_notice', [Addnotice::class, 'showNotice'])->name('notice');
Route::post('/add_notice', [Addnotice::class, 'notice_add']);

Route::resource('notices', Notices::class);

Route::resource('question', QuestionController::class);
Route::get('question/create/{id}', [QuestionController::class, 'create'])->name('question.create');
Route::get('/get-branches', [QuestionController::class, 'getBranches'])->name('get-branches');
Route::get('/get-sub-branches', [QuestionController::class, 'getSubBranches'])->name('get-sub-branches');
Route::get('/learning-outcomes', [QuestionController::class, 'getLearningOutcomes'])->name('learning-outcomes');
Route::get('question/detail/{id}', [QuestionController::class, 'detail'])->name('question.detail');

Route::resource('cognitive', \App\Http\Controllers\Cognitive::class);
Route::resource('contact',User::class);
Route::resource('candidate',Candidate::class);
Route::resource('organisation',Organisation::class);
Route::resource('add_user',Adduser::class);
Route::resource('disabilities', Disability::class);
Route::resource('branches', BranchController::class);
Route::resource('tests', TestController::class);
Route::get('tests/{test}/duplicate', [TestController::class, 'duplicate'])->name('tests.duplicate');
Route::post('tests/search', [TestController::class, 'searchBranch'])->name('tests.search');

Route::resource('terms', \App\Http\Controllers\TermController::class);

Route::resource('subbranch', SubBranch::class);
Route::get('subbranch/create/{id}', [SubBranch::class, 'create'])->name('subbranch.create');

Route::resource('learningoutcome', LearningOutcome::class);
Route::get('learningoutcome/create/{id}', [LearningOutcome::class, 'create'])->name('learningoutcome.create');




Route::get('/add_organisation', [Organisation::class, 'showOrganisation'])->name('organisation');
Route::post('/add_organisation', [Organisation::class, 'add']);

Route::get('/edituser', [Editusercontroller::class, 'showEdit'])->name('editUser');
Route::post('/edituser', [Editusercontroller::class, 'fetch'])->name('fetch_user');
Route::post('/updateuser', [Editusercontroller::class, 'update'])->name('update_user');
