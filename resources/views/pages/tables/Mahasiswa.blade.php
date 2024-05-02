@extends('layout.master')

@push('plugin-styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<!-- Tambahkan Bootstrap CSS jika belum dimuat -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Table Mahasiswa</h4>
                <!-- Gunakan atribut data-toggle dan data-target untuk memicu modal -->
                <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modalTambahMahasiswa">Tambah Data</button>
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
<div class="modal fade" id="modalTambahMahasiswa" tabindex="-1" role="dialog" aria-labelledby="modalTambahMahasiswaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahMahasiswaLabel">Tambah Data Mahasiswa</h5>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- Tambahkan Bootstrap JavaScript jika belum dimuat -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endpush

@push('custom-scripts')
<script>
    $(document).ready(function() {
        // Inisialisasi DataTable setelah dokumen dimuat
        $('#mahasiswa-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("mahasiswa.index") }}', // Sesuaikan dengan route yang menangani permintaan Ajax
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'nim', name: 'nim' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'angkatan', name: 'angkatan' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Mengirim formulir saat tombol "Upload" diklik
        $('#btnSubmit').click(function () {
            $('#formUploadExcel').submit();
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
                    // Tampilkan respons berhasil ke pengguna
                    alert(data.success);
                },
                error: function(xhr, status, error) {
                    // Tampilkan pesan kesalahan jika upload gagal
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        });
    });
</script>
@endpush

