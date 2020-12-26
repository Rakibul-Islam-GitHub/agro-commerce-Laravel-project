<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Product;
use DB;

class sellerController extends Controller
{
   public function index(Request $req){
       $req->session()->put('username', '1');
       $user = $req->session()->get('username');
       $reviews=count(Review::where('sellerid', $user)->get());
       $products=count(Product::where('sellerid', $user)->get());

       $data = DB::table('orders')
       ->join('invoice', 'invoice.oid', '=', 'orders.oid')->where('invoice.sellerid', $user)
       ->where('status','complete')
       ->select('orders.*')
       ->get();

       $datas= count($data);
       
        return view('seller.dashboard', compact('reviews', 'products', 'datas', 'data'));

    }

    public function additem(Request $req){
        return view('seller.additem');

    }

    public function manageitem(Request $req){
        $user = $req->session()->get('username');
        $data= Product::where('sellerid', $user)->get();
        return view('seller.manageitem', compact('data'));

    }
    public function review(Request $req){
        $user = $req->session()->get('username');
        $data= Review::where('sellerid', $user)->get();
        return view('seller.review', compact('data'));

    }
    public function order(Request $req){
        $user = $req->session()->get('username');
        $data = DB::table('orders')
       ->join('invoice', 'invoice.oid', '=', 'orders.oid')->where('invoice.sellerid', $user)
       ->select('orders.*')
       ->get();

        return view('seller.order', compact('data'));

    }


    public function itemstore(Request $req){
        if($req->hasFile('pic')){

        	$file = $req->file('pic');
        	/*echo "File Name: ".$file->getClientOriginalName()."<br/>";
        	echo "File Extension: ".$file->getClientOriginalExtension()."<br/>";
        	echo "File Size: ".$file->getSize();*/
            $filename= date('m-d-Y_His.').$file->getClientOriginalExtension();
        	if($file->move('upload', $filename)){
        		
                $product = new Product();

                $product->sellerid         = $req->session()->get('username') ;
                $product->shop_name         = 'Agri shop';
                $product->title         = $req->title;
                $product->price         = $req->price;
                $product->description         = $req->description;
                $product->image  = $filename;
                $product->status         = 'Available';

                if($product->save()){
                    return redirect()->route('seller.manageitem');
                }else{
                    return back();
                }

        	}else{
        		return back();
        	}
        }
    }

    public function itemdelete(Request $req){
       
        $pid= $req->pid;
        $p=Product:: find($pid);
        $p->delete();
       
    return 'success';

    }
}
