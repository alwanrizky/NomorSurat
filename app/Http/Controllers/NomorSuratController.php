<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\TipeSuratController;

use App\Models\NomorSurat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class NomorSuratController extends Controller
{
    private TipeSuratController $tipeSuratController;
    private Carbon $date;
    
    public function __construct(){
        $this->tipeSuratController = new TipeSuratController();
        $this->date = Carbon::now('utc');
    }

    public function index(){
        return view('create-surat', ['tipeSurat' => $this->tipeSuratController->getTipeSurat()]);
    }

    public function generateSurat(Request $request){
        // hitung banyaknya data di db nomorsurat
        $banyakData = $this->countSurat($this->date->year);

        $perihal = $request['perihal'];
        $kepada = $request['kepada'];
        $aliasTipeSurat = $request['aliasTipeSurat'];
        $idTipeSurat = $this->tipeSuratController->getId($aliasTipeSurat);

        $multiply = $request['multiply'];
        if($multiply==null) $multiply=1;

        $result = [];

        for($i = 1; $i<= $multiply; $i++){
            $firstMeasure = $this->firstMeasure($banyakData, $i);
            $nosur = "III/FTIS/".$this->date->year."-".$this->date->month."/".$firstMeasure."".($banyakData+$i)."-".$aliasTipeSurat."";
            $data = [
                'nomor_surat' => $nosur,
                'kepada' => $kepada,
                'perihal' => $perihal,
                'id_user' => Auth::id(),
                'id_tipe_surat' => $idTipeSurat[0]['id'],
                'created_at' => $this->date->toDateTimeString(),
            ];
            array_push($result, $data);
        }

        NomorSurat::insert($result);

        return redirect()->route('result-surat')->with(['result'=>$result]);
    }

    public function check(){
        if(Session::get('result')!=null){
            return view('result-surat');
        }else{
            return redirect()->route('create-surat');
        }
    }

    public function getHistory(){
        $history = NomorSurat::join('users', 'nomor_surats.id_user','=','users.id')
            ->select('nomor_surats.created_at','nomor_surats.nomor_surat'
            ,'nomor_surats.perihal','nomor_surats.kepada', 'users.name');
        
            if(Auth::user()->is_admin==1){
            $history = $history->paginate(20);
        }else{
            $history = $history->where('id_user','=', Auth::id())->paginate(20);
            
        }
        return view('history', ['history'=>$history, 'tipeSurat' => $this->tipeSuratController->getTipeSurat()]);
        
    }

    public function findHistory(Request $request){
        $history = NomorSurat::join('users', 'nomor_surats.id_user','=','users.id')
            ->select('nomor_surats.created_at','nomor_surats.nomor_surat'
            ,'nomor_surats.perihal','nomor_surats.kepada', 'users.name');

            $startDate=$request['startDate'];
            $endDate=date('Y-m-d',strtotime($request['endDate'] . "+1 days"));
        if(Auth::user()->is_admin==1){
            if($startDate!=null && $endDate!=null){
                $history =$history->whereBetween('nomor_surats.created_at', [$startDate, $endDate])
                ->paginate(20)->withQueryString();
            }else{
                $search = $request["search"];
                $history = $history->where(function($query) use ($search){
                                    $query->where('kepada', 'like', '%'.$search.'%')
                                    ->orWhere('perihal', 'like', '%'.$search.'%')
                                    ->orWhere('name','like', '%'.$search.'%');
                                }) 
                                ->paginate(20)->withQueryString();
            }
        }else{
            if($startDate!=null && $endDate!=null){
                $history=$history->where('id_user','=', Auth::id())
                            ->whereBetween('created_at', [$startDate, $endDate])
                            ->paginate(20)->withQueryString();
            }else{
                $search = $request["search"];
                $history = $history->where('id_user','=', Auth::id())
                            ->where(function($query) use ($search){
                                $query->where('kepada', 'like', '%'.$search.'%')
                                ->orWhere('perihal', 'like', '%'.$search.'%');
                            }) 
                            ->paginate(20)->withQueryString();
            }
        }
        return view('history', ['history'=>$history]);
    }

    private function countSurat($year){
        $query = NomorSurat::where('created_at','Like', '%'.$year.'%');
        return $query->count();
    }

    private function firstMeasure($banyakData, $i){
        $firstMeasure = 0;
        if($banyakData+$i >= 1000) $firstMeasure = "";
        else if ($banyakData+$i >= 100) $firstMeasure = "0";
        else if ($banyakData+$i >= 10) $firstMeasure = "00";
        else if ($banyakData+$i >= 1) $firstMeasure = "000";
        
        return $firstMeasure;
    }
}
