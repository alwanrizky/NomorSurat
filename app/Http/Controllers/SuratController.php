<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratController extends Controller
{
    //

    private AtrSuratController $atrSuratController;
    private TemplateSuratController $templateSuratController;

    public function __construct()
    {
        $this->atrSuratController = new AtrSuratController();
        $this->templateSuratController = new TemplateSuratController();
    }

    public function index(Request $request){
        $nosur= $request->nomor_surat;

        $atr = $this->atrSuratController->getAtr($request->id_template);
        $nama = $this->templateSuratController->getData(null, $request->id_template)->nama_surat;
        return view('buat-surat', ['nomor_surat'=>$nosur, 'atribut'=>$atr, 'nama'=>$nama]);
    }
}
