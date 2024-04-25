@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
<!-- Tampilkan jumlah seluruh projek -->
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
              <h3 class="font-weight-medium text-right mb-0">{{ $totalProjects }}</h3>
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
              <h3 class="font-weight-medium text-right mb-0">{{ $totalProjectsThisYear }}</h3>
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
              <h3 class="font-weight-medium text-right mb-0">{{ $totalUsers }}</h3>
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
            <button type="button" class="btn btn-success btn-fw" onclick="window.location.href='{{ route ('project.index')}}'">
                <i class="mdi mdi-database"></i>Detail
            </button>
        </div>
        <p class="card-description"> Data Project</p>
          <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama Aplikasi</th>
                        <th>Semester</th>
                        <th>Angkatan</th>
                        <th>Golongan</th>
                        <th>Ketua Kelompok</th>
                        <th>Link Github</th>
                        <th>Video Aplikasi</th>
                        <th>Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->nama_aplikasi }}</td>
                        <td>{{ $project->semester }}</td>
                        <td>{{ $project->angkatan }}</td>
                        <td>{{ $project->golongan }}</td>
                        <td>{{ $project->ketua_kelompok }}</td>
                        <td>{{ $project->link_github }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $project->video_aplikasi) }}" target="_blank">Tonton Video</a>
                        </td>
                        <td>
                            <img src="{{ asset('storage/' . $project->gambar_1) }}" alt="{{ $project->nama_aplikasi }}" width="100">
                            <img src="{{ asset('storage/' . $project->gambar_2) }}" alt="{{ $project->nama_aplikasi }}" width="100">
                            <img src="{{ asset('storage/' . $project->gambar_3) }}" alt="{{ $project->nama_aplikasi }}" width="100">
                            <img src="{{ asset('storage/' . $project->gambar_4) }}" alt="{{ $project->nama_aplikasi }}" width="100">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
            <h4 class="card-title">Table Mahasiswa</h4>
            <button type="button" class="btn btn-success btn-fw" onclick="window.location.href='{{ route ('mahasiswa.index')}}'">
                <i class="mdi mdi-database"></i>Detail
            </button>
        </div>
        <p class="card-description"> Data Mahasiswa</p>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th> Nama Lengkap</th>
                <th> Email</th>
                <th> NIM</th>
                <th> No.Telp</th>
                <th> Angkatan</th>
              </tr>
            </thead>
            <tbody>
              @foreach($mahasiswa as $mahasiswa)
              <tr>
                <td> {{$mahasiswa->name}}</td>
                <td> {{$mahasiswa->email}}</td>
                <td> {{$mahasiswa->nim}}</td>
                <td> {{$mahasiswa->phone_number}}</td>
                <td> {{$mahasiswa->angkatan}}</td>
              </tr>
              @endforeach
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