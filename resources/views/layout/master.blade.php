<!DOCTYPE html>
<html>
<head>
  <title>MIF EXIBITION</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  
  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

  <!-- plugin css -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/@mdi/font/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}">
  <!-- end plugin css -->
  @stack('plugin-styles')
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">

  <!-- common css -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- end common css -->

  @stack('style')
</head>
<body data-base-url="{{url('/')}}">

  <div class="container-scroller" id="app">
    @include('layout.header')
    <div class="container-fluid page-body-wrapper">
      @include('layout.sidebar')
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
        @include('layout.footer')
      </div>
    </div>
  </div>

  <!-- base js -->
  <script src="{{ asset('js/app.js')}}"></script>
  <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
  <!-- end base js -->

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
  <!-- plugin js -->
  @stack('plugin-scripts')
  <!-- end plugin js -->

  <!-- common js -->
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{ asset('assets/js/misc.js')}}"></script>
  <script src="{{ asset('assets/js/settings.js')}}"></script>
  <script src="{{ asset('assets/js/todolist.js')}}"></script>
  <!-- end common js -->
  @stack('custom-scripts')
</body>
</html>