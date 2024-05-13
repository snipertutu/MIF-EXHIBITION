@extends('layout.master-mhs')

@push('plugin-styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Table Project</h4>
                    <button type="button" class="btn btn-success btn-fw" data-toggle="modal" data-target="#addProjectModal">
                        <i class="mdi mdi-plus"></i>Tambah
                    </button>
                </div>
                <p class="card-description">Data Project Saya</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Aplikasi</th>
                                <th>Semester</th>
                                <th>Angkatan</th>
                                <th>Golongan</th>
                                <th>Anggota</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->nama_aplikasi }}</td>
                                <td>{{ $project->semester }}</td>
                                <td>{{ $project->angkatan }}</td>
                                <td>{{ $project->golongan }}</td>
                                <td>
                                    <ul>
                                        @foreach($project->detail as $details)
                                        <li>{{ $details->users->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm edit-project-btn" data-toggle="modal" data-target="#editProjectModal{{ $project->id }}" data-project-id="{{ $project->id }}">
                                        Edit
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

<!-- Tambah Proyek Modal -->
<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document" style="max-width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProjectModalLabel">Tambah Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addProjectForm" action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="overflow-y: auto;">
                    <!-- Step 1: Pilih Kategori dan Semester -->
                    <div id="step-1">
                        <label for="kategori">Pilih Kategori Project</label>
                        <select id="kategori" name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Tugas Akhir">Tugas Akhir</option>
                            <option value="Workshop">Workshop</option>
                        </select>
                        <label for="semester">Pilih Semester</label>
                        <select id="semester" name="semester" required>
                            <option value="">Pilih Semester</option>
                        </select>
                        <button id="step-1-next-btn" type="button" class="btn btn-primary mt-3">Selanjutnya</button>
                    </div>
                    
                    <!-- Step 2: Isi Data Proyek -->
                    <div id="step-2" style="display: none;">
                        <label for="nama_aplikasi">Nama Aplikasi</label>
                        <input type="text" class="form-control" id="nama_aplikasi" name="nama_aplikasi" placeholder="Nama Aplikasi" required>
                        <!-- <label for="angkatan">Angkatan</label>
                        <input type="text" class="form-control" id="angkatan" name="angkatan" placeholder="Angkatan" required> -->
                        <label for="golongan">Golongan</label>
                            <select class="form-control" id="golongan" name="golongan" required>
                                <option value="">Pilih Golongan</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="INTER">INTER</option>
                            </select>
                        <label for="link_website">Link Website</label>
                        <input type="text" class="form-control" id="link_website" name="link_website" placeholder="Link Website" required>
                        <!-- Input untuk link GitHub -->
                        <div id="link_github_input" style="display: none;">
                            <label for="link_github">Link GitHub/GIT/LinkTree</label>
                            <input type="text" class="form-control" id="link_github" name="link_github" placeholder="Link GitHub">
                        </div>
                        <!-- Input untuk ketua kelompok dan anggota kelompok hanya muncul jika kategori "Workshop" dipilih -->
                        <div id="workshop-inputs" style="display: none;"> -->
                            <!-- <label for="ketua_kelompok">Ketua Kelompok</label>
                            <input type="text" class="form-control" id="ketua_kelompok" name="ketua_kelompok" placeholder="Ketua Kelompok" value="{{ Auth::user()->nim }}" readonly> -->
                            <label for="anggota">Anggota Kelompok (pisahkan dengan koma)</label>
                            <select class="form-control" id="anggota" name="anggota[]" multiple="multiple" style="width: 100%;">
                                <!-- Options akan ditambahkan secara dinamis menggunakan JavaScript -->
                            </select>
                        </div>
                        <label for="narasi">Narasi</label>
                        <textarea class="form-control" id="narasi" name="narasi" placeholder="Narasi" rows="3" required></textarea>
                        <button id="step-2-next-btn" type="button" class="btn btn-primary mt-3">Selanjutnya</button>
                        <button id="step-2-back-btn" type="button" class="btn btn-secondary mt-3">Kembali</button>
                    </div>

                    <!-- Step 3: Detail Proyek -->
                    <div id="step-3" style="display: none;">
                        <label for="link_youtube">Link Youtube</label>
                        <input type="text" class="form-control" id="link_youtube" name="link_youtube" placeholder="Link Youtube" required>
                        <label for="gambar_1">Poster</label>
                        <input type="file" class="form-control-file" id="gambar_1" name="gambar_1" required>
                        <label for="gambar_2">Gambar 1</label>
                        <input type="file" class="form-control-file" id="gambar_2" name="gambar_2" required>
                        <label for="gambar_3">Gambar 2</label>
                        <input type="file" class="form-control-file" id="gambar_3" name="gambar_3" required>
                        <label for="gambar_4">Gambar 3</label>
                        <input type="file" class="form-control-file" id="gambar_4" name="gambar_4" required>
                        <button id="step-3-next-btn" type="submit" class="btn btn-primary mt-3">Tambah</button>
                        <button id="step-3-back-btn" type="button" class="btn btn-secondary mt-3">Kembali</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

@foreach($projects as $project)

<!-- Modal Edit Proyek -->
<div class="modal fade" id="editProjectModal{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="editProjectModalLabel{{ $project->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document" style="max-width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModalLabel{{ $project->id }}">Edit Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editProjectForm{{ $project->id }}" action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                    <label for="nama_aplikasi{{ $project->id }}">Nama Aplikasi</label>
                    <input type="text" class="form-control" id="nama_aplikasi{{ $project->id }}" name="nama_aplikasi" value="{{ $project->nama_aplikasi }}" required>
                    <!-- <label for="angkatan{{ $project->id }}">Angkatan</label>
                    <input type="text" class="form-control" id="angkatan{{ $project->id }}" name="angkatan" value="{{ $project->angkatan }}" required> -->
                    <label for="golongan{{ $project->id }}">Golongan</label>
                        <select class="form-control" id="golongan{{ $project->id }}" name="golongan" required>
                            <option value="">Pilih Golongan</option>
                            <option value="A" @if($project->golongan == 'A') selected @endif>A</option>
                            <option value="B" @if($project->golongan == 'B') selected @endif>B</option>
                            <option value="C" @if($project->golongan == 'C') selected @endif>C</option>
                            <option value="D" @if($project->golongan == 'D') selected @endif>D</option>
                            <option value="E" @if($project->golongan == 'E') selected @endif>E</option>
                            <option value="INTER" @if($project->golongan == 'INTER') selected @endif>INTER</option>
                        </select>
                    <label for="link_website{{ $project->id }}">Link Website</label>
                    <input type="text" class="form-control" id="link_website{{ $project->id }}" name="link_website" value="{{ $project->link_website }}" required>
                    <label for="link_github{{ $project->id }}">Link GitHub</label>
                    <input type="text" class="form-control" id="link_github{{ $project->id }}" name="link_github" value="{{ $project->link_github }}" required>
                    <label for="narasi{{ $project->id }}">Narasi</label>
                    <textarea type="text" class="form-control" id="narasi{{ $project->id }}" name="narasi" rows="3" required>{{ $project->narasi }}</textarea>

                    <!-- Menampilkan input ketua kelompok dan anggota kelompok jika kategori Workshop -->
                    @if($project->kategori === 'Workshop')
                    <!-- <label for="ketua_kelompok{{ $project->id }}">Ketua Kelompok</label>
                    <input type="text" class="form-control" id="ketua_kelompok{{ $project->id }}" name="ketua_kelompok" value="{{ $project->ketua_kelompok }}" required> -->
                    <label for="anggota{{ $project->id }}">Anggota Kelompok (pisahkan dengan koma)</label>
                    <select class="form-control" id="anggota{{ $project->id }}" name="anggota[]" multiple="multiple" style="width: 100%;">
                    </select>
                    @endif

                    <label for="edit_link_youtube{{ $project->id }}">Link Youtube</label>
                    <input type="text" class="form-control" id="edit_link_youtube{{ $project->id }}" name="link_youtube" value="{{ $project->link_youtube }}" required>
                    <label for="edit_gambar_1{{ $project->id }}">Poster</label>
                    <input type="file" class="form-control-file" id="edit_gambar_1{{ $project->id }}" name="gambar_1">
                    <label for="edit_gambar_2{{ $project->id }}">Gambar 1</label>
                    <input type="file" class="form-control-file" id="edit_gambar_2{{ $project->id }}" name="gambar_2">
                    <label for="edit_gambar_3{{ $project->id }}">Gambar 2</label>
                    <input type="file" class="form-control-file" id="edit_gambar_3{{ $project->id }}" name="gambar_3">
                    <label for="edit_gambar_4{{ $project->id }}">Gambar 3</label>
                    <input type="file" class="form-control-file" id="edit_gambar_4{{ $project->id }}" name="gambar_4">

                    <!-- Script JavaScript untuk inisialisasi Select2 dan memuat data anggota -->
                    <script>
                        $(document).ready(function() {
                            $('#anggota{{ $project->id }}').select2({
                                placeholder: "Pilih anggota",
                                tags: true,
                                tokenSeparators: [',', ' '],
                                ajax: {
                                    url: '/searchs',
                                    dataType: 'json',
                                    delay: 250,
                                    processResults: function(data) {
                                        return {
                                            results: data
                                        };
                                    },
                                    cache: true
                                }
                            });

                            $.ajax({
                                url: '/get-members/{{ $project->id }}',
                                method: 'GET',
                                success: function(response) {
                                    var anggotaSelect = $('#anggota{{ $project->id }}');
                                    $.each(response.data, function(index, member) {
                                        var option = new Option(member.name, member.id, true, true);
                                        anggotaSelect.append(option).trigger('change');
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        });
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


<!-- Success Modal -->
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
                <p>Data project berhasil ditambahkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Pesan error akan ditampilkan di sini -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



@endsection

<!-- JavaScript -->
@push('plugin-scripts')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>




<script>
    $(document).ready(function() {
    // Event listener untuk pemilihan kategori
    $('#kategori').change(function() {
        var kategori = $(this).val();

        // Menyembunyikan/menampilkan input sesuai dengan kategori yang dipilih
        if (kategori === 'Tugas Akhir') {
            $('#workshop-inputs').hide();
            $('#link_github_input').show();
        } else if (kategori === 'Workshop') {
            $('#workshop-inputs').show();
            $('#link_github_input').show();
        }

        // Menyesuaikan opsi semester sesuai dengan kategori yang dipilih
        $('#semester').empty();
        if (kategori === 'Tugas Akhir') {
            for (var i = 6;i <= 6; i++) {
                $('#semester').append('<option value="' + i + '">' + i + '</option>');
            }
        } else if (kategori === 'Workshop') {
            for (var i = 1; i <= 4; i++) {
                $('#semester').append('<option value="' + i + '">' + i + '</option>');
            }
        }
    });

    // Event listener untuk tombol "Selanjutnya" pada Step 1
    $('#step-1-next-btn').click(function() {
        // Sembunyikan Step 1 dan tampilkan Step 2
        $('#step-1').hide();
        $('#step-2').show();
    });

    // Event listener untuk tombol "Kembali" pada Step 2
    $('#step-2-back-btn').click(function() {
        // Sembunyikan Step 2 dan tampilkan Step 1
        $('#step-2').hide();
        $('#step-1').show();
    });

    // Event listener untuk tombol "Selanjutnya" pada Step 2
    $('#step-2-next-btn').click(function() {
        // Sembunyikan Step 2 dan tampilkan Step 3
        $('#step-2').hide();
        $('#step-3').show();
    });

    // Event listener untuk tombol "Kembali" pada Step 3
    $('#step-3-back-btn').click(function() {
        // Sembunyikan Step 3 dan tampilkan Step 2
        $('#step-3').hide();
        $('#step-2').show();
    });
});

</script>

<script>
    $(document).ready(function() {
        $('#anggota').select2({
            placeholder: "Pilih anggota",
            tags: true, // Memungkinkan tambahan opsi yang tidak ada dalam daftar
            tokenSeparators: [',', ' '], // Pisahkan opsi yang dipilih dengan koma atau spasi
            ajax: {
                url: '/searchs', // Endpoint untuk mencari anggota
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    });
</script>

<script>
// Event listener untuk submit form menggunakan Ajax
$('#addProjectForm').submit(function(e) {
    e.preventDefault(); // Mencegah perilaku default form submit

    // Mendapatkan URL form action
    var url = $(this).attr('action');

    // Menggunakan FormData untuk mengambil data form
    var formData = new FormData($(this)[0]);

    // Mengirim data form menggunakan Ajax
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Menyembunyikan modal tambah
            $('#addProjectModal').modal('hide');

            // Menampilkan modal pesan berhasil
            $('#successModal').modal('show');

            // Reset form setelah menampilkan modal
            $('#successModal').on('hidden.bs.modal', function (e) {
                $('#addProjectForm')[0].reset();
                location.reload();
            });
        },
        error: function(xhr, status, error) {
            // Menyembunyikan modal tambah
            $('#addProjectModal').modal('hide');

            // Menampilkan modal pesan error
            $('#errorModal').modal('show');

            // Event listener untuk tombol close pada modal error
            $('#errorModal').on('hidden.bs.modal', function (e) {
                // Lakukan refresh halaman
                location.reload();
            });

            // Memperbarui pesan error dengan pesan dari server
            $('#errorModal .modal-body').html(xhr.responseText);
        }
    });
});

</script>

<script>
    $(document).ready(function() {
        // Event listener untuk submit form edit menggunakan Ajax
        $('[id^=editProjectForm]').submit(function(e) {
            e.preventDefault(); // Mencegah perilaku default form submit

            // Mendapatkan URL form action
            var url = $(this).attr('action');

            // Menggunakan FormData untuk mengambil data form
            var formData = new FormData($(this)[0]);

            // Mengirim data form menggunakan Ajax
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Menyembunyikan modal edit
                    $('[id^=editProjectModal]').modal('hide');

                    // Menampilkan modal pesan berhasil
                    $('#successModal').modal('show');

                    // Reset form setelah menampilkan modal
                    $('#successModal').on('hidden.bs.modal', function (e) {
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    // Menyembunyikan modal edit
                    $('[id^=editProjectModal]').modal('hide');

                    // Menampilkan modal pesan error
                    $('#errorModal').modal('show');

                    // Event listener untuk tombol close pada modal error
                    $('#errorModal').on('hidden.bs.modal', function (e) {
                        // Lakukan refresh halaman
                        location.reload();
                    });

                    // Memperbarui pesan error dengan pesan dari server
                    $('#errorModal .modal-body').html(xhr.responseText);
                }
            });
        });
    });
</script>

@endpush
