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

    function register(Request $req){
        $user = new User;
        $user -> first_name = $req -> first_name; 
        $user -> last_name = $req -> last_name;
        $user -> user_name = $req -> user_name;
        $user -> email = $req -> email;
        $user -> mobile = $req -> mobile;
        $user -> password = $req -> password;
        $user -> user_role = "admin";
        $user -> save();

        return redirect('/login');
    }
}
