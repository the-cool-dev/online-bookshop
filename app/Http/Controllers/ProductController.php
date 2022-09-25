<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Product;
Use App\Models\Slider;
Use App\Models\Cart;
Use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //
    function index(){
        $data = Product::all();
        $slider = Slider::all();
        return view('product', ['sliders' => $slider], ['datas' => $data]);
    }

    function detail($id){
        $detail = Product::find($id);
        return view('detail', ['detail' => $detail]);
    }

    function search(Request $req){
        $data = Product::where('name', 'like', '%'.$req -> input('search').'%') -> get();
        return view('search', ['products' => $data]);
    }

    function addToCart(Request $req){
        
        if ($req -> session() -> has('user')) {
            $cart = new Cart;
            $cart->user_id = $req -> session() -> get('user')['id']; //inserting user id into table (user id column)
            $cart->product_id = $req -> product_id; //inserting product id into table (product id column)
            $cart->save();
            return redirect('/products');
        }else{
            return redirect('/login');
        }

        
    }


    function cartItem(){
        $userId = Session::get('user')['id'];
        return Cart::where('user_id', $userId) -> count();
    }
}

