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
        <table id="data" class="" style="width:100%">
            <thead>
              <tr>
                <th> Nama Lengkap</th>
                <th> Email</th>
                <th> NIM</th>
                <th> No.Telp</th>
                <th> Angkatan</th>
                <th> Aksi</th>
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
                <td>
                    <button type="button" class="btn btn-icons btn-rounded btn-danger">
                    <i class="mdi mdi-archive   "></i>
                    </button>
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


@endsection

@push('plugin-scripts')
<script>
  new DataTable('#data');
</script>
@endpush

@push('custom-scripts')
@endpush
