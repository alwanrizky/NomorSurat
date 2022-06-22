<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function index(){
        $users = User::select('*')->paginate(15);
        return view('user-control', ['users'=>$users]);
    }

    function store(Request $request){
        $name = $request['name'];
        $email = $request['email'];
        $password = bcrypt($request['password']);
        $is_admin = ($request['is_admin']=='on') ? 1: null;
        $is_active = ($request['is_active']=='on') ? 1: null;

        DB::table('users')->insert([
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
            'is_admin'=>$is_admin,
            'is_active'=>$is_active

        ]);

        // $users = User::select('*')->paginate(15);
        return redirect()->back();
        
    }

    function edit(Request $request){
        $user =User::find($request['id']);

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->is_admin = ($request['is_admin']=='on') ? 1: null;
        $user->is_active = ($request['is_active']=='on') ? 1: null;

        $user->save();

        return redirect()->back();
    }
}
