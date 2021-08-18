<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\TipeSuratController;
use App\Http\Controllers\DateController;

use App\Models\NomorSurat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NomorSuratController extends Controller
{
    private TipeSuratController $tipeSuratController;
    private DateController $dateController;

    private $result;

    public function __construct(){
        $this->tipeSuratController = new TipeSuratController();
        $this->dateController = new DateController();
    }

    public function index(){
        return view('create-surat', ['tipeSurat' => $this->tipeSuratController->getTipeSurat()]);
    }

    public function generateSurat(Request $request){
        
        $currentDate = $this->dateController->getCurrentDate();
        $year = $this->dateController->getYear();
        $month = $this->dateController->getMonth();

        // hitung banyaknya data di db nomorsurat
        $banyakData = $this->countSurat($year);

        $divisor = 1000;
        $measureZero="";
        while(($banyakData+1)/$divisor < 1 )
        {
            $measureZero .= "0";
            $divisor = $divisor/10;
        }
        
        $data = $request;

        $perihal = $request['perihal'];
        $kepada = $request['kepada'];
        $aliasTipeSurat = $request['aliasTipeSurat'];
        $idTipeSurat = $this->tipeSuratController->getId($aliasTipeSurat);

        $multiply = $request['multiply'];
        if($multiply==null){
            $multiply=1;
        }

        $this->result = [];

        for($i = 1; $i<= $multiply; $i++){
            $firstMeasure = $this->firstMeasure($banyakData, $i);
            $nosur = "III/FTIS/".$year."-".$month."/".$measureZero."".($banyakData+$i)."-".$aliasTipeSurat."";
            $data = [
                'nomor_surat' => $nosur,
                'kepada' => $kepada,
                'perihal' => $perihal,
                'id_user' => Auth::id(),
                'id_tipe_surat' => $idTipeSurat[0]['id'],
                'created_at' => $currentDate,
            ];
            array_push($this->result, $data);
        }

        NomorSurat::insert($this->result);

        return redirect()->route('result-surat')->with(['result'=>$this->result]);
    }

    public function check(){
        if(Session::get('result')!=null){
            return view('result-surat');
        }else{
            return redirect()->route('create-surat');
        }
    }

    public function getHistory(){
        $history = NomorSurat::all()->where('id_user','=', Auth::id());
        return view('history', ['history'=>$history]);
    }

    private function countSurat($year){
        $query = NomorSurat::where('created_at','Like', '%'.$year.'%');
        return $query->count();
    }

    private function firstMeasure($banyakData, $i){
        $firstMeasure = 0;
        if($banyakData+$i >= 1000) {
            $firstMeasure = "";
        }
        else if ($banyakData+$i >= 100) {
            $firstMeasure = "0";
        }
        else if ($banyakData+$i >= 10) {
            $firstMeasure = "00";
        }
        else if ($banyakData+$i >= 1) {
            $firstMeasure = "000";
        }
        return $firstMeasure;
    }
}
