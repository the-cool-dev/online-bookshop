<?php 

use App\Http\Controllers\ProductController;

$total = 0;

if (Session::has('user')) {
  $total = ProductController::cartItem();
}


?>

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Orders</a>
          </li>
          
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link">Cart({{$total}})</a>
            </li>
          </ul>
        <form class="d-flex" role="search" method="POST" action="/search">
          @csrf
          <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <ul class="navbar-nav  mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Welcome back {{Session::get('user')['user_name']}} !!!
          </a>
          <ul class="dropdown-menu">
            @if (Session::has('user'))
            <li><a class="dropdown-item" href="/logout">Logout</a></li>
            @else
            <li><a class="dropdown-item" href="/login">Login</a></li>
            @endif
          </ul>
        </li>
        </ul>
      </div>
    </div>
  </nav>