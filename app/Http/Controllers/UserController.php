<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){
        $users = User::select('*')->paginate(20);
        return view('user-control', ['users'=>$users]);
    }
}
