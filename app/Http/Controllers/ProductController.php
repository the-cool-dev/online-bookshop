<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Cart;
use App\Models\orderDetail;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


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
        $productId = Session::get('user')['id'];
        if ($req -> session() -> has('user')) {
            
            $cart = new Cart;
            $existing_product = Cart::where('product_id', '=', $req -> input('product_id'))
                                   -> where('user_id', '=', $productId) 
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
        $productId = Session::get('user')['id'];
        return Cart::where('user_id', $productId) -> where('status', 1) -> count();
    }

    function cartList(){
        $productId = Session::get('user')['id'];
        $products = DB::table('cart') 
        -> join('products', 'cart.product_id', '=', 'products.id')
        -> where('cart.user_id', $productId)
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

        $productId = Session::get('user')['id'];

        $total = DB::table('cart') 
        -> join('products', 'cart.product_id', '=', 'products.id')
        -> where('cart.user_id', $productId)
        -> where('cart.status', 1)
        -> sum('products.price');

        $cart_products = DB::table('cart') 
        -> join('products', 'cart.product_id', '=', 'products.id')
        -> where('cart.user_id', $productId)
        -> where('cart.status', 1)
        -> select('products.*', 'cart.id as cart_id')
        -> get();

        return view('checkout', ['total' => $total], ['products' => $cart_products]);

    }

    function placeOrder(Request $req){
        $productId = Session::get('user')['id'];
        $allCart = Cart::where('user_id', $productId)
                        ->where('status', 1)
                        -> get();
        
        $string = "BP-".rand(1000, 5000).date("-Ymd-His");
        $order_no = $string;

        $order_detail = new orderDetail;

            $order_detail->order_no = $order_no;
            $order_detail->payment_method = "UPI";
            $order_detail->payment_status = 0;
            $order_detail->order_total = $req -> total;
            $order_detail->save();

        foreach($allCart as $cart){
            $order = new Order;

            $order->product_id = $cart['product_id'];
            $order->user_id = $cart['user_id'];
            $order->order_no = $order_no; 

            
            $order->address = $req -> address;
            $order->country = $req -> country;
            $order->state = $req -> state;
            $order->pincode = $req -> pincode;
            $order->first_name = $req -> first_name;
            $order->last_name = $req -> last_name;
            $order->email = $req -> email;
            $order->mobile = $req -> mobile;
            $order->save();
            Cart::where('user_id', $productId) -> update(['status' => 0]);
            
        }
            
       
        return redirect('/');
    }

    function myOrders(){
        $productId = Session::get('user')['id'];
        $orders = DB::table('orders') 
        -> join('products', 'orders.product_id', '=', 'products.id')
        -> where('orders.user_id', $productId)
        -> get();

        return view('orders', ['orders' => $orders]);

    }

    function productList($id){
        $products = Product::where('category_id', $id)->get();
        return view('product_list', ['products' => $products]);
    }

    //Admin 

    function viewProducts(){
        $products = Product::all();
        return view('admin/view_products', ['products' => $products]);
    }


    function deleteProduct(Request $req){
        $product = Product::where(['id' => $req -> id]) -> first() -> delete();
        if ($product) {
            return redirect('admin/view_products');
        }
    }

    function editProduct($id){
        $product = Product::find($id);
        if ($product) {
            return view('admin/edit_product', ['products' => $product]);
        }
    }


    function updateProduct(Request $req){
        $updateProducts = [
            'name' => $req->get('name'),
            'desc' => $req->get('desc'),
            'image' => $req->get('image'),
            'price' => $req->get('price'),
            'category_id' => $req->get('category'),
            'image' => 'https://www.seekpng.com/png/detail/869-8693793_-objetos-fondos-libros-comenzar-la-escuela-wood.png',
            'is_active' => $req->get('status'),
            
        ];
        $update_product = Product::where('id', $req -> id) 
                -> update($updateProducts);

        if ($update_product) {
            return redirect('/view_products');
        }
    }

    function addProduct(Request $req){

        $validator = Validator::make($req -> all(), [
            'name' => ['required', 'max:20'],
            'desc' => ['required', 'max:150'],
            'label' => ['required', 'max:20'],
            'image' => ['required', 'max:10240'],
            'price' => ['required'],
            'category' => ['required'],
            'status' => ['required'],
        ],
        [
            'name.required' => 'Name of the item cannot be empty',
            'name.max' => 'Name should not exceed 20 characters',
            'label.required' => 'Name of the label cannot be empty',
            'label.max' => 'Label should not exceed 20 characters',
            'desc.required' => 'Description of the item cannot be empty',
            'desc.max' => 'Description should not exceed 20 characters',
            'price.required' => 'Price cannot be empty',
            'category.required' => 'Please choose a category',
            'status.required' => 'Please choose the status',
            
        ]
    );


        if ($validator->fails()) {
            return redirect('admin/add_product')
                            ->withErrors($validator)->withInput();
                        
        }
        

        $product = new Product;

           // $size = $req -> file('image') -> getSize();
            $name = time().$req -> file('image') -> getClientOriginalName();
            $path = $req -> file('image') -> storeAs('products', $name, 'public');
            $req -> image = '/storage/'.$path;

        $product -> name = $req -> name; 
        $product -> desc = $req -> desc;
        $product -> label = $req -> label;
        $product -> image = $req -> image;
        $product -> price = $req -> price;
        $product -> category_id = $req -> category;
        $product -> is_active = $req -> status;
        $product -> save();

        return redirect('/admin/view_products');
    }

    function updateProductStatus($id, $status){
        if ($status == 1) {
            Product::where('id', $id) -> update(['is_active' => 0]);
        }else{
            Product::where('id', $id) -> update(['is_active' => 1]);
        }

        return redirect('admin/view_products');
    }

    function viewOrders(){
        $orders = orderDetail::all();
        return view('admin/view_orders', ['orders' => $orders]);
    }
    
    function viewOrderDetails(Request $req){
        $order_detail = Order::where('order_no', $req -> id) -> get() -> all();
        return view('admin/view_order_details', ['order_details' => $order_detail]);
    }

    
}


