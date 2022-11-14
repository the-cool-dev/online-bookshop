<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Auth;


class userController extends Controller
{
    //
    function login(Request $req){
        $credentials = $req->only('email', 'password');
        $user = User::where(['email' => $req -> email]) -> first();
        $user_role = $user['user_role'];
        $remember = $req->remember;
 
        if (Auth::attempt($credentials, $remember) && $user_role == 1) {
            // Authentication passed...
            $req -> session() -> put('user', $user);
            return redirect('/admin');
        }elseif(Auth::attempt($credentials, $remember) && $user_role == 0){
                // Authentication passed...
                $req -> session() -> put('user', $user);
                return redirect('/');
        }
        else{
            return Redirect::back()->withErrors(['invalid' => 'Username or Password is Invalid']);
        }
    }

    function register(Request $req){

        // $req -> validate([
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'user_name' => 'required',
        //     'email' => 'required',
        //     'password' => 'required',
        //     'confirm_password' => 'required',
        // ]);

        $validator = Validator::make($req -> all(), [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'user_name' => ['required'],
            'email' => ['required', 'unique:users', 'email:rfc,dns'],
            'password' => ['required', 'min:8', 'max:10', 'confirmed:password'],
            'password_confirmation' => ['required'],
        ],
        [
            'first_name.required' => 'First name cannot be empty',
            'last_name.required' => 'Last name cannot be empty',
            'user_name.required' => 'User name cannot be empty',
            'email.required' => 'Email address cannot be empty',
            'email.unique' => 'Email address already exists',
            'password.required' => 'Password cannot be empty',
            'password_confirmation.required' => 'Please confirm your password',
            'password.confirmed' => 'Password and confirm password does not matches',
            
            
        ]
    );


        if ($validator->fails()) {
            return redirect('/register')
                            ->withErrors($validator)->withInput();
                        
        }
        

        $user = new User;

        $user -> first_name = $req -> first_name; 
        $user -> last_name = $req -> last_name;
        $user -> user_name = $req -> user_name;
        $user -> email = $req -> email;
        $user -> password = Hash::make($req -> password);
        $user -> user_role = 1;
        $user -> save();

        // $user = User::create([
        //     'name' => $req -> input('first_name')
        // ]);

        return redirect('/login');
    }

    function viewUsers(){
        $user = User::all();
        return view('admin/view_users', ['users' => $user]);
    }

    function updateUserStatus($id, $status){
        if ($status == 1) {
            User::where('id', $id) -> update(['status' => 0]);
        }else{
            User::where('id', $id) -> update(['status' => 1]);
        }

        return redirect('admin/view_users');
    }


}




