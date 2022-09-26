@extends('master')

@section('content')
<section class="my-5">
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <table class="table table-striped">
                  <tbody>
                    <tr>
                      <th scope="row"> Total Amount</th>
                      <td>&#8377; {{ $total }}</td>
                    </tr>
                    <tr>
                      <th scope="row">Tax</th>
                      <td>&#8377; 0</td>
                    </tr>
                    <tr>
                      <th scope="row">Other Charges</th>
                      <td>&#8377; 10</td>
                    </tr>
                    <tr>
                        <th scope="row">Total</th>
                        <td>&#8377; {{ $total+10 }}</td>
                      </tr>
                  </tbody>
              </table>
        </div>
    </div>
</div>
</section>

<section>
    <div class="container">
        <div class="row">
        
            <div class="col-md-6 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" method="POST" action="/placeorder" novalidate="">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="" required="" name="first_name">
                            <div class="invalid-feedback"> Valid first name is required. </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="" required="" name="last_name">
                            <div class="invalid-feedback"> Valid last name is required. </div>
                        </div>
                    </div>
                   
                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="email">Mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile number"> 
                    </div>
                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="1234 Main St" required="">
                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100 form-control" name="country" id="country" required="">
                                <option value="">Choose...</option>
                                <option value="india">India</option>
                                <option value="us">United States</option>
                            </select>
                            
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <select class="custom-select d-block w-100 form-control" name="state" id="state" required="">
                                <option value="">Choose...</option>
                                <option value="tamilnadu">Tamilnadu</option>
                                <option value="kerala">Kerala</option>
                            </select>
                            
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Pincode</label>
                            <input type="text" name="pincode" class="form-control" id="zip" placeholder="" required="">
                            
                        </div>
                    </div>
                    <hr class="mb-4">
                    
                    
                    <h4 class="mb-3">Payment</h4>
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="payment" value="card" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                            <label class="custom-control-label" for="credit">Credit/Debit card</label>
                        </div>
                        {{-- <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                            <label class="custom-control-label" for="paypal">PayPal</label>
                        </div> --}}
                        <div class="custom-control custom-radio">
                            <input id="paypal" name="payment" value="upi" type="radio" class="custom-control-input" required="">
                            <label class="custom-control-label" for="paypal">UPI</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cc-name">Name on card</label>
                            <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback"> Name on card is required </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cc-number">Credit card number</label>
                            <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                            <div class="invalid-feedback"> Credit card number is required </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiration</label>
                            <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                            <div class="invalid-feedback"> Expiration date required </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cc-cvv">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                            <div class="invalid-feedback"> Security code required </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>
       
    </div>
</section>
@endsection