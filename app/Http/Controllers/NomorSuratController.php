<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\TipeSuratController;

use Carbon\Carbon;

use App\Models\NomorSurat;

class NomorSuratController extends Controller
{
    private TipeSuratController $tipeSurat;

    public function __construct(){
        $this->tipeSurat = new TipeSuratController();
    }

    public function index(){
        return view('create-surat', ['tipeSurat' => $this->tipeSurat->getTipeSurat()]);
    }

    public function generateSurat(Request $request){
        $date = Carbon::now();
        $year = $date->year;
        $month = $date->month;

        // hitung banyaknya data di db nomorsurat
        $banyakData = $this->countSurat($year);

        $divisor = 1000;
        $measureZero="";
        while(($banyakData+1)/$divisor < 1 )
        {
            $measureZero .= "0";
            $divisor = $divisor/10;
        }

        //firstmeasure
        
        
        $data = $request;

        $perihal = $request['perihal'];
        $kepada = $request['kepada'];
        $tipe = $request['tipeSurat'];
        $multiply = $request['multiply'];
        if($multiply==null){
            $multiply=1;
        }

        $result = [];

        for($i = 1; $i<= $multiply; $i++){
            $firstMeasure = $this->firstMeasure($banyakData, $i);
            $temp = "III/FTIS/".$year."-".$month."/".$measureZero."".($banyakData+$i)."-".$tipe."";
            array_push($result, $temp);
        }

        return view('result-surat', ['result'=>$result]);
    }

    private function countSurat($year){
        $query = NomorSurat::where('created_at','=', $year);
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
