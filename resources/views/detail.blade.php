<?php 

use App\Models\Cart;
use App\Models\Category;
$exist_button_text = "Add to Cart";
$exist = "";
$userId = Session::get('user')['id'];

$cart = new Cart;
$existing_product = Cart::where('product_id', '=', $detail['id'])
                       -> where('user_id', '=', $userId) 
                       -> where('status', '=', 1)
                       -> first();

if ($existing_product){
    $exist = "disabled";
    $exist_button_text = "Added to Cart";
}


?>

@extends('master')

@section('content')

{{-- <link rel="stylesheet" href="{{ asset('css/libs.bundle.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/theme.bundle.css') }}" type="text/css"> --}}

<section>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card-cart">
                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <div class="images p-3">
                                <div class="text-center p-4"> <img id="main-image" class="w-100" src="{{ $detail['image'] }}" /> </div>
                                {{-- <div class="thumbnail text-center"> <img onclick="change_image(this)" src="{{ $detail['image'] }}" width="70"> <img onclick="change_image(this)" src="{{ $detail['image'] }}" width="70"> </div> --}}
                            </div>
                        </div>
                        <div class="col-md-6 m-auto">
                            <div class="product p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    
                                </div>
                                @php
                                $category =  Category::where('id', $detail['category_id']) -> first();  
                                @endphp
                                <div class="mt-4 mb-3"> <span class="font-chart mb-1 f-s-18 mb-5">{{ ucfirst($category['name']) }}</span>
                                    <h5 class="text-uppercase mt-3 font-chart">{{ $detail['name'] }}</h5>
                                    <h6 class="font-chart text-dark flex-2 ms-auto mb-0 ps-0">&#8377; {{ $detail['price'] }}</h6>
                                </div>
                                <p class="about">{{ $detail['desc'] }}</p>
                                
                                <div class="cart mt-4 align-items-center d-flex"> 
                                    <form action="/add_to_cart" class="mb-0" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value={{ $detail['id'] }}>
                                       
                                    <button {{ $exist }} class="btn btn-danger text-uppercase mr-2 px-4">{{$exist_button_text}}</button> 
                                </form>
                                <a href="/products" class="btn btn-primary m-auto">GO BACK</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection