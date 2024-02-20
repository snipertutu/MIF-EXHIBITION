@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Table Project</h4>
            <button type="button" class="btn btn-success btn-fw" data-toggle="modal" data-target="#crudModal">
                <i class="mdi mdi-plus"></i>Tambah
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
                <th> Aksi</th>
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

<!-- CRUD Modal -->
<div class="modal fade" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><span class="title-meeting-modal"></span> Tambah Project
                 <span class="meeting-name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="aplicationName">Nama Aplikasi</label>
                            <input type="text" class="form-control" id="meetingName" placeholder="Nama Aplikasi">
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="semester">Semester</label>
                            <input type="text" class="form-control" id="meetingName" placeholder="Semester 1">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="leaderName">Ketua Kelompok</label>
                            <input type="text" class="form-control" id="meetingName" placeholder="Nama Ketua">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="memberName">Anggota Kelompok</label>
                                    <select id="member1" class="form-control">
                                        <option value="1" selected>si a</option>
                                        <option value="2">si b</option>
                                    </select>
                                    <select id="member2" class="form-control">
                                        <option value="1" selected>si a</option>
                                        <option value="2">si b</option>
                                    </select>
                                    <select id="member3" class="form-control">
                                        <option value="1" selected>si a</option>
                                        <option value="2">si b</option>
                                    </select>
                                    <select id="member4" class="form-control">
                                        <option value="1" selected>si a</option>
                                        <option value="2">si b</option>
                                    </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="githubLink">Link github</label>
                            <input type="text" class="form-control" id="githubLink" placeholder="masukan link github">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="aplicationVideo">Video Aplikasi</label><br>
                            <input type="file" name="file">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="imageAplication">Gambar Aplikasi</label><br>
                            <input type="file" name="file">
                            <input type="file" name="file">
                            <input type="file" name="file">
                            <input type="file" name="file">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-confirm-update-meeting">Update</button>
                <button type="button" class="btn btn-primary btn-confirm-add-meeting">Tambah</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush
