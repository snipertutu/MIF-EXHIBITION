@extends('layout.master-mini')

@section('content')
<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/img/TI2.jpg') }}); background-size: cover;">
  <div class="row w-100">
    <div class="col-lg-4 mx-auto">
      <h2 class="text-center mb-4">Register</h2>
      <div class="auto-form-wrapper">
        <form action="{{ route('register') }}" method="POST">
          @csrf
          <div class="form-group">
            <div class="input-group">
              <input type="text" id="nim" name="nim" class="form-control" placeholder="NIM" value="{{ old('nim') }}">
              <div class="input-group-append">
                  <span class="input-group-text">
                      <i class="mdi mdi-numeric"></i>
                  </span>
              </div>
            </div>
            @error('nim')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
              <div class="input-group-append">
                  <span class="input-group-text">
                      <i class="mdi mdi-email"></i>
                  </span>
              </div>
            </div>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="password" id="password" name="password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-lock"></i>
                </span>
              </div>
            </div>
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-lock"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group d-flex justify-content-center">
            <div class="form-check form-check-flat mt-0">
              <input type="checkbox" class="form-check-input" id="agree_terms" name="agree_terms" required>
              <label class="form-check-label" for="agree_terms">I agree to the terms</label>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary submit-btn btn-block">Register</button>  
          </div>
          <div class="text-block text-center my-3">
            <span class="text-small font-weight-semibold">Already have and account ?</span>
            <a href="{{ route('login') }}" class="text-black text-small">Login</a>
          </div>
        </form>
      </div>
      <div class="footer-legal text-center position-relative">
            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong><span>MIF PROJECT</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    Designed by MIF POLIJE
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
