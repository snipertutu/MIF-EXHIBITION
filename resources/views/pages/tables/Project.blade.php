@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
<div class="row">

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> Tabel Projek</h4>
                <div class="card-header border-bottom">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="m-0">Data Projek</h6>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-sm btn-success btn-add-meeting" data-toggle="modal"
                                data-target="#crudModal"><i class="fas fa-plus"></i> Tambah Projek</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
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
                                <td></td>
                            </tr>
                            <tr>
                                <td> SIMA</td>
                                <td> 1</td>
                                <td> 2021</td>
                                <td> A</td>
                                <td> Nafis</td>
                                <td> www.contohaja.com</td>
                                <td> misal</td>
                                <td> misal</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td> SIMA</td>
                                <td> 1</td>
                                <td> 2021</td>
                                <td> A</td>
                                <td> Nafis</td>
                                <td> www.contohaja.com</td>
                                <td> misal</td>
                                <td> misal</td>
                                <td></td>
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
                <h5 class="modal-title" id="exampleModalLongTitle"><span class="title-meeting-modal"></span> Agenda
                    Rapat <span class="meeting-name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="meetingTipe">Nama Aplikasi</label>
                            <input type="text" class="form-control" id="meetingName" placeholder="Nama Rapat">
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="meetingName">Semester</label>
                            <input type="text" class="form-control" id="meetingName" placeholder="Nama Rapat">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="meetingName">Ketua Kelompok</label>
                            <input type="text" class="form-control" id="meetingName" placeholder="Nama Rapat">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="meetingName">Anggota Kelompok</label>
                                    <select id="meetingTipe" class="form-control">
                                        <option value="1" selected>Rapat Resmi</option>
                                        <option value="2">Rapat Program Kerja</option>
                                    </select>
                                    <select id="meetingTipe" class="form-control">
                                        <option value="1" selected>Rapat Resmi</option>
                                        <option value="2">Rapat Program Kerja</option>
                                    </select>
                                    <select id="meetingTipe" class="form-control">
                                        <option value="1" selected>Rapat Resmi</option>
                                        <option value="2">Rapat Program Kerja</option>
                                    </select>
                                    <select id="meetingTipe" class="form-control">
                                        <option value="1" selected>Rapat Resmi</option>
                                        <option value="2">Rapat Program Kerja</option>
                                    </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="meetingName">Link github</label>
                            <input type="text" class="form-control" id="meetingName" placeholder="Nama Rapat">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="meetingName">Video Aplikasi</label><br>
                            <input type="file" name="file">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="meetingName">Gambar Aplikasi</label><br>
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
