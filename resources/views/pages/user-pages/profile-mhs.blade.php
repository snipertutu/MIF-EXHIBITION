@extends('layout.master-mhs')

@push('plugin-styles')
@endpush

@section('content')

<div class="main-content-container container-fluid">
    <div class="page-header row no-gutters">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Profile</span>
            <h3 class="page-title">User Profile</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-small mb-4 pt-3">
                <div class="card-header border-bottom text-center">
                    <div class="mb-3 mx-auto">
                        <img class="user-avatar rounded-circle mr-2" src="{{ url('assets/images/faces/face8.jpg') }}"
                            alt="User Avatar" width="150" height="150">
                    </div>
                    <h4 class="mb-0">Si Tampan</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Detail Akun</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                        <div class="row">
                            <div class="col">
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="nama">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama" placeholder="Nama lengkap"
                                                value="Si Tampan">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="nim">NIM</label>
                                            <input type="text" class="form-control" id="nim" placeholder="NIM"
                                                value="E31210898" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="angkatan">Angkatan</label>
                                            <input type="text" class="form-control" id="angkatan" placeholder="Angkatan"
                                                value="2021">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Email"
                                                value="dafsaas@gmail.cmom" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="telp">No Telepon</label>
                                            <input type="text" class="form-control" id="telp" placeholder="No. Hanphone"
                                                value="086556758786">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="alamat">Alamat</label>
                                            <textarea class="form-control" id="alamat"
                                                rows="3">Jember</textarea>
                                        </div>
                                    </div>
                                    <div class="form-row upload--foto">
                                        <div class="form-group col-12">
                                            <label for="nama">Foto Profile</label>
                                            <input id="foto" type="file" accept=".png, .jpeg, .jpg">
                                        </div>
                                    </div>
                                </form>
                                <button type="button" class="btn btn-dark btn-fw">
                                    <i class="mdi mdi-cloud-download"></i>Edit
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
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
