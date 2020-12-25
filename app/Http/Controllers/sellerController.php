<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sellerController extends Controller
{
   public function index(Request $req){
        return view('seller.dashboard');

    }
}
