<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AtrSuratController extends Controller
{
    //

    public function store($idTemplate, $arr){
        foreach( $arr as $a){
            DB::table('atr_surats')->insert([
                'key'=>$a[0],
                'tipe' => $a[1],
                'id_template_surat' =>$idTemplate,
            ]);
        }
    }
        
}
