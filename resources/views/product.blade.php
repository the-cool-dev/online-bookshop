@extends('master')

@section('content')
<section>
<div class="custom-product">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            @foreach ($sliders as $item)
          <div class="carousel-item {{ $item['id'] == 3 ? 'active' : '' }}">
            <img src="{{ $item['image'] }}" class="d-block w-100" alt="...">
          </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
</div>
</section>

<section class="my-5 py-5">
  <div class="container">
    <div class="carousel" data-flickity='{ "groupCells": 1, "wrapAround": true }'>
        @foreach ($datas as $item)
        
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
    </div>
    
    
  </section>

@endsection