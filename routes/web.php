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
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('index');
});

Route::post('/generate', [NomorSuratController::class, 'generateSurat']);

Route::get('/result-surat',[NomorSuratController::class, 'check'])->name('result-surat');

// Route::get('/result-surat',function(Request $request){
//     return view('result-surat');    
// })->name('result-surat');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/create-surat',[NomorSuratController::class, 'index'])->name('create-surat');

Route::get('/menu',function(){
    return view('menu');
});

Route::get('/history',function(){
    return view('history');
});