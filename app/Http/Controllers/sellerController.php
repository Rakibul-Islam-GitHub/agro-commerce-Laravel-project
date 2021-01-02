<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Product;
use App\User;
use DB;

class sellerController extends Controller
{
    function guzzlereq(){
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'http://localhost:3000/seller/comments');
    //echo $response->getStatusCode(); // 200
    // echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
      $data = $response->getBody();
      //var_dump(json_decode($data));
      $var = json_decode($data);
      //dd($var);
      $test = $var[0]->id;
      echo $test;
      return view('seller.category',compact('var'));

    }


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
       $orders= json_encode($data);
       
        return view('seller.dashboard', compact('reviews', 'products', 'datas', 'data', 'orders'));

    }

    public function additem(Request $req){
        return view('seller.additem');

    }

    public function manageitem(Request $req){
        $user = $req->session()->get('username');
        $data= Product::where('sellerid', $user)->get();
        return view('seller.manageitem', compact('data'));

    }

    public function edititem($id){
        
        $data= Product::where('pid', $id)->first();
        return view('seller.edititem', compact('data'));

    }
    public function updateitem(Request $req ,$id){
            if($req->hasFile('pic')){
        	$file = $req->file('pic');
            $filename= date('m-d-Y_His.').$file->getClientOriginalExtension();
        	if($file->move('upload', $filename)){
        		
                
                $product= Product:: where('pid', $id)->first();
                $product->title         = $req->title;
                $product->price         = $req->price;
                $product->description         = $req->description;
                $product->image  = $filename;
                if($product->save()){
                    return redirect()->route('seller.manageitem');
                }else{
                    return back();
                }

        	}
        }else{
            $product= Product:: where('pid', $id)->first();
            $product->title         = $req->title;
            $product->price         = $req->price;
            $product->description         = $req->description;
            $product->save();
            return redirect()->route('seller.manageitem');
        }
    }
    public function review(Request $req){
        $user = $req->session()->get('username');
       // $data= Review::where('sellerid', $user)->get();
        $data = DB::table('review')
        ->join('products', 'review.productid', '=', 'products.pid')->where('review.sellerid', $user)
        ->select('review.*','products.title')
        ->get();
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
    public function profile(Request $req){
        $uid = $req->session()->get('username');
        $data= User::where('uid', $uid)->get();
        return view('seller.profile', compact('data'));

    }
    public function profileupdate(Request $req){
        $uid= $req->session()->get('username');
        $user = User:: find($uid);
        $user->name = $req->name;
        $user->address = $req->address;
        $user->phone = $req->phone;
        $user->email = $req->email;
        $user->save();
        return redirect()->route('seller.profile');
    }
    public function message(Request $req){
        $id= $req->session()->get('username');
        $data= User::where('uid', '!=', 10)->get();
       
        return view('seller.message', compact('data'));

    }
    public function messagestore(Request $req){
        $senderid= $req->session()->get('username');
        $receiverid = $req->userid;
        $msg= $req->msg;
        date_default_timezone_set('Asia/Dhaka');  // Set timezone.
        $time= date('g:i a, d-M');
        $post = DB::table('chats')->insert([
            'uid' => $senderid, 
            'sender' => $senderid,
            'receiver'=> $receiverid,
            'msg' => $msg,
            'time' => $time
          ]);
          return 'success';

    }
    public function messageshow(Request $req){
       $senderid= $req->session()->get('username');
       $id = $req->userid;
       $data = DB::table('chats')
       ->join('users', 'chats.uid', '=', 'users.uid')->where('users.uid', $senderid)->where('chats.receiver', $id)
       ->select('chats.*', 'users.name')
       ->get();
        return json_encode(array('data'=>$data));
      

    }

    // ajax call functions
    public function itemdelete(Request $req){
       
        $pid= $req->pid;
        $p=Product:: find($pid);
        $p->delete();
       
    return 'success';

    }
    public function reviewdelete(Request $req){
        $reviewid= $req->id;
        $review = Review:: find($reviewid);
        $review->delete();

        return 'success';

    }

    public function soldout(Request $req){
       
        $pid= $req->pid;
        $p=Product:: where('pid', $pid)->first();
        $p->status = 'Sold Out';
        $p->save();
       
        return 'success';

    }
    public function stockavailable(Request $req){
       
        $pid= $req->pid;
        $p=Product:: where('pid', $pid)->first();
        $p->status = 'Available';
        $p->save();
       
        return 'success';

    }
    
    public function approveorder(Request $req){
       
        $id= $req->pid;
        $result = DB::table('orders')
    ->where('oid', $id)
    ->update([
        'status' => 'complete'
        
    ]);
       
        return 'success';

    }
}
