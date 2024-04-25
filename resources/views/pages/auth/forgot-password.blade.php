@extends('layout.master-mini')

@section('content')

<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/images/auth/login_1.jpg') }}); background-size: cover;">
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
      </div>
      <ul class="auth-footer">
        <li>
          <a href="{{ route('login') }}">Login</a>
        </li>
      </ul>
      <p class="footer-text text-center">Copyright © 2018 Bootstrapdash. All rights reserved.</p>
    </div>
  </div>
</div>

@endsection
