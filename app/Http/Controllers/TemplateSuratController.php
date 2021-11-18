<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TemplateSuratController extends Controller
{
    private $atrSurat;

    public function __construct()
    {
        $this->atrSurat = new AtrSuratController();
    }

    public function upload(Request $request){
        $namaSurat = $request->nama;

        if(!$this->store($namaSurat)){
            return redirect()->back()->with('message','Nama template surat sudah ada didalam sistem. Silakan ulangi dengan nama berbeda');
        }

        $idTemplate = $this->getId($namaSurat);

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

        $this->atrSurat->store($idTemplate, $arrArt);
        return redirect()->back()->with('message','Berhasil mengupload template surat dengan nama: '.$namaSurat);

    }

    private function store($namaSurat){
        $query = DB::table('template_surats')->where('nama_surat', $namaSurat);
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
