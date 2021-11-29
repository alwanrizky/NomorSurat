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
use App\Http\Controllers\NomorSuratController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\TemplateSuratController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TipeSuratController;

Route::get('/', function () {
    return view('index');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/menu',function(){
    return view('menu');
});

Route::post('/generate', [NomorSuratController::class, 'generateSurat']);

// Nomor Surat
Route::get('/result-nomor-surat', [NomorSuratController::class, 'check'])->name('result-nomor-surat');
Route::post('/history-nomor-surat/{id}', [NomorSuratController::class, 'delete'])->name('delete');
Route::get('/create-nomor-surat',[NomorSuratController::class, 'index'])->name('create-nomor-surat');
Route::get('/history-nomor-surat', [NomorSuratController::class, 'getHistory']);
Route::get('/history-nomor-surat/s/', [NomorSuratController::class, 'findHistory']);

// Tipe Surat
Route::get('/create-tipe-surat',function(){
    return view("create-tipe-surat");
});
Route::post('create-tipe-surat', [TipeSuratController::class, 'store']);
Route::get('tipe-surat', [TipeSuratController::class, 'getHistory']);
Route::post('tipe-surat/{id}', [TipeSuratController::class, 'delete']);

// User
Route::get('/user-control', [UserController::class, 'index']);
Route::post('/user-control/add',[UserController::class, 'store']);
Route::post('/user-control/edit/{id}',[UserController::class, 'edit']);

// Template Surat
Route::get('/upload-template-surat',function(){
    return view('upload-template-surat');
});
Route::post('/upload-template',[TemplateSuratController::class, 'upload']);
Route::post('/history-template-surat/{id}', [TemplateSuratController::class, 'delete'])->name('delete');
Route::get('/history-template-surat', [TemplateSuratController::class, 'getHistory']);
Route::get('/history-template-surat/s/', [TemplateSuratController::class, 'findHistory']);

// Surat Masuk
Route::get('/simpan-surat',[SuratMasukController::class, 'indexSimpanSurat'])->name('simpan-surat');
Route::post('/simpan-surat',[SuratMasukController::class, 'store']);

// Buat Surat dari Template
Route::post('/buat-surat',[SuratController::class, 'index']);
Route::post('/create-and-download',[SuratController::class, 'createAndDownload']);

// Download surat
Route::post('/download',[SuratController::class, 'download']);
