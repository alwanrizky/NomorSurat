<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratController extends Controller
{
    //

    private AtrSuratController $atrSuratController;

    public function __construct()
    {
        $this->atrSuratController = new AtrSuratController();
    }

    public function index(Request $request){
        $nosur= $request->nomor_surat;

        $atr = $this->atrSuratController->getAtr($request->id_template);
     
        return view('buat-surat', ['nomor_surat'=>$nosur, 'atribut'=>$atr]);
    }
}
