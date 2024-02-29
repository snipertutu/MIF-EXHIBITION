@extends('layout.master-mhs')

@push('plugin-styles')
@endpush

@section('content')
<div class="row">
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-left">
            <i class="mdi mdi-cube text-danger icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Jumlah seluruh projek</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">1400</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-left">
            <i class="mdi mdi-poll-box text-success icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Jumlah Projek tahun ini</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">140</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-left">
            <i class="mdi mdi-account-box-multiple text-info icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Jumlah User</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">246</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Table Project</h4>
            <button type="button" class="btn btn-success btn-fw" onclick="window.location.href='{{ url('/tables/Project') }}'">
                <i class="mdi mdi-database"></i>Detail
            </button>
        </div>
        <p class="card-description"> Data Project</p>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th> Nama Aplikasi</th>
                <th> Semester</th>
                <th> Angkatan</th>
                <th> Golongan</th>
                <th> Ketua kelompok</th>
                <th> Link Github</th>
                <th> Video Aplikasi</th>
                <th> Gambar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> SIMA</td>
                <td> 1</td>
                <td> 2021</td>
                <td> A</td>
                <td> Nafis</td>
                <td> www.contohaja.com</td>
                <td> misal</td>
                <td> misal</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('plugin-scripts')
<sripct src="{{asset('assets/plugins/chartjs/chart.min.js')}}"></script>
<sripct src="{{asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush