<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\TipeSuratController;

class NomorSuratController extends Controller
{
    private TipeSuratController $tipeSurat;

    public function __construct(){
        $this->tipeSurat = new TipeSuratController();
    }

    public function index(){
        return view('create-surat', ['tipeSurat' => $this->tipeSurat->getTipeSurat()]);
    }
}
