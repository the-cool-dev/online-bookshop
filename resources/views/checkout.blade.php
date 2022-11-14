<?php 

use App\Http\Controllers\ProductController;

$total_items = 0;

if (Session::has('user')) {
  $total_items = ProductController::cartItem();
}


?>


@extends('master')

@section('content')

<section>
  <img src="{{asset('images/banners/about-banner.png')}}" class="w-100" alt="">
</section>

<section class="pt-7 pb-12">
    
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">

          <!-- Heading -->
          <h3 class="mb-4">Checkout</h3>

        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-7">

          <!-- Form -->
          
            

            <!-- Heading -->
            <h6 class="mb-7">Billing Details</h6>
            <form method="POST" action="/placeorder" class="mb-10">
                @csrf
            <!-- Billing details -->
            <div class="row mb-9">
              <div class="col-12 col-md-6">

                <!-- First Name -->
                <div class="form-group">
                  <label class="form-label" for="checkoutBillingFirstName">First Name *</label>
                  <input class="form-control form-control-sm" name="first_name" id="checkoutBillingFirstName" type="text" placeholder="First Name" required>
                </div>

              </div>
              <div class="col-12 col-md-6">

                <!-- Last Name -->
                <div class="form-group">
                  <label class="form-label" for="checkoutBillingLastName">Last Name *</label>
                  <input name="last_name" class="form-control form-control-sm" id="checkoutBillingLastName" type="text" placeholder="Last Name" required>
                </div>

              </div>
              <div class="col-12">

                <!-- Email -->
                <div class="form-group">
                  <label class="form-label" for="checkoutBillingEmail">Email *</label>
                  <input name="email" class="form-control form-control-sm" id="checkoutBillingEmail" type="email" placeholder="Email" required>
                </div>

              </div>
              <div class="col-12">

                <!-- Mobile Phone -->
                <div class="form-group">
                  <label class="form-label" for="checkoutBillingPhone">Mobile Phone *</label>
                  <input name="mobile" class="form-control form-control-sm" id="checkoutBillingPhone" type="tel" placeholder="Mobile Phone" required>
                </div>

              </div>
              <div class="col-12">

                <!-- Country -->
                <div class="form-group">
                  <label class="form-label" for="checkoutBillingCountry">Country *</label>
                  <input name="country" class="form-control form-control-sm" id="checkoutBillingCountry" type="text" placeholder="Country" required>
                </div>

              </div>
              <div class="col-12">

                <!-- Address Line 1 -->
                <div class="form-group">
                  <label class="form-label" for="checkoutBillingAddress">Address *</label>
                  <input name="address" class="form-control form-control-sm" id="checkoutBillingAddress" type="text" placeholder="Address Line 1" required>
                </div>

              </div>
              <div class="col-12 col-md-6">

                <!-- Town / City -->
                <div class="form-group">
                  <label class="form-label" for="checkoutBillingTown">State</label>
                  <input name="state" class="form-control form-control-sm" id="checkoutBillingTown" type="text" placeholder="State" required>
                </div>

              </div>
              <div class="col-12 col-md-6">

                <!-- ZIP / Postcode -->
                <div class="form-group">
                  <label class="form-label" for="checkoutBillingZIP">ZIP / Postcode *</label>
                  <input name="pincode" class="form-control form-control-sm" id="checkoutBillingZIP" type="text" placeholder="ZIP / Postcode" required>
                </div>

              </div>
              <input type="hidden" name="total" value="{{ $total + 8.00 }}">
            </div>
            <button class="btn btn-danger text-uppercase mr-2 px-4">Place Order</button>
        </form>

            <!-- Heading -->
            <h6 class="mb-7">Payment</h6>

            <!-- List group -->
            <ul class="list-group list-group-flush-x mb-9" id="faqCollapseParentOne">
                <li class="list-group-item">
  
                  <!-- Toggle -->
                  <a class="dropdown-toggle d-block fs-lg fw-bold text-reset" data-bs-toggle="collapse" href="#faqCollapseOne">
                    <label class="form-check-label text-body text-nowrap" for="checkoutPaymentCard">
                        Credit Card <img class="ms-2" src="{{ asset('images/payment/cards.svg') }}" alt="...">
                      </label>
                  </a>
  
                  <!-- Collapse -->
                  <div class="collapse" id="faqCollapseOne" data-bs-parent="#faqCollapseParentOne">
                    <div class="mt-5">
                        <div class="row gx-5 py-5">
                            <div class="col-12">
                              <div class="form-group mb-4">
                                <label class="visually-hidden" for="checkoutPaymentCardNumber">Card Number</label>
                                <input class="form-control form-control-sm" id="checkoutPaymentCardNumber" type="text" placeholder="Card Number *" required>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-group mb-4">
                                <label class="visually-hidden" for="checkoutPaymentCardName">Name on Card</label>
                                <input class="form-control form-control-sm" id="checkoutPaymentCardName" type="text" placeholder="Name on Card *" required>
                              </div>
                            </div>
                            <div class="col-12 col-md-4">
                              <div class="form-group mb-md-0">
                                <label class="visually-hidden" for="checkoutPaymentMonth">Month</label>
                                <select class="form-select form-select-sm" id="checkoutPaymentMonth">
                                  <option>January</option>
                                  <option>February</option>
                                  <option>March</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-12 col-md-4">
                              <div class="form-group mb-md-0">
                                <label class="visually-hidden" for="checkoutPaymentCardYear">Year</label>
                                <select class="form-select form-select-sm" id="checkoutPaymentCardYear">
                                  <option>2017</option>
                                  <option>2018</option>
                                  <option>2019</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-12 col-md-4">
                              <div class="input-group input-group-merge">
                                <input class="form-control form-control-sm" id="checkoutPaymentCardCVV" type="text" placeholder="CVV *" required>
                                <div class="input-group-append">
                                  <span class="input-group-text" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover" data-bs-content="The CVV Number on your credit card or debit card is a 3 digit number on VISA, MasterCard and Discover branded credit and debit cards.">
                                    <span><i class="fe fe-help-circle"></i></span>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                  </div>
  
                </li>
                <li class="list-group-item">
  
                  <!-- Toggle -->
                  <a class="dropdown-toggle d-block fs-lg fw-bold text-reset" data-bs-toggle="collapse" href="#faqCollapseTwo">
                    <label class="form-check-label text-body text-nowrap" for="checkoutPaymentCard">
                        UPI <img class="ms-2" src="{{ asset('images/payment/google-pay.svg') }}" alt="..."><img class="ms-2" src="{{ asset('images/payment/phonepe-logo-icon.svg') }}" alt="...">
                      </label>
                  </a>
  
                  <!-- Collapse -->
                  <div class="collapse" id="faqCollapseTwo" data-bs-parent="#faqCollapseParentOne">
                    <div class="mt-5">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="upi" id="gpay" value="1">
                            <label class="form-check-label" for="inlineRadio1">Gpay</label>
                          </div>
                          
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="upi" id="phonepe" value="1">
                            <label class="form-check-label" for="inlineRadio2">Phonepe</label>
                          </div>
                    </div>
                  </div>
  
                </li>
                {{-- <li class="list-group-item">
  
                  <!-- Toggle -->
                  <a class="dropdown-toggle d-block fs-lg fw-bold text-reset" data-bs-toggle="collapse" href="#faqCollapseThree">
                    3. Waters one you'll creeping?
                  </a>
  
                  <!-- Collapse -->
                  <div class="collapse" id="faqCollapseThree" data-bs-parent="#faqCollapseParentOne">
                    <div class="mt-5">
                      <p class="mb-0 fs-lg text-gray-500">
                        Saw wherein fruitful good days image them, midst, waters upon, saw. Seas lights seasons. Fourth
                        hath rule creepeth own lesser years itself so seed fifth for grass.
                      </p>
                    </div>
                  </div>
  
                </li> --}}
             
              </ul>
          

        </div>
        <div class="col-12 col-md-5 col-lg-4 offset-lg-1">

          <!-- Heading -->
          <h6 class="mb-7 font-chart">Order Items ({{$total_items}})</h6>

          <!-- Divider -->
          <hr class="my-7">

          <!-- List group -->
          <ul class="list-group list-group-lg list-group-flush-y list-group-flush-x mb-7">

            @foreach ($products as $product)

            <li class="list-group-item">
              <div class="row align-items-center">
                <div class="col-4">

                  <!-- Image -->
                  <a href="#!">
                    <img src="{{ $product -> image }}" alt="..." class="img-fluid">
                  </a>

                </div>
                <div class="col">

                  <!-- Title -->
                  <p class="mb-4 f-s-22 fw-bold">
                    <a class="text-body" href="#!">{{ $product -> name }}</a> <br>
                    <span class="color-primary mt-2">&#8377; {{ $product -> price }}</span>
                  </p>

                </div>
              </div>
            </li>
            @endforeach
          </ul>

          <!-- Card -->
          <div class="mb-9">
            <div class="card-body">
              <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                <li class="list-group-item d-flex font-chart">
                  <span>Subtotal</span> <span class="ms-auto f-s-22">&#8377; {{ $total }}</span>
                </li>
                <li class="list-group-item d-flex font-chart">
                  <span>Tax</span> <span class="ms-auto f-s-22 font-chart">&#8377; 8.00</span>
                </li>
                <li class="list-group-item d-flex fs-lg fw-bold font-chart f-s-22">
                  <span>Total</span> <span class="ms-auto">&#8377; {{ $total + 8.00 }}</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- Disclaimer -->
          <p class="mb-7 fs-xs text-gray-500">
            Your personal data will be used to process your order, support
            your experience throughout this website, and for other purposes
            described in our privacy policy.
          </p>

          <!-- Button -->
          
        
        </div>
      </div>
    </div>

  </section>

 

@endsection