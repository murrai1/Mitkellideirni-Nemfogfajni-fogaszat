<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Account;
use Illuminate\Support\Facades\Crypt;

class AccountController extends Controller
{
    public function authenticate(Request $request)
    {
        $username = $request->post("username");
        $password = $request->post("password");




            $prefix = '$2y$';
            $cost = '10';
            $salt = '$mitkellideirnikerdojeltesztvezereltszoft$';
            $blowFishPrefix = $prefix.$cost.$salt;
            $hash = crypt( $password, $blowFishPrefix);



               $user=Account::where([
                'username' =>$username,
                'password'=>$hash,
               ])->first();


               if($user)
               {
                   Auth::guard('user')->login($user);
                   return redirect('valaszto');
               }else {

                    return redirect('/login')->with('errorcode', 2);
                }


    }
}
