@extends('master')

@section('content')

<section class="pt-7 pb-12">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">

        <!-- Heading -->
        <h3 class="mb-10">Sign Up</h3>

      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-9 col-lg-8 offset-lg-1">

        <!-- Form -->
        <form method="POST" action="register">
          @csrf
          
          <div class="row">
            <div class="col-12 col-md-6">

              <!-- Email -->
              <div class="form-group">
                <label class="form-label" for="accountFirstName">
                  First Name *
                </label>
                <input class="form-control form-control-sm" name="first_name" id="accountFirstName" type="text" placeholder="First Name *" value="{{ old('first_name') }}" >
                @error('first_name')
                <span class="text-danger" role="alert">
                  {{ $errors->first('first_name') }}
                </span> 
                @enderror
              </div>

            </div>
            <div class="col-12 col-md-6">

              <!-- Email -->
              <div class="form-group">
                <label class="form-label" for="accountLastName">
                  Last Name *
                </label>
                <input class="form-control form-control-sm" name="last_name" id="accountLastName" type="text" placeholder="Last Name *" value="{{ old('last_name') }}" >
                @error('last_name')
                <span class="text-danger" role="alert">
                  {{ $errors->first('last_name') }}
                </span> 
                @enderror
              </div>

            </div>
            <div class="col-12 col-md-6">

              <!-- Email -->
              <div class="form-group">
                <label class="form-label" for="accountEmail">
                  User Name *
                </label>
                <input class="form-control form-control-sm" name="user_name" id="accountEmail" type="text" placeholder="Email Address *" value="{{ old('user_name') }}" >
                @error('user_name')
                <span class="text-danger" role="alert">
                  {{ $errors->first('user_name') }}
                </span> 
                @enderror
              </div>

            </div>
            <div class="col-12 col-md-6">

              <!-- Email -->
              <div class="form-group">
                <label class="form-label" for="accountEmail">
                  Email Address *
                </label>
                <input class="form-control form-control-sm" name="email" id="accountEmail" type="email" placeholder="Email Address *" value="{{ old('email') }}" >
                @error('email')
                <span class="text-danger" role="alert">
                  {{ $errors->first('email') }}
                </span> 
                @enderror
              </div>

            </div>
            <div class="col-12 col-md-6">

              <!-- Password -->
              <div class="form-group">
                <label class="form-label" for="accountPassword">
                  Password *
                </label>
                <input class="form-control form-control-sm" id="accountPassword" type="password" placeholder="Password *" name="password" >
                @error('password')
                <span class="text-danger" role="alert">
                  {{ $errors->first('password') }}
                </span> 
                @enderror
              </div>

            </div>
            <div class="col-12 col-md-6">

              <!-- Password -->
              <div class="form-group">
                <label class="form-label" for="AccountNewPassword">
                  Confirm Password *
                </label>
                <input class="form-control form-control-sm" id="AccountNewPassword" type="password" placeholder="Confirm Password *" name="password_confirmation" >
                @error('password_confirmation')
                <span class="text-danger" role="alert">
                  {{ $errors->first('password_confirmation') }}
                </span> 
                @enderror
              </div>

            </div>

            <div class="col-12">

              <!-- Button -->
              <button class="btn btn-dark" type="submit">Sign Up</button>

            </div>
          </div>
        </form>
{{-- 
        @if ($errors->any())
            <div>
              @foreach ($errors->all() as $err)
                  <li>
                    {{$err}}
                  </li>
              @endforeach
            </div>
        @else
            <div>
              No errors
            </div>
        @endif --}}

      </div>
    </div>
  </div>
</section>


  @endsection