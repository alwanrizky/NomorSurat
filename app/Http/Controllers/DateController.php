<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

class DateController extends Controller
{
    private Carbon $carbon;

    public function __construct(){
        $this->carbon = Carbon::now('utc');
    }

    public function getCurrentDate(){
        return $this->carbon->toDateTimeString();
    }

    public function getYear(){
        return  $this->carbon->year;
    }

    public function getMonth(){
        return $this->carbon->month;
    }
}
