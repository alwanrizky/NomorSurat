<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratController extends Controller
{
    //
    private TipeSuratController $tipeSuratController;

    public function __construct()
    {
        $this->tipeSuratController = new TipeSuratController();
    }

    public function indexSimpanSurat(){
        return view('simpan-surat', ['tipeSurat' => $this->tipeSuratController->getTipeSurat()]);
    }

    public function store(Request $request){

        $perihal = $request['perihal'];
        $kepada = $request['kepada'];
        $tanggal = $request['date'];
        $aliasTipeSurat = $request['aliasTipeSurat'];
        $idTipeSurat = $this->tipeSuratController->getId($aliasTipeSurat);

        DB::table('surat')->insert([
            'kepada' => $kepada,
            'perihal' => $perihal,
            'tanggal' => $tanggal,
            'id_user' => Auth::id(),
            'id_tipe_surat' => $idTipeSurat[0]['id'],
            'created_at' => Carbon::now('utc')->toDateTimeString(),
        ]);

        return redirect()->back()->with('message','Berhasil menyimpan surat');
    }
}
