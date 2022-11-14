@extends('master')

<?php 

use App\Http\Controllers\ProductController;

$cart_items = ProductController::cartList();

$total = 0;

if (Session::has('user')) {
  $total = ProductController::cartItem();
  $total_amount = ProductController::checkOut();
}


?>


@section('content')

<section>
  <img src="{{asset('images/banners/about-banner.png')}}" class="w-100" alt="">
</section>

<!-- CONTENT -->
<section class="pt-7 pb-12">
  <div class="container">
    <div class="row">
      <div class="col-12">

        <!-- Heading -->
        <h3 class="mb-10 text-center">Shopping Cart</h3>

      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-7">

        <!-- List group -->
        <ul class="list-group list-group-lg list-group-flush-x mb-6">
         
          @foreach ($cart_items as $item)

          <li class="list-group-item">
            <div class="row align-items-center">
              <div class="col-3">

                <!-- Image -->
                <a href="product.html">
                  <img src="{{ $item -> image }}" alt="..." class="img-fluid">
                </a>

              </div>
              <div class="col">

                <!-- Title -->
                <div class="d-flex mb-2 fw-bold">
                  <a class="text-body" href="product.html">{{ $item -> name }}</a> <span class="ms-auto">&#8377; {{ $item -> price }}</span>
                </div>

                <!--Footer -->
                <div class="d-flex align-items-center">

                  <!-- Remove -->
                  <a class="fs-s text-gray-400\" href="/movetocart/{{ $item -> cart_id }}">
                    <i class="fe f-s-22 fe-trash"></i> Remove
                  </a>

                </div>

              </div>
            </div>
          </li>
          @endforeach
        </ul>

        <!-- Footer -->
        <div class="row align-items-end justify-content-between mb-10 mb-md-0">
          <div class="col-12 col-md-7">

            <!-- Coupon -->
            {{-- <form class="mb-7 mb-md-0">
              <label class="form-label fs-sm fw-bold" for="cartCouponCode">
                Coupon code:
              </label>
              <div class="row row gx-5">
                <div class="col">

                  <!-- Input -->
                  <input class="form-control form-control-sm" id="cartCouponCode" type="text" placeholder="Enter coupon code*">

                </div>
                <div class="col-auto">

                  <!-- Button -->
                  <button class="btn btn-sm btn-dark" type="submit">
                    Apply
                  </button>

                </div>
              </div>
            </form> --}}

          </div>
          {{-- <div class="col-12 col-md-auto">

            <!-- Button -->
            <button class="btn btn-sm btn-outline-dark">Update Cart</button>

          </div> --}}
        </div>

      </div>
      <div class="col-12 col-md-5 col-lg-4 offset-lg-1">

        <!-- Total -->
        <div class="mb-7">
          <div class="card-body">
            <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
              <li class="list-group-item d-flex">
                <span>Subtotal</span> <span class="ms-auto fs-sm">{{$total_amount['total']}}</span>
              </li>
              <li class="list-group-item d-flex">
                <span>Tax</span> <span class="ms-auto fs-sm">&#8377; 8.00</span>
              </li>
              <li class="list-group-item d-flex fs-lg fw-bold">
                <span>Total</span> <span class="ms-auto fs-sm">{{$total_amount['total'] + 8.00}}</span>
              </li>
              
            </ul>
          </div>
        </div>

        <!-- Button -->
        <a class="btn w-100 btn-primary mb-2" href="/checkout">Proceed to Checkout</a>

        <!-- Link -->
        <a class="btn btn-link btn-sm px-0 text-body" href="/">
          <i class="fe fe-arrow-left me-2"></i> Continue Shopping
        </a>

      </div>
    </div>
  </div>
</section>

@endsection