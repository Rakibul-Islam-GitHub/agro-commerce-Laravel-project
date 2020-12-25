<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sellerController extends Controller
{
   public function index(Request $req){
        return view('seller.dashboard');

    }

    public function additem(Request $req){
        return view('seller.additem');

    }

    public function manageitem(Request $req){
        return view('seller.manageitem');

    }
    public function review(Request $req){
        return view('seller.review');

    }
}
