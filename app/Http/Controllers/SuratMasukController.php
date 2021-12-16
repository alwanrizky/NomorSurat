<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratMasukController extends Controller
{
    //
    private TipeSuratController $tipeSuratController;

    public function __construct()
    {
        $this->tipeSuratController = new TipeSuratController();
    }

    public function indexSimpanSurat()
    {
        return view('simpan-surat', ['tipeSurat' => $this->tipeSuratController->getTipeSurat()]);
    }

    public function store(Request $request)
    {

        $perihal = $request['perihal'];
        $pengirim = $request['pengirim'];
        $tanggal = $request['date'];
        $aliasTipeSurat = $request['aliasTipeSurat'];
        $idTipeSurat = $this->tipeSuratController->getId($aliasTipeSurat);

        DB::table('surat_masuks')->insert([
            'pengirim' => $pengirim,
            'perihal' => $perihal,
            'tanggal' => $tanggal,
            'id_user' => Auth::id(),
            'id_tipe_surat' => $idTipeSurat[0]['id'],
            'created_at' => Carbon::now('utc')->toDateTimeString(),
        ]);

        return redirect()->back()->with('message', 'Berhasil menyimpan surat');
    }

    public function getHistory()
    {
        $history = SuratMasuk::join('tipe_surats', 'surat_masuks.id_tipe_surat', '=', 'tipe_surats.id')
            ->select('surat_masuks.id', 'tanggal', 'pengirim', 'perihal', 'tipe_surats.alias')
            ->where('surat_masuks.updated_at', null)
            ->orderBy('surat_masuks.created_at', 'desc')
            ->orderBy('surat_masuks.id', 'desc');

        if (Auth::user()->is_admin == 1) {
            $history = $history->paginate(15);
        } else {
            $history = $history->where('id_user', '=', Auth::id())->paginate(15);
        }
        $res = [
            $history,
            $this->tipeSuratController->getTipeSurat(),
        ];
        // return $res;
        return view('history-surat-masuk', ['history' => $res[0], 'tipeSurat' => $res[1]]);
    }

    public function findHistory(Request $request){
        $history = SuratMasuk::join('tipe_surats', 'surat_masuks.id_tipe_surat', '=', 'tipe_surats.id')
        ->select('surat_masuks.id', 'tanggal', 'pengirim', 'perihal', 'tipe_surats.alias')
        ->where('surat_masuks.updated_at', null)
        ->orderBy('surat_masuks.created_at', 'desc')
        ->orderBy('surat_masuks.id', 'desc');


            $startDate=$request['startDate'];
            $endDate=date('Y-m-d',strtotime($request['endDate'] . "+1 days"));
        if(Auth::user()->is_admin==1){
            if($startDate!=null && $endDate!=null){
                $history =$history->whereBetween('surat_masuks.created_at', [$startDate, $endDate])
                ->paginate(15)->withQueryString();
            }else{
                $search = $request["search"];
                if($search){
                    $history = $history->where(function($query) use ($search){
                                    $query->where('pengirim', 'like', '%'.$search.'%')
                                    ->orWhere('perihal', 'like', '%'.$search.'%');
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
                                $query->where('pengirim', 'like', '%'.$search.'%')
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
        ];
        // return $res;
        return view('history-surat-masuk', ['history'=>$res[0], 'tipeSurat' => $res[1]]);
    }

    public function delete(Request $request)
    {
        $nosur = SuratMasuk::find($request['id']);
        $nosur->updated_at = Carbon::now('utc')->toDateTimeString();
        $nosur->save();

        return redirect()->back();
    }
}
