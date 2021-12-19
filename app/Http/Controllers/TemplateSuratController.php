<?php

namespace App\Http\Controllers;

use App\Models\TemplateSurat;
use Carbon\Carbon;
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

        $data = $this->getData($namaSurat,null);
        $idTemplate = $data[0]->id;

        $arrArt = [];
        for($i=0;$i<50;$i++){
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

        $this->uploadFile($request);
        return redirect()->back()->with('message','Berhasil mengupload template surat dengan nama: '.$namaSurat);

    }

    /**
     * Function for upload csv into folder upload in public
     */
    private function uploadFile($request){
        $file = $request->file('file');
        $fileName = $request->nama.".docx";
        $savePath = public_path('/upload/');
        $file->move($savePath, $fileName);
        return $savePath.$fileName;
    }

    private function store($namaSurat){
        $query = DB::table('template_surats')->where('nama_surat', $namaSurat);
        if($query->count()==0){
            DB::table('template_surats')->insert([
                'nama_surat'=>$namaSurat,
                'id_user' => Auth::id(),
                'created_at' => Carbon::now('utc')->toDateTimeString(),
            ]);
            return true;
        }else{
            return false;
        }
    }

    public function getData($namaSurat, $id){
        if($namaSurat==null){
            return DB::table('template_surats')->find($id);
        }else{
            return DB::table('template_surats')->where('nama_surat', $namaSurat)->get();
        }
        
    }

    public function getTemplateSurat(){
        return DB::table('template_surats')
                ->where('updated_at', null)
                ->get();
    }

    public function getHistory(){
        $history = DB::table('template_surats')
                    ->join('users', 'template_surats.id_user','=','users.id')
                    ->where('template_surats.updated_at',null)
                    ->select("template_surats.id", "nama_surat","name")
                    ->orderBy('template_surats.id', 'desc');
    
        if(Auth::user()->is_admin==1){
            $history = $history->paginate(15);
        }
        // else{
        //     $history = $history->where('id_user','=', Auth::id())->paginate(15);
            
        // }
        // return $history;

        return view('history-template-surat', ['history'=>$history]);
    }

    public function findHistory(Request $request){
        $search = $request->search;

        $history = DB::table('template_surats')
                    ->join('users', 'template_surats.id_user','=','users.id')
                    ->where('template_surats.updated_at',null)
                    ->select("template_surats.id", "nama_surat","name")
                    ->orderBy('template_surats.id', 'desc');

        if(Auth::user()->is_admin==1){
            // $history = $history->paginate(20);
            $history = $history->where(function($query) use ($search){
                $query->where('nama_surat', 'like', '%'.$search.'%')
                    ->orWhere('users.name', 'like', '%'.$search.'%');
                })
                ->paginate(15)->withQueryString();
        }
        // else{
        //     $history = $history->where('id_user','=', Auth::id())->paginate(15);
            
        // }
        // return $history;

        return view('history-template-surat', ['history'=>$history]);
    }

    public function delete(Request $request){
        $temp =  TemplateSurat::find($request['id']);
        $temp->updated_at = Carbon::now('utc')->toDateTimeString();
        $temp->save();

        return redirect()->back();

    }
}
