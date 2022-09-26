<?php 

use App\Http\Controllers\ProductController;
use App\Models\Category;

$categories = Category::all();
$cart_items = ProductController::cartList();

$total = 0;

if (Session::has('user')) {
  $total = ProductController::cartItem();
}


?>

<nav class="navbar navbar-expand-lg navbar-light bg-white">
      <div class="container">
    
        <!-- Brand -->
        <a class="navbar-brand" href="/">
          E-books
        </a>
    
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
    
          <!-- Nav -->
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/about">About Us</a>
            </li>
            <li class="nav-item dropdown">
    
              <!-- Toggle -->
              <a class="nav-link" data-bs-toggle="dropdown" href="#">Book Categories</a>
    
              <!-- Menu -->
              <div class="dropdown-menu">
                <div class="card card-lg">
                  <div class="card-body">
                    <ul class="list-styled fs-sm">
                      @foreach ($categories as $item)
                  
                      <li class="list-styled-item">
                        <a class="list-styled-link" href="index-2.html">{{ $item['name'] }}</a>
                      </li>

                      @endforeach
                      
                    </ul>
                  </div>
                </div>
              </div>
    
            </li>
            <li class="nav-item">
              <a class="nav-link" href="docs/getting-started.html">Contact Us</a>
            </li>
            <li class="nav-item dropdown">
    
              <!-- Toggle -->
              <a class="nav-link" data-bs-toggle="dropdown" href="#">Account</a>
    
              <!-- Menu -->
              <div class="dropdown-menu">
                <div class="card card-lg">
                  <div class="card-body">
                    <ul class="list-styled fs-sm">
                      
                  
                     
                      @if (Session::has('user'))
                      <li class="list-styled-item">
                        <a class="list-styled-link" href="/logout">Logout</a>
                      </li>
                      @else
                      <li class="list-styled-item">
                        <a class="list-styled-link" href="/register">Register</a>
                      </li>
                      <li class="list-styled-item">
                        <a class="list-styled-link" href="/login">Sign In</a>
                      </li>
                      @endif
                    </ul>
                  </div>
                </div>
              </div>
    
            </li>
            

            

            
           
         
          
            
          </ul>
    
          <!-- Nav -->
          <ul class="navbar-nav flex-row">
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="offcanvas" href="#modalSearch">
                <i class="fe fe-search"></i>
              </a>
            </li>
            <li class="nav-item ms-lg-n4">
              <a class="nav-link" href="account-orders.html">
                <i class="fe fe-user"></i>
              </a>
            </li>
            <li class="nav-item ms-lg-n4">
              <a class="nav-link" href="account-wishlist.html">
                <i class="fe fe-heart"></i>
              </a>
            </li>
            <li class="nav-item ms-lg-n4">
              <a class="nav-link" data-bs-toggle="offcanvas" href="#modalShoppingCart">
                <span data-cart-items="{{$total}}">
                  <i class="fe fe-shopping-cart"></i>
                </span>
              </a>
            </li>
          </ul>
    
        </div>
    
      </div>
    </nav>


    <div class="offcanvas offcanvas-end" id="modalSearch" tabindex="-1" role="dialog" aria-hidden="true">
    
      <!-- Close -->
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
        <i class="fe fe-x" aria-hidden="true"></i>
      </button>
    
      <!-- Header-->
      <div class="offcanvas-header lh-fixed fs-lg">
        <strong class="mx-auto">Search Products</strong>
      </div>
    
      <!-- Body: Form -->
      <div class="offcanvas-body">
        <form method="POST" action="/search">
          @csrf
          <div class="input-group input-group-merge">
            <input class="form-control" type="search" name="search" placeholder="Search">
            <div class="input-group-append">
              <button class="btn btn-outline-border" type="submit">
                <i class="fe fe-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    
    
      <!-- Body: Empty (remove `.d-none` to enable it) -->
      <div class="offcanvas-body d-none">
    
        <!-- Text -->
        <p class="mb-3 fs-sm text-center">
          Nothing matches your search
        </p>
    
        <!-- Smiley -->
        <p class="mb-0 fs-sm text-center">
          😞
        </p>
    
      </div>
    
    </div>

    <div class="offcanvas offcanvas-end" id="modalShoppingCart" tabindex="-1" role="dialog" aria-hidden="true">
    
      <!-- Full cart (add `.d-none` to disable it) -->
    
      <!-- Close -->
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
        <i class="fe fe-x" aria-hidden="true"></i>
      </button>
    
      <!-- Header-->
      <div class="offcanvas-header lh-fixed fs-lg">
        <strong class="mx-auto">Your Cart ({{$total}})</strong>
      </div>
    
      @if ($total > 0)

      <!-- List group -->
      <ul class="list-group list-group-lg list-group-flush">
        @foreach ($cart_items as $item)

        <li class="list-group-item">
          <div class="row align-items-center">
            <div class="col-4">
    
              <!-- Image -->
              <a href="product.html">
                <img class="img-fluid" src="{{ $item -> image }}" alt="...">
              </a>
    
            </div>
            <div class="col-8">
    
              <!-- Title -->
              <p class="fs-sm fw-bold mb-6">
                <a class="text-body" href="product.html">{{ $item -> name }}</a> <br>
                <span class="text-muted">&#8377; {{ $item -> price }}</span>
              </p>
    
              <!--Footer -->
              <div class="d-flex align-items-center">
  
    
                <!-- Remove -->
                <a class="fs-s text-gray-400\" href="/movetocart/{{ $item -> cart_id }}">
                  <i class="fe fe-trash"></i> Remove
                </a>
    
              </div>
    
            </div>
          </div>
        </li>
        @endforeach

      </ul>
    
      <!-- Footer -->
      <div class="offcanvas-footer justify-between lh-fixed fs-sm bg-light mt-auto">
        <strong>Subtotal</strong> <strong class="ms-auto">$89.00</strong>
      </div>
    
      <!-- Buttons -->
      <div class="offcanvas-body">
        <a class="btn w-100 btn-dark" href="checkout.html">Continue to Checkout</a>
        <a class="btn w-100 btn-outline-dark mt-2" href="/cartlist">View Cart</a>
      </div>

          
      @else

      <div>
        <div class="d-block">
    
          <!-- Close -->
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fe fe-x" aria-hidden="true"></i>
          </button>
      
          <!-- Body -->
          <div class="offcanvas-body flex-grow-0 my-auto">
      
            <!-- Heading -->
            <h6 class="mb-7 text-center">Your cart is empty 😞</h6>
      
            <!-- Button -->
            <a class="btn w-100 btn-outline-dark" href="/">
              Continue Shopping
            </a>
      
          </div>
      
        </div>
      
      </div>
          
      @endif
      <!-- Empty cart (remove `.d-none` to enable it) -->
     
    </div>
    