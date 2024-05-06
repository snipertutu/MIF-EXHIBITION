@extends('layout.master-mini')

@section('content')

<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/img/TI2.jpg') }}); background-size: cover;">
  <div class="row w-100">
    <div class="col-lg-4 mx-auto">
      <div class="auto-form-wrapper">
        <form action="{{ route('forgot-password.email') }}" method="POST">
          @csrf
          <div class="form-group">
            <label class="label">Email</label>
            <div class="input-group">
              <input type="email" class="form-control" name="email" placeholder="Enter your email">
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary submit-btn btn-block">Send Reset Link</button>
          </div>
        </form>
        <div class="text-block text-center my-3">
          <a href="{{ route('login') }}" class="text-black text-small">Login</a>
        </div>
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
