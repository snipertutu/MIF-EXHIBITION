@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Table Mahasiswa</h4>
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
                <th> Semester</th>
                <th> Golongan</th>
                <th> Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> yomalika angraini</td>
                <td> yoummy21@gmail.com</td>
                <td> E31234567</td>
                <td> 08587768376</td>
                <td> 2021</td>
                <td> 1</td>
                <td> A</td>
                <td>
                    <button type="button" class="btn btn-icons btn-rounded btn-primary">
                    <i class="mdi mdi-border-color"></i>
                    </button>
                    <button type="button" class="btn btn-icons btn-rounded btn-danger">
                    <i class="mdi mdi-archive   "></i>
                    </button>
                </td>
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
@endpush

@push('custom-scripts')
@endpush
