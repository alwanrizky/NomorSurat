<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TemplateSuratController extends Controller
{
    //

    public function upload(Request $request){
        $namaSurat = $request->nama;

        // print_r($namaFile);
        // print("<br>");
        if(!$this->store($namaSurat)){
            return redirect()->back();
        }

        $idTemplate = $this->getId($namaSurat);
        print_r($idTemplate);
        // print("<br>");
        $arrArt = [];
        for($i=0;$i<10;$i++){
            $atr = "atr-".$i;
            $tipeData = "tipeData-".$i;
            if($request->$atr!=null){
                $arrArt[$i]=[];
                array_push($arrArt[$i], $request->$atr);
                array_push($arrArt[$i], $request->$tipeData);
            }else{
                break;
            }
        }

        print_r($arrArt);
    }

    private function store($namaSurat){
        $query = DB::table('template_surats')->where('nama_surat', $namaSurat);
        // print_r($query->count());
        if($query->count()==0){
            DB::table('template_surats')->insert([
                'nama_surat'=>$namaSurat,
                'id_user' => Auth::id(),
            ]);
            return true;
        }else{
            return false;
        }
        
    }

    private function getId($namaSurat){
        return DB::table('template_surats')->where('nama_surat', $namaSurat)->value('id');
    }
}
