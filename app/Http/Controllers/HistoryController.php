<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    private NomorSuratController $nomorSuratController;
    private TemplateSuratController $templateSuratController;

    public  function __construct()
    {
        $this->nomorSuratController = new NomorSuratController();
        $this->templateSuratController =  new TemplateSuratController();
    }

    public function getHistoryNomorSurat(){
        $resNoSur = $this->nomorSuratController->getHistory();
        // $resTemp = $this->templateSuratController->getHistory();
        return view('history-nomor-surat', ['historyNomorSurat'=>$resNoSur[0], 
        'tipeSurat' => $resNoSur[1],
        'template'=>$this->templateSuratController->getTemplateSurat()]);
        // 'historyTemplateSurat'=>$resTemp]);
    }

    public function getHistoryTemplateSurat(){

        $resTemp = $this->templateSuratController->getHistory();
        return view('history-template-surat', ['historyTemplateSurat'=>$resTemp]);
    }

    public function findHistoryNomorSurat(Request $request){
        $resNoSur = $this->nomorSuratController->findHistory($request);
        // $resTemp = $this->TemplateSuratController->findHistory($request);
        return view('history-nomor-surat', ['historyNomorSurat'=>$resNoSur[0],
        'tipeSurat' => $resNoSur[1],
        'template'=>$this->templateSuratController->getTemplateSurat()]);
        // 'historyTemplateSurat'=>$resTemp]);
    }
}
