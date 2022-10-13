<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    //
    function index(){
        $data = Product::all();
        $slider = Slider::all();
        return view('product', ['datas' => $data]);
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
        $userId = Session::get('user')['id'];
        if ($req -> session() -> has('user')) {
            
            $cart = new Cart;
            $existing_product = Cart::where('product_id', '=', $req -> input('product_id'))
                                   -> where('user_id', '=', $userId) 
                                   -> where('status', '=', 1)
                                   -> first();

            if (!$existing_product) {
                $cart->user_id = $req -> session() -> get('user')['id']; //inserting user id into table (user id column)
                $cart->product_id = $req -> product_id; //inserting product id into table (product id column)
                $cart->status = 1;
                $cart->save();
                return redirect('/products');
            }else{
                return redirect('/');
            }
            
        }else{
            return redirect('/login');
        }

        
    }


    function cartItem(){
        $userId = Session::get('user')['id'];
        return Cart::where('user_id', $userId) -> where('status', 1) -> count();
    }

    function cartList(){
        $userId = Session::get('user')['id'];
        $products = DB::table('cart') 
        -> join('products', 'cart.product_id', '=', 'products.id')
        -> where('cart.user_id', $userId)
        -> where('cart.status', 1)
        -> select('products.*', 'cart.id as cart_id')
        -> get();

        //SELECT products.*, cart.id as cart_id from cart INNER JOIN products ON cart.product_id = products.id WHERE cart.user_id = 4;

        return $products;

        //return view('cartlist', ['cart_products' => $products]);
    }

    function moveToCart($id){
        Cart::destroy($id);
        return redirect('/');
    }

    function checkOut(){

        $userId = Session::get('user')['id'];

        $total = DB::table('cart') 
        -> join('products', 'cart.product_id', '=', 'products.id')
        -> where('cart.user_id', $userId)
        -> sum('products.price');

        $cart_products = DB::table('cart') 
        -> join('products', 'cart.product_id', '=', 'products.id')
        -> where('cart.user_id', $userId)
        -> select('products.*', 'cart.id as cart_id')
        -> get();

        return view('checkout', ['total' => $total], ['products' => $cart_products]);

    }

    function placeOrder(Request $req){
        $userId = Session::get('user')['id'];
        $allCart = Cart::where('user_id', $userId) -> get();
        foreach($allCart as $cart){
            $order = new Order;

            $order->product_id = $cart['product_id'];
            $order->user_id = $cart['user_id'];
            
            
            $order->payment_status = 0;
            $order->status = 0;  

            $order->payment_method = "UPI";
            $order->address = $req -> address;
            $order->country = $req -> country;
            $order->state = $req -> state;
            $order->pincode = $req -> pincode;
            $order->first_name = $req -> first_name;
            $order->last_name = $req -> last_name;
            $order->email = $req -> email;
            $order->mobile = $req -> mobile;
            $order->save();
            Cart::where('user_id', $userId) -> update(['status' => 0]);
            
        }
        return redirect('/');
    }

    function myOrders(){
        $userId = Session::get('user')['id'];
        $orders = DB::table('orders') 
        -> join('products', 'orders.product_id', '=', 'products.id')
        -> where('orders.user_id', $userId)
        -> get();

        return view('orders', ['orders' => $orders]);

    }

    function productList($id){
        $products = Product::where('category_id', $id)->get();
        return view('product_list', ['products' => $products]);
    }

    
}

