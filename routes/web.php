<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/header',function(){
    return view('layouts/header');
});

Route::get('/result',function(){
    return view('generate-result');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/create-surat',function(){
    return view('create-surat');
});

Route::get('/menu',function(){
    return view('menu');
});

Route::get('/history',function(){
    return view('history');
});