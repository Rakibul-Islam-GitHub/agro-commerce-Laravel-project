<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;
use App\User;
class loginControllerall extends Controller
{
    function index(Request $req){
        return view('seller.login');

    }
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback(Request $req)
    {
        $user = Socialite::driver('google')->user();

      // return $user->getEmail();
       //return redirect('/');
       $googlemail= $user->getEmail();

       $usercheck = User::where('email', $googlemail)->get();
       if(count($usercheck)>0){

                    $userid = User::where('email', $googlemail)
                    ->get();

        $req->session()->put('username', $userid[0]->uid);
        return redirect()->route('seller.dashboard');
    }else{
        $req->session()->flash('msg', 'invalid username/password');
        return redirect('/login');
    }

    }

    function verify(Request $req){
        //$req->validated();
      // $user= User::find()->all
       $user = User::where('email', $req->username)
                    ->where('password', $req->password)
                    ->first();
                    // if ($user->role== 'seller') {
                        
                    // }
                    if(count($user)>0){
                        if ($user->role== 'seller') {
                            $req->session()->put('username', $user->uid);
                        $req->session()->put('email', $req->username);
                        $req->session()->put('type', 'seller');
                        return redirect()->route('seller.dashboard');
                        }
                        
                    } else{
                        $req->session()->flash('msg', 'invalid username/password');
                        return redirect('/login');
                    }
            

    }
}
