<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Organisation;
use App\Http\Controllers\Adduser;


Route::get('/',function(){
   return view('index');
});
Route::get('/about',function(){
    return view('about');
});
Route::get('/contact',function(){
    return view('contact');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/add_organisation', [Organisation::class, 'showOrganisation'])->name('organisation');
Route::post('/add_organisation', [Organisation::class, 'add']);

Route::get('/add_user', [Adduser::class, 'showAdd'])->name('add_user');
Route::post('/add_user', [Adduser::class, 'add_user']);
