<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeSurat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TipeSuratController extends Controller
{
    public function getTipeSurat(){
        return TipeSurat::all()->where('updated_at',null);
    }

    public function getId($alias){
        return TipeSurat::select('id')->where('alias', $alias)->get();
    }

    public function store(Request $request){
        $tipeSurat = $request->tipe_surat;
        $alias = $request->alias;
        
        $data = TipeSurat::select("tipe_surat")->where("tipe_surat", $tipeSurat);

        if($data->count()==0){
            DB::table('tipe_surats')->insert([
                'tipe_surat'=>$tipeSurat,
                'alias' => $alias,
                'id_user' => Auth::id(),
                'created_at' => Carbon::now('utc')->toDateTimeString(),
            ]);
            return redirect()->back()->with('message','Tipe surat berhasil ditambahkan');
        }else{
            return redirect()->back()->with('message','Nama tipe surat sudah ada didalam sistem. Silakan ulangi dengan nama berbeda');
        }
    }

    public function getHistory(){
        $history = DB::table('tipe_surats')
            ->select("id", "tipe_surat","alias")
            ->where('updated_at',null)
            ->orderBy('id', 'desc');

        if(Auth::user()->is_admin==1){
            $history = $history->paginate(20);
        }else{
            $history = $history->where('id_user','=', Auth::id())->paginate(20);

        }
        // return $history;

        return view('history-tipe-surat', ['history'=>$history]);
    }

    public function delete(Request $request){
        $nosur = TipeSurat::find($request['id']);
        $nosur->updated_at = Carbon::now('utc')->toDateTimeString();
        $nosur->save();

        return redirect()->back();
    }
}