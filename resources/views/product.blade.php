<?php 

use App\Models\Cart;


?>

@extends('master')

@section('content')

<section class="my-5 py-5">
  <div class="container">
    <div class="carousel" data-flickity='{ "groupCells": 1, "wrapAround": true }'>
        @foreach ($datas as $item)
        
        <div class="col-md-4 col-12 col-lg-4 mb-4 mb-md-0 px-2">
          <div class="product-card my-3">
            <div class="d-flex justify-content-between p-3">
              <p class="lead mb-0">Latest arrivals</p>
              <div
                class="d-flex align-items-center justify-content-center"
                style="width: 35px; height: 35px;">
                {{-- <p class="mb-0 small"><i class="fe fe-heart"></i></p> --}}
              </div>
            </div>
            <img src="{{ $item['image'] }}" class="d-block carousel-cell m-auto" style="width: 200px; height: 250px;" alt="...">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <p class="small"><a href="#!" class="text-muted">Non Fiction</a></p>
                {{-- <p class="small text-danger"><s>old price</s></p> --}}
              </div>
  
              <div class="d-flex justify-content-between mb-3">
                <h5 class="mb-0 flex-6">{{ $item['name'] }}</h5>
                
              </div>
              
              <div class="d-flex justify-content-between mb-2">
                {{-- <p class="text-muted mb-0"><span class="fw-bold">In Stock</span></p> --}}
                <h6 class="text-dark flex-2 ms-auto mb-0 ps-0">&#8377; {{ $item['price'] }}</h6>
                
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
                  <button {{ $exist }} class="product-cart my-auto ms-auto"><i class="fe fe-shopping-cart"></i></button> 
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