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
                <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modaladdMahasiswa">Tambah Mahasiswa</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- Tambahkan Bootstrap JavaScript jika belum dimuat -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endpush

@push('custom-scripts')
<script>
    $(document).ready(function() {
        // Inisialisasi DataTable setelah dokumen dimuat
        var table = $('#mahasiswa-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("mahasiswa.index") }}', // Sesuaikan dengan route yang menangani permintaan Ajax
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'nim', name: 'nim' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'angkatan', name: 'angkatan' },
                { data: 'action', name: 'action', orderable: false, searchable: false, 
                    render: function (data, type, full, meta) {
                        return '<button class="btn btn-danger btn-delete" data-id="' + full.id + '">Hapus</button>';
                    }
                }
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

        $('#formaddMahasiswa').on('submit', function(e) {
            e.preventDefault(); // Mencegah pengiriman formulir secara default
            
            // Mengumpulkan data dari formulir
            var formData = $(this).serialize();

            // Kirim permintaan AJAX untuk menyimpan data mahasiswa
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    // Tutup modal setelah penyimpanan berhasil
                    $('#modaladdMahasiswa').modal('hide');

                    // Refresh tabel mahasiswa setelah penyimpanan berhasil
                    $('#mahasiswa-table').DataTable().ajax.reload();

                    // Tampilkan pesan sukses kepada pengguna
                    alert('Data mahasiswa berhasil ditambahkan.');

                    // Merefresh halaman setelah alert diklik
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    // Tampilkan pesan kesalahan jika penyimpanan gagal
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        });

        // Menangani klik tombol hapus
        $('#mahasiswa-table').on('click', '.btn-delete', function () {
            if (confirm('Anda yakin ingin menghapus data ini?')) {
                var id = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: '{{ route("mahasiswa.destroy") }}', // Sesuaikan dengan route penghapusan data
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function (data) {
                        // Refresh tabel setelah penghapusan berhasil
                        table.ajax.reload();
                    },
                    error: function (xhr, status, error) {
                        // Tampilkan pesan kesalahan jika penghapusan gagal
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            }
        });
    });
</script>
@endpush


