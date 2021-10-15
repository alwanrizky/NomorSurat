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
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('index');
});

Route::post('/generate', [NomorSuratController::class, 'generateSurat']);

Route::get('/result-surat', [NomorSuratController::class, 'check'])->name('result-surat');

Route::get('/history', [NomorSuratController::class, 'getHistory']);

Route::get('/history/s/', [NomorSuratController::class, 'findHistory']);

Route::post('/history/delete/{id}', [NomorSuratController::class, 'delete'])->name('delete');

Route::get('/user-control', [UserController::class, 'index']);

Route::post('/user-control/add-user',[UserController::class, 'store']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/create-surat',[NomorSuratController::class, 'index'])->name('create-surat');

Route::get('/menu',function(){
    return view('menu');
});
