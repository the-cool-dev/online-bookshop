<?php 

use App\Models\Cart;
use App\Models\Category;


?>

@extends('master')

@section('content')

<section>
  <img src="{{asset('images/banners/about-banner.png')}}" class="w-100" alt="">
</section>

<section class="my-5 py-5">
  
  <div class="container">
    <div class="row">
      <div class="col-md-5 mx-auto">
        <h2 class="ribbon text-center my-10">
          <a class="ribbon-content">Our Collections</a>
        </h2>
      </div>
    <div class="row">
        @foreach ($datas as $item)
        
        <div class="col-md-3 col-12 col-lg-3 mb-4 mb-md-0 px-2 mx-5 my-3">
          <div class="product-card my-3">
            <div class="d-flex justify-content-between pb-3">
              {{-- <p class="font-chart badge bg-maroon mb-0">{{ $item['label'] }}</p> --}}
              <div
                class="d-flex align-items-center justify-content-center"
              >
                {{-- <p class="mb-0 small"><i class="fe fe-heart"></i></p> --}}
              </div>
            </div>
            <div>
            <img style="background-image: url('images/frame.png'); background-size: contain;" src="{{ $item['image'] }}" class="d-block carousel-cell m-auto w-100" alt="...">
          </div>
            <div class="card-body ps-0">
              <div class="d-flex justify-content-between align-items-center">
                @php
                  $category =  Category::where('id', $item['category_id']) -> first();  
                @endphp
                <p class="font-chart mb-1 f-s-18"><a href="{{route('product_list', ['id' => $item['category_id']])}}" class="text-black">{{  ucfirst($category['name']) }}</a></p>
                {{-- <p class="small text-danger"><s>old price</s></p> --}}
              </div>
  
              <div class="d-flex justify-content-between mb-3">
                <h5 class="mb-0 flex-6">{{ ucfirst(Str::limit($item['name'], 15)) }}</h5>
                
              </div>
              
              <div class="d-flex justify-content-between mb-2">
                {{-- <p class="text-muted mb-0"><span class="fw-bold">In Stock</span></p> --}}
                <h6 class="font-chart text-dark flex-2 ms-auto mb-0 ps-0">&#8377; {{ $item['price'] }}</h6>
                
              </div>
              <div class="d-flex justify-content-between">
              <a href="{{route('product_detail', ['id' => $item['id']])}}" class="btn btn-primary mt-3">View Details</a>
              <form action="/add_to_cart" class="my-auto" method="POST">
                @csrf
                <input type="hidden" name="product_id" value={{ $item['id'] }}>
                
                <?php  
                  $exist = "";
                  $userId = Session::get('user')['id'];

                  $cart = new Cart;
                  $existing_product = Cart::where('product_id', '=', $item['id'])
                                        -> where('user_id', '=', $userId) 
                                        -> where('status', '=', 1)
                                        -> first();

                  if ($existing_product){
                      $exist = "disabled";
                  }
                ?>
                  <button {{ $exist }} class="product-cart my-auto ms-auto"><i class="fe fe-shopping-bag color-primary"></i></button> 
              </form>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  
    <style>
      .color-gold{
        color: gold;
      }
    </style>
    
  </section>

@endsection