@extends('master')

@section('content')

<section>
  <img src="{{asset('images/banners/about-banner.png')}}" class="w-100" alt="">
</section>

<section>
    <div class="container">
      @if (count($products) <= 0)
              <h3 class="text-center mt-6">Sorry No Books to Display</h3>
            
            @else
        <div class="row">

            @foreach ($products as $item)
                
            <div class="col-md-4 col-12 col-lg-4 mb-4 mb-md-0 px-2">
                <div class="card">
                  <div class="d-flex justify-content-between p-3">
                    <p class="lead mb-0">Latest arrivals</p>
                    <div
                      class="bg-info rounded-circle d-flex align-items-center justify-content-center shadow-1-strong"
                      style="width: 35px; height: 35px;">
                      <p class="text-white mb-0 small">x2</p>
                    </div>
                  </div>
                  <img src="{{ $item['image'] }}" class="d-block carousel-cell m-auto" style="width: 200px; height: 250px;" alt="...">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <p class="small"><a href="#!" class="text-muted">Non Fiction</a></p>
                      <p class="small text-danger"><s>old price</s></p>
                    </div>
        
                    <div class="d-flex justify-content-between mb-3">
                      <h5 class="mb-0">{{ $item['name'] }}</h5>
                      <h5 class="text-dark mb-0">&#8377; {{ $item['price'] }}</h5>
                    </div>
        
                    <div class="d-flex justify-content-between mb-2">
                      <p class="text-muted mb-0"><span class="fw-bold">In Stock</span></p>
                      <div class="ms-auto text-warning">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                      
                    </div>
                    <a href="detail/{{ $item['id'] }}" class="btn btn-primary mt-3">View Details</a>
                  </div>
                </div>
              </div>

              @endforeach
              
        </div>
        @endif
    </div>
</section>
    
@endsection