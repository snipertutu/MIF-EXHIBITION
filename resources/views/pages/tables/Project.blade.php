@extends('layout.master')

@push('plugin-styles')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Table Project</h4>
                <p class="card-description">Data Project</p>
                <div class="form-group">
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari nama aplikasi">
                </div>
                <div class="table-responsive">
                  <table class="table table-hover">
                      <thead>
                          <tr>
                              <th>Nama Aplikasi</th>
                              <th>Semester</th>
                              <th>Angkatan</th>
                              <th>Golongan</th>
                              <th>Ketua Kelompok</th>
                              <th>Link Github</th>
                              <th>Video Aplikasi</th>
                              <th>Gambar</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($projects as $project)
                          <tr id="project-row-{{ $project->id }}">
                            <td>{{ $project->nama_aplikasi }}</td>
                            <td>{{ $project->semester }}</td>
                            <td>{{ $project->angkatan }}</td>
                            <td>{{ $project->golongan }}</td>
                            <td>{{ $project->ketua_kelompok }}</td>
                            <td>{{ $project->link_github }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $project->video_aplikasi) }}" target="_blank">Tonton Video</a>
                            </td>
                            <td>
                                <img src="{{ asset('storage/' . $project->gambar_1) }}" alt="{{ $project->nama_aplikasi }}" width="100">
                                <img src="{{ asset('storage/' . $project->gambar_2) }}" alt="{{ $project->nama_aplikasi }}" width="100">
                                <img src="{{ asset('storage/' . $project->gambar_3) }}" alt="{{ $project->nama_aplikasi }}" width="100">
                                <img src="{{ asset('storage/' . $project->gambar_4) }}" alt="{{ $project->nama_aplikasi }}" width="100">
                            </td>
                            <td>
                            <button id="toggleButton-{{ $project->id }}" class="btn btn-sm btn-{{ $project->hidden ? 'success' : 'danger' }}" data-hidden="{{ $project->hidden }}" onclick="toggleVisibility(this, {{ $project->id }})">{{ $project->hidden ? 'Tampilkan' : 'Sembunyikan' }}</button>
                            </td>
                            <td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm edit-project-btn" data-toggle="modal" data-target="#editProjectModal{{ $project->id }}" data-project-id="{{ $project->id }}">
                                    Edit
                                </button>
                            </td>
                            <td>
                            <button class="badge btn-warning btn-sm" onclick="deleteProject({{ $project->id }})">Hapus</button>
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
            <form id="editProjectForm{{ $project->id }}" action="{{ route('project.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <label for="anggota{{ $project->id }}">Anggota Kelompok (pisahkan dengan koma)</label>
                    <select class="form-control" id="anggota{{ $project->id }}" name="anggota[]" multiple="multiple" style="width: 100%;">
                    </select>
                    <!-- Script JavaScript untuk inisialisasi Select2 dan memuat data anggota -->
                    <script>
                        $(document).ready(function() {
                            $('#anggota{{ $project->id }}').select2({
                                placeholder: "Pilih anggota",
                                tags: true,
                                tokenSeparators: [',', ' '],
                                ajax: {
                                    url: '/search',
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
                                url: '/get-member/{{ $project->id }}',
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


@push('plugin-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
@endpush

@push('custom-scripts')
<script>
    $(document).ready(function() {
        $('#anggota').select2({
            placeholder: "Pilih anggota",
            tags: true, // Memungkinkan tambahan opsi yang tidak ada dalam daftar
            tokenSeparators: [',', ' '], // Pisahkan opsi yang dipilih dengan koma atau spasi
            ajax: {
                url: '/search', // Endpoint untuk mencari anggota
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
    // Fungsi untuk menangani pencarian dan menyaring data
    function searchProjects() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".table");
        tr = table.getElementsByTagName("tr");
        
        // Loop melalui semua baris tabel, sembunyikan yang tidak cocok dengan pencarian
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0]; // Kolom pertama adalah nama aplikasi
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    // Tambahkan event listener untuk memanggil fungsi pencarian saat input berubah
    document.getElementById("searchInput").addEventListener("input", searchProjects);
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

<script>
    function deleteProject(id) {
        if (confirm('Apakah Anda yakin ingin menghapus proyek ini?')) {
            fetch('{{ route('projects.delete', ['id' => ':id']) }}'.replace(':id', id), {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Hapus baris tabel setelah penghapusan berhasil
                document.getElementById('project-row-' + id).remove();
                console.log(data.message);
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
        }
    }
</script>


<script>
    function toggleVisibility(button, id) {
        var hidden = button.dataset.hidden === 'true';

        // Kirim request AJAX untuk memperbarui status hidden di database
        updateHiddenStatus(id, !hidden);

        // Perbarui status tombol
        button.dataset.hidden = (!hidden).toString();
        button.innerText = (!hidden) ? 'Sembunyikan' : 'Tampilkan';
        button.classList.remove(hidden ? 'btn-danger' : 'btn-success');
        button.classList.add((!hidden) ? 'btn-danger' : 'btn-success');
    }

    function updateHiddenStatus(id, hidden) {
        // Kirim request POST ke URL yang sesuai dengan endpoint Anda untuk mengubah status hidden
        fetch('{{ route('project.hidden', ['id' => ':id']) }}'.replace(':id', id), {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message);
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
    }
</script>
@endpush
