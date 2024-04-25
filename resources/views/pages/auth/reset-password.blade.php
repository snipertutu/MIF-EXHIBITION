@extends('layout.master-mini')

@section('content')

<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/images/auth/login_1.jpg') }}); background-size: cover;">
  <div class="row w-100">
    <div class="col-lg-4 mx-auto">
      <div class="auto-form-wrapper">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input id="email" type="hidden" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            <div class="form-group">
                <label class="label" for="password">Password</label>
                <div class="input-group">
                    <input class="form-control" id="password" type="password" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="label" for="password_confirmation">Confirm Password</label>
                <div class="input-group">
                    <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary submit-btn btn-block">Reset Password</button>
            </div>
        </form>

        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
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
