<?php

namespace App\Http\Controllers;

use App\Models\NomorSurat;
use App\Models\Surat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratController extends Controller
{
    //

    private AtrSuratController $atrSuratController;
    private TemplateSuratController $templateSuratController;
    private NomorSuratController $nomorSuratController;

    public function __construct()
    {
        $this->atrSuratController = new AtrSuratController();
        $this->templateSuratController = new TemplateSuratController();
        $this->nomorSuratController = new NomorSuratController();
    }

    public function index(Request $request){
        $nosur= $request->nomor_surat;

        $atr = $this->atrSuratController->getAtr($request->id_template);
        $nama = $this->templateSuratController->getData(null, $request->id_template)->nama_surat;
        return view('buat-surat', ['id'=>$request->id_template,'nomor_surat'=>$nosur, 'atribut'=>$atr, 'nama_surat'=>$nama]);
    }

    public function createAndDownload(Request $request){
        // print_r($request->nama_surat." ".$request->id_template);
        $idTemplate=$request->id_template;
        $atr = $this->atrSuratController->getAtr($idTemplate);
        $nomorSurat = $request->nomor_surat;
        // print($nomorSurat);
        $idNomorSurat=$this->nomorSuratController->findIdByNomorSurat($nomorSurat);
        // print($idNomorSurat);


        // membuka lokasi file
        $template = new TemplateProcessor('upload/'.$request->nama_surat.'.docx');
        $template->setValue('nomorSurat',$nomorSurat);
        foreach($atr as $a){
            $template->setValue($a->key,$request[$a->key]);
            // insert ke db
            DB::table('surats')->insert([
                'id_template_surat'=>$idTemplate,
                'id_nomor_surat'=>$idNomorSurat,
                'id_user'=>Auth::id(),
                'key'=>$a->key,
                'value'=>$request[$a->key],
                'created_at' => Carbon::now('utc')->toDateTimeString(),
            ]);
        }

        $update= NomorSurat::find($idNomorSurat);
        $update->surat_created=1;
        $update->save();

        $template->saveAs($request->nama_surat." percobaan.docx");
        return response()->download($request->nama_surat." percobaan.docx")->deleteFileAfterSend(true);
    }

    public function download(Request $request){
        $query = Surat::join('template_surats', 'template_surats.id', '=', 'surats.id_template_surat')
                ->join('nomor_surats', 'surats.id_nomor_surat', '=', 'nomor_surats.id')
                ->select('nama_surat', 'surats.key', 'surats.value', 'nomor_surat')
                ->where('surats.id_nomor_surat', $request->id_nomor_surat)->get();


        $namaSurat = $query[0]->nama_surat;
        $nomorSurat =  $query[0]->nomor_surat;
        
        
        $template = new TemplateProcessor('upload/'.$namaSurat.'.docx');
        $template->setValue('nomorSurat',$nomorSurat);
        foreach($query as $a){
            $template->setValue($a->key,$a->value);
        }

        $template->saveAs($namaSurat." percobaan.docx");
        return response()->download($namaSurat." percobaan.docx")->deleteFileAfterSend(true);
    }
}
