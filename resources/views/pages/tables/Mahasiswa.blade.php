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
                    <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-icons btn-rounded btn-primary">
                    <i class="mdi mdi-border-color"></i>
                    </button>
                    <button type="button" class="btn btn-icons btn-rounded btn-danger">
                    <i class="mdi mdi-archive   "></i>
                    </button>
                </td>
              </tr>
              @endforeach
              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="">
                      <div class="form-group">
                          <label for="name">Nama</label>
                          <input type="text" class="form-control" id="name" placeholder="Nama Mahasiswa">
                    </div>
                      <div class="form-group">
                          <label for="name">Nama</label>
                          <input type="text" class="form-control" id="name" placeholder="Nama Mahasiswa">
                    </div>
                      <div class="form-group">
                          <label for="name">Nama</label>
                          <input type="text" class="form-control" id="name" placeholder="Nama Mahasiswa">
                    </div>
                      <div class="form-group">
                          <label for="name">Nama</label>
                          <input type="text" class="form-control" id="name" placeholder="Nama Mahasiswa">
                    </div>
                      <div class="form-group">
                          <label for="name">Nama</label>
                          <input type="text" class="form-control" id="name" placeholder="Nama Mahasiswa">
                    </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
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
