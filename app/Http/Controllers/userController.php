<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class userController extends Controller
{
    //
    function login(Request $req){
        $user = User::where(['email' => $req -> email]) -> first();

        

        if ( !$user || !(Hash::check($req -> password, $user -> password))) {
            return "Invalid username or password";
        }else{
            $req -> session() -> put('user', $user);
            return redirect('/products');
        }
    }
}
