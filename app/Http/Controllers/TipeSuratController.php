<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeSurat;

class TipeSuratController extends Controller
{
    public function getTipeSurat(){
        return TipeSurat::all();
    }
}