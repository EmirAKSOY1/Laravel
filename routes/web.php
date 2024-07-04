<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Organisation;
use App\Http\Controllers\Adduser;
use App\Http\Controllers\Editusercontroller;
use App\Http\Controllers\Addnotice;
use App\Http\Controllers\Notices;
use App\Http\Controllers\User;
use App\Http\Controllers\Candidate;



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


Route::get('/add_user', [Adduser::class, 'showAdd'])->name('add_user');
Route::post('/add_user', [Adduser::class, 'add_user']);

Route::get('/edituser', [Editusercontroller::class, 'showEdit'])->name('editUser');
Route::post('/edituser', [Editusercontroller::class, 'fetch'])->name('fetch_user');
Route::post('/updateuser', [Editusercontroller::class, 'update'])->name('update_user');

Route::get('/notices', [Addnotice::class, 'showNotices'])->name('show_notices');
Route::get('/add_notice', [Addnotice::class, 'showNotice'])->name('notice');
Route::post('/add_notice', [Addnotice::class, 'notice_add']);


Route::resource('notices', Notices::class);

Route::resource('contact',User::class);
Route::resource('candidate',Candidate::class);

Route::get('/add_organisation', [Organisation::class, 'showOrganisation'])->name('organisation');
Route::post('/add_organisation', [Organisation::class, 'add']);
Route::resource('organisation',Organisation::class);
