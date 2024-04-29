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
                    <img class="user-avatar rounded-circle mr-2" src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="User Avatar" width="150" height="150">
                    </div>
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
                            <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama lengkap"
                                            value="{{ auth()->user()->name }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nim">NIM</label>
                                        <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM"
                                            value="{{ auth()->user()->nim }}" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="angkatan">Angkatan</label>
                                        <input type="text" class="form-control" id="angkatan" name="angkatan" placeholder="Angkatan"
                                            value="{{ auth()->user()->angkatan }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                            value="{{ auth()->user()->email }}" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="telp">No Telepon</label>
                                        <input type="text" class="form-control" id="telp" name="phone_number" placeholder="No. Hanphone"
                                            value="{{ auth()->user()->phone_number }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="telp">Akun Github</label>
                                        <input type="text" class="form-control" id="github" name="akun_github" placeholder="Akun Github"
                                            value="{{ auth()->user()->akun_github }}" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="telp">Akun Linkedin</label>
                                        <input type="text" class="form-control" id="linkedin" name="akun_linkedin" placeholder="Akun Linkedin"
                                            value="{{ auth()->user()->akun_linkedin }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="address" rows="3"
                                            readonly>{{ auth()->user()->address }}</textarea>
                                    </div>
                                </div>
                                <div class="form-row upload--foto">
                                    <div class="form-group col-12">
                                        <label for="foto">Foto Profile</label>
                                        <input id="foto" name="profile_picture" type="file" accept=".png, .jpeg, .jpg" disabled>
                                    </div>
                                </div>
                                <button id="editButton" type="button" class="btn btn-dark btn-fw">Edit</button>
                                <button id="saveButton" name="save" value="Save" type="submit" class="btn btn-primary btn-fw"
                                    style="display: none;">Save</button>
                            </form>

                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Profil berhasil diperbarui.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="errorModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p id="errorMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

<script>
    $(document).ready(function(){
        @if ($errors->any())
            $('#errorMessage').text("{{ $errors->first() }}");
            $('#errorModal').modal('show');
        @endif

        @if (session('success'))
            $('#successModal').modal('show');
        @endif
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const profileForm = document.getElementById('profileForm');
        const editButton = document.getElementById('editButton');
        const saveButton = document.getElementById('saveButton');
        const editableFields = profileForm.querySelectorAll('input[id=telp], input[id=github], input[id=linkedin], textarea[id=alamat], input[id=foto]');
        
        editButton.addEventListener('click', function () {
            // Aktifkan hanya field yang bisa di-edit
            editableFields.forEach(field => {
                field.removeAttribute('readonly');
                field.removeAttribute('disabled');
            });

            // Aktifkan tombol untuk menyimpan
            editButton.style.display = 'none';
            saveButton.style.display = 'inline-block';
        });
    });
</script>

@endpush
