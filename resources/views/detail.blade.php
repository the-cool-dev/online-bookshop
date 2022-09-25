@extends('master')

@section('content')

<section>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="images p-3">
                                <div class="text-center p-4"> <img id="main-image" src="{{ $detail['image'] }}" width="250" /> </div>
                                {{-- <div class="thumbnail text-center"> <img onclick="change_image(this)" src="{{ $detail['image'] }}" width="70"> <img onclick="change_image(this)" src="{{ $detail['image'] }}" width="70"> </div> --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="/products" class="btn"><div class="d-flex align-items-center"> <i class="fa-solid fa-arrow-left"></i></i> <span class="ms-2">Back</span> </div></a> <i class="fa fa-heart text-muted"></i>
                                </div>
                                <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand">{{ $detail['category_id'] }}</span>
                                    <h5 class="text-uppercase">{{ $detail['name'] }}</h5>
                                    <div class="price d-flex flex-row align-items-center"> <span class="act-price">&#8377; {{ $detail['price'] }}</span>
                                        <div class="ms-2"> <del class="dis-price">&#8377; {{ $detail['price'] }}</del> <span>{{ $detail['discount'] }}% OFF</span> </div>
                                    </div>
                                </div>
                                <p class="about">{{ $detail['desc'] }}</p>
                                
                                <div class="cart mt-4 align-items-center"> 
                                    <form action="/add_to_cart" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value={{ $detail['id'] }}>
                                    <button class="btn btn-danger text-uppercase mr-2 px-4">Add to cart</button> 
                                </form>
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