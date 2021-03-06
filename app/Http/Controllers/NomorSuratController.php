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
    private TemplateSuratController $templateSuratController;
    private Carbon $date;
    
    public function __construct(){
        $this->tipeSuratController = new TipeSuratController();
        $this->templateSuratController =  new TemplateSuratController();
        $this->date = Carbon::now('utc');
    }

    public function index(){
        return view('create-nomor-surat', ['tipeSurat' => $this->tipeSuratController->getTipeSurat()]);
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
                'surat_created' => 0,
                'id_user' => Auth::id(),
                'id_tipe_surat' => $idTipeSurat[0]['id'],
                'created_at' => $this->date->toDateTimeString(),
            ];
            array_push($result, $data);
        }

        NomorSurat::insert($result);

        return redirect()->route('result-nomor-surat')->with(['result'=>$result]);
    }

    public function check(){
        if(Session::get('result')!=null){
            return view('result-nomor-surat');
        }else{
            return redirect()->route('create-nomor-surat');
        }
    }

    public function getHistory(){
        $history = NomorSurat::join('users', 'nomor_surats.id_user','=','users.id')
            ->select('nomor_surats.id','nomor_surats.created_at','nomor_surats.nomor_surat'
            ,'nomor_surats.perihal','nomor_surats.kepada','nomor_surats.surat_created', 'users.name')
            ->where('nomor_surats.deleted_at',null)
            ->orderBy('nomor_surats.created_at', 'desc')
            ->orderBy('nomor_surats.id', 'desc');
        
        if(Auth::user()->is_admin==1){
            $history = $history->paginate(15);
        }else{
            $history = $history->where('id_user','=', Auth::id())->paginate(15);
            
        }
        $res=[
            $history,
            $this->tipeSuratController->getTipeSurat(),
            $this->templateSuratController->getTemplateSurat()
        ];
        // return $res;
        return view('history-nomor-surat', ['history'=>$res[0], 'tipeSurat' => $res[1], 'template'=>$res[2]]);
        
    }

    public function findHistory(Request $request){
        $history = NomorSurat::join('users', 'nomor_surats.id_user','=','users.id')
            ->select('nomor_surats.id','nomor_surats.created_at','nomor_surats.nomor_surat'
            ,'nomor_surats.perihal','nomor_surats.kepada','nomor_surats.surat_created', 'users.name')
            ->where('nomor_surats.deleted_at',null)
            ->orderBy('nomor_surats.created_at', 'desc')
            ->orderBy('nomor_surats.id', 'desc');

            $startDate=$request['startDate'];
            $endDate=date('Y-m-d',strtotime($request['endDate'] . "+1 days"));
        if(Auth::user()->is_admin==1){
            if($startDate!=null && $endDate!=null){
                $history =$history->whereBetween('nomor_surats.created_at', [$startDate, $endDate])
                ->paginate(15)->withQueryString();
            }else{
                $search = $request["search"];
                if($search){
                    $history = $history->where(function($query) use ($search){
                                    $query->where('kepada', 'like', '%'.$search.'%')
                                    ->orWhere('perihal', 'like', '%'.$search.'%')
                                    ->orWhere('name','like', '%'.$search.'%');
                                })
                                ->paginate(15)->withQueryString();
                }else{
                    $id = $request['idTipeSurat'];
                    $history = $history->where(function($query) use ($id){
                        $query->where('id_tipe_surat', '=',$id);
                    })
                    ->paginate(15)->withQueryString();
                }
                
            }
        }else{
            if($startDate!=null && $endDate!=null){
                $history=$history->where('id_user','=', Auth::id())
                            ->whereBetween('created_at', [$startDate, $endDate])
                            ->paginate(15)->withQueryString();;
            }else{
                $search = $request["search"];
                if($search){
                    $history = $history->where('id_user','=', Auth::id())
                            ->where(function($query) use ($search){
                                $query->where('kepada', 'like', '%'.$search.'%')
                                ->orWhere('perihal', 'like', '%'.$search.'%');
                            })
                            ->paginate(15)->withQueryString();;
                }else{
                    $id = $request['idTipeSurat'];
                    $history = $history->where('id_user','=', Auth::id())
                            ->where(function($query) use ($id){
                                $query->where('id_tipe_surat', '=', $id);
                            })
                            ->paginate(15)->withQueryString();;
                            
                }
                
            }
        }

        $res=[
            $history,
            $this->tipeSuratController->getTipeSurat(),
            $this->templateSuratController->getTemplateSurat()
        ];
        // return $res;
        return view('history-nomor-surat', ['history'=>$res[0], 'tipeSurat' => $res[1], 'template'=>$res[2]]);
    }

    public function delete(Request $request){
        // print_r($request['id']);
        // return view('dashboard');
        $nosur = NomorSurat::find($request['id']);
        $nosur->deleted_at = $this->date->toDateTimeString();
        $nosur->save();

        return redirect()->back();

        // $nosur->save();
        // // NomorSurat::where('$id', $request['id'])
        // // ->update([
        // //     'updated_at' => $this->date->toDateTimeString(),
        // //     ]);
        // return json_encode(array('statusCode'=>200));

    }

    public function findIdByNomorSurat($nomorSurat){
        return DB::table("nomor_surats")->where('nomor_surat','Like', '%'.$nomorSurat.'%')->value('id');
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
