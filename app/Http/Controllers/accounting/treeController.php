<?php

namespace App\Http\Controllers\accounting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class treeController extends Controller
{
    public function tree(){
        return view('accounting.Tree.shippingCompany');
    }
}
