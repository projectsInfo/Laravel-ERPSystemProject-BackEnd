<?php

namespace App\Http\Controllers\accounting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class trialBalance extends Controller
{

    
    //============================= revenue shipping company ====================


    public function trialBalance(){
        return view('accounting.trialBalance.trialBalance');
    }



}