<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

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
        return view('buat-surat', ['id'=>$request->id_template,'nomor_surat'=>$nosur, 'atribut'=>$atr, 'nama_surat'=>$nama]);
    }

    public function createAndDownload(Request $request){
        // print_r($request->nama_surat." ".$request->id_template);
        $atr = $this->atrSuratController->getAtr($request->id_template);

        // membuka lokasi file
        $template = new TemplateProcessor('upload/'.$request->nama_surat.'.docx');
        foreach($atr as $a){
            $template->setValue($a->key,$request[$a->key]);
        }
        
        // $template->setValue('alamat','Jalan Raya');

        $template->saveAs($request->nama_surat." percobaan.docx");
        return response()->download($request->nama_surat." percobaan.docx")->deleteFileAfterSend(true);
    }
}
