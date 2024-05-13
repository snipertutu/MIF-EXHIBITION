@extends('layout.master')


@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Table Mahasiswa</h4>
                <!-- Gunakan atribut data-toggle dan data-target untuk memicu modal -->
                <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modalTambahMahasiswa">Tambah Data</button>
                <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modaladdMahasiswa">Tambah Mahasiswa</button
                <div class="table-responsive">
                    <table id="mahasiswa-table" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>NIM</th>
                                <th>No.Telp</th>
                                <th>Angkatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data Mahasiswa -->
<div class="modal fade" id="modaladdMahasiswa" tabindex="-1" role="dialog" aria-labelledby="modalTambahMahasiswaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahMahasiswaLabel">Tambah Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formaddMahasiswa" action="{{ route('mahasiswa.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="angkatan">Angkatan</label>
                        <input type="number" class="form-control" id="angkatan" name="angkatan" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Data Mahasiswa -->
<div class="modal fade" id="modalEditMahasiswa" tabindex="-1" role="dialog" aria-labelledby="modalEditMahasiswaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditMahasiswaLabel">Edit Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditMahasiswa" method="POST" action="/mahasiswa/{id}/update">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id" name="edit_id">
                    <div class="form-group">
                        <label for="edit_nim">NIM</label>
                        <input type="text" class="form-control" id="edit_nim" name="edit_nim" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_name">Nama</label>
                        <input type="text" class="form-control" id="edit_name" name="edit_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_angkatan">Angkatan</label>
                        <input type="number" class="form-control" id="edit_angkatan" name="edit_angkatan" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Tambah Data Mahasiswa berupa file -->
<div class="modal fade" id="modalTambahMahasiswa" tabindex="-1" role="dialog" aria-labelledby="modalTambahMahasiswaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahMahasiswaLabel">Upload Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUploadExcel" action="{{ route('upload.excel') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSubmit">Upload</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
@endpush

@push('custom-scripts')
<script>
$(document).ready(function() {
    var table = $('#mahasiswa-table').DataTable({
        processing: true,
        serverSide: true,
        "paging": true,
        "searching": true,
        ajax: '{{ route("mahasiswa.index") }}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'nim', name: 'nim' },
            { data: 'phone_number', name: 'phone_number' },
            { data: 'angkatan', name: 'angkatan' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // Fungsi untuk memperbarui tabel dengan hasil pencarian
    function searchMahasiswa(query) {
        $.ajax({
            url: '{{ route("mahasiswa.search") }}',
            type: 'GET',
            data: { query: query },
            success: function(response) {
                table.clear().rows.add(response.data).draw();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Tangkap perubahan input teks dan lakukan pencarian
    $('#searchmahasiswa').on('keyup', function() {
        var query = $(this).val();
        if (query.trim() !== '') {
            searchMahasiswa(query);
        } else {
            // Jika input kosong, tampilkan semua data
            table.ajax.reload();
        }
    });


    // $('#btnSubmit').click(function () {
    //     $('#formUploadExcel').submit();
    // });

    //ajaxnya excel
    $('#btnSubmit').click(function() {
        var formData = new FormData($('#formUploadExcel')[0]);

        $.ajax({
            url: '{{ route("upload.excel") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Tampilkan pesan sukses
                console.log(response.success);
                // Tutup modal
                $('#modalTambahMahasiswa').modal('hide');
            },
            error: function(xhr, status, error) {
                var err = JSON.parse(xhr.responseText);
                // Tampilkan pesan error
                console.log(err.error);
            }
        });
    });

    $('#formUpload').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                alert(data.success);
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    });

    $('#formaddMahasiswa').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function(response) {
                $('#modaladdMahasiswa').modal('hide');
                $('#mahasiswa-table').DataTable().ajax.reload();
                alert('Data mahasiswa berhasil ditambahkan.');
                window.location.reload();
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    });

    $('#mahasiswa-table').on('click', '.btn-delete', function () {
        if (confirm('Anda yakin ingin menghapus data ini?')) {
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '{{ route("mahasiswa.destroy") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function (data) {
                    table.ajax.reload();
                },
                error: function (xhr, status, error) {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        }
    });

    $('#mahasiswa-table').on('click', '.btn-edit', function () {
        var id = $(this).data('id');
        console.log(id);

        $.ajax({
            type: 'GET',
            url: '/mahasiswa/' + id + '/edit',
            success: function (response) {
                $('#edit_id').val(response.id);
                $('#edit_nim').val(response.nim);
                $('#edit_name').val(response.name);
                $('#edit_angkatan').val(response.angkatan);
                $('#modalEditMahasiswa').modal('show');
            },
            error: function (xhr, status, error) {
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    });

    $('#formEditMahasiswa').on('submit', function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);

        $.ajax({
            type: 'PUT',
            url: '/mahasiswa/' + $('#edit_id').val() + '/update',
            data: formData,
            success: function (response) {
                $('#modalEditMahasiswa').modal('hide');
                alert(response.message);
                table.ajax.reload(); // Refresh datatable
            },
            error: function (xhr, status, error) {
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    });
});

</script>
@endpush


