@extends('master')

@section('content')

<section class="m-auto custom-login">
    <div class="container">
      <div class="row">
        @error('invalid')
          <div class="col-md-6 m-auto">
            <div class="alert alert-danger" role="alert">
              {{ $errors->first('invalid') }}
            </div> 
          </div>
          @enderror
      </div>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="/login" method="POST">
                    @csrf
  
                    <div class="row mb-3">
                        <h3>Sign in</h3>
                      </div>
                     
                    <div class="row mb-3">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="inputEmail3">
                        @error('email')
                          <span class="text-danger" role="alert">
                            {{ $errors->first('email') }}
                          </span> 
                        @enderror
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="inputPassword3">
                        @error('password')
                          <span class="text-danger" role="alert">
                            {{ $errors->first('password') }}
                          </span> 
                        @enderror
                      </div>
                    </div>
                
                    <div class="row mb-3">
                      <div class="col-sm-10 offset-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck1">
                          <label class="form-check-label" for="gridCheck1">
                            Remember me
                          </label>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-center mx-auto">Login</button>
                  </form>
                
            </div>
        </div>
    </div>
</section>


@endsection