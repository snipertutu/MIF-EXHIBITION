@extends('layout.master-mhs')

@push('plugin-styles')
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
                              <th>Ketua Kelompok</th>
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
                              <td>{{ $project->ketua_kelompok }}</td>
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
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-4">
                          <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                          <div class="form-group">
                              <label for="nama_aplikasi">Nama Aplikasi</label>
                              <input type="text" class="form-control" id="nama_aplikasi" name="nama_aplikasi" placeholder="Nama Aplikasi" required>
                          </div>
                          <div class="form-group">
                              <label for="semester">Semester</label>
                              <input type="text" class="form-control" id="semester" name="semester" placeholder="Semester" required>
                          </div>
                          <div class="form-group">
                              <label for="angkatan">Angkatan</label>
                              <input type="text" class="form-control" id="angkatan" name="angkatan" placeholder="Angkatan" required>
                          </div>
                          <div class="form-group">
                              <label for="golongan">Golongan</label>
                              <input type="text" class="form-control" id="golongan" name="golongan" placeholder="Golongan" required>
                          </div>
                          <div class="form-group">
                              <label for="ketua_kelompok">Ketua Kelompok</label>
                              <input type="text" class="form-control" id="ketua_kelompok" name="ketua_kelompok" placeholder="Ketua Kelompok" required>
                          </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="kategori">Kategori Project</label>
                            <select class="form-control" id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Tugas Akhir">Tugas Akhir</option>
                                <option value="Workshop">Workshop</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="anggota">Anggota</label>
                            <input type="text" class="form-control" id="nim_anggota" placeholder="Cari anggota berdasarkan NIM">
                            <select class="form-control" id="nim_anggota_list" name="anggota[]" multiple style="display: none;"></select>
                            <div id="result"></div>
                        </div>
                        <div class="form-group">
                            <label for="git">GIT</label>
                            <input type="text" class="form-control" id="git" name="git" placeholder="Link GIT" required>
                        </div>
                        <div class="form-group">
                            <label for="link_github">Link Github</label>
                            <input type="text" class="form-control" id="link_github" name="link_github" placeholder="Link Github" required>
                        </div>
                        <div class="form-group">
                            <label for="link_youtube">Link Youtube</label>
                            <input type="text" class="form-control" id="link_youtube" name="link_youtube" placeholder="Link youtube" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="gambar_1">Gambar 1</label>
                              <input type="file" class="form-control-file" id="gambar_1" name="gambar_1" required>
                          </div>
                          <div class="form-group">
                              <label for="gambar_2">Gambar 2</label>
                              <input type="file" class="form-control-file" id="gambar_2" name="gambar_2" required>
                          </div>
                          <div class="form-group">
                              <label for="gambar_3">Gambar 3</label>
                              <input type="file" class="form-control-file" id="gambar_3" name="gambar_3" required>
                          </div>
                          <div class="form-group">
                              <label for="gambar_4">Gambar 4</label>
                              <input type="file" class="form-control-file" id="gambar_4" name="gambar_4" required>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button id="addButton" type="submit" class="btn btn-primary">Tambah</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </form>

        </div>
    </div>
</div>


<!-- Edit Proyek Modal -->
@foreach($projects as $project)
<div class="modal fade" id="editProjectModal{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="editProjectModalLabel{{ $project->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
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
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_nama_aplikasi{{ $project->id }}">Nama Aplikasi</label>
                                <input type="text" class="form-control" id="edit_nama_aplikasi{{ $project->id }}" name="nama_aplikasi" value="{{ $project->nama_aplikasi }}">
                            </div>
                            <div class="form-group">
                                <label for="edit_semester{{ $project->id }}">Semester</label>
                                <input type="text" class="form-control" id="edit_semester{{ $project->id }}" name="semester" value="{{ $project->semester }}">
                            </div>
                            <div class="form-group">
                                <label for="edit_angkatan{{ $project->id }}">Angkatan</label>
                                <input type="text" class="form-control" id="edit_angkatan{{ $project->id }}" name="angkatan" value="{{ $project->angkatan }}">
                            </div>
                            <div class="form-group">
                                <label for="edit_golongan{{ $project->id }}">Golongan</label>
                                <input type="text" class="form-control" id="edit_golongan{{ $project->id }}" name="golongan" value="{{ $project->golongan }}">
                            </div>
                            <div class="form-group">
                                <label for="edit_ketua_kelompok{{ $project->id }}">Ketua Kelompok</label>
                                <input type="text" class="form-control" id="edit_ketua_kelompok{{ $project->id }}" name="ketua_kelompok" value="{{ $project->ketua_kelompok }}">
                            </div>
                            <div class="form-group">
                                <label for="edit_ketua_kelompok{{ $project->id }}">Kategori Project</label>
                                <input type="text" class="form-control" id="kategori{{ $project->id }}" name="kategori" value="{{ $project->kategori }}">
                            </div>
                            <div class="form-group">
                                <label for="edit_ketua_kelompok{{ $project->id }}">Anggota</label>
                                <input type="text" class="form-control" id="anggota{{ $project->id }}" name="anggota" value="{{ $project->anggota }}">
                            </div>
                            <div class="form-group">
                                <label for="edit_ketua_kelompok{{ $project->id }}">GIT</label>
                                <input type="text" class="form-control" id="git{{ $project->id }}" name="git" value="{{ $project->git }}">
                            </div>
                            <div class="form-group">
                                <label for="edit_link_github{{ $project->id }}">Link Github</label>
                                <input type="text" class="form-control" id="edit_link_github{{ $project->id }}" name="link_github" value="{{ $project->link_github }}">
                            </div>
                            <div class="form-group">
                                <label for="link_youtube{{ $project->id }}">Link youtube</label>
                                <input type="text" class="form-control" id="edit_link_youtube{{ $project->id }}" name="link_youtube" value="{{ $project->link_youtube }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_gambar_1{{ $project->id }}">Gambar 1</label>
                                <input type="file" class="form-control-file" id="edit_gambar_1{{ $project->id }}" name="gambar_1">
                            </div>
                            <div class="form-group">
                                <label for="edit_gambar_2{{ $project->id }}">Gambar 2</label>
                                <input type="file" class="form-control-file" id="edit_gambar_2{{ $project->id }}" name="gambar_2">
                            </div>
                            <div class="form-group">
                                <label for="edit_gambar_3{{ $project->id }}">Gambar 3</label>
                                <input type="file" class="form-control-file" id="edit_gambar_3{{ $project->id }}" name="gambar_3">
                            </div>
                            <div class="form-group">
                                <label for="edit_gambar_4{{ $project->id }}">Gambar 4</label>
                                <input type="file" class="form-control-file" id="edit_gambar_4{{ $project->id }}" name="gambar_4">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="editButton{{ $project->id }}" type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


<script>
    $(document).ready(function() {
        $('.edit-project-btn').click(function() {
            var projectId = $(this).data('project-id');
            $('#editProjectModal' + projectId).modal('show');
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var kategoriSelect = document.getElementById('kategori');
        var anggotaInput = document.getElementById('nim_anggota');
        var anggotaList = document.getElementById('nim_anggota_list');
        
        // Event listener untuk memantau perubahan pada select kategori
        kategoriSelect.addEventListener('change', function() {
            var selectedCategory = kategoriSelect.value;
            if(selectedCategory === 'Tugas Akhir') {
                anggotaInput.setAttribute('disabled', 'disabled');
                anggotaList.setAttribute('disabled', 'disabled');
            } else {
                anggotaInput.removeAttribute('disabled');
                anggotaList.removeAttribute('disabled');
            }
        });
        
        // Event listener untuk memantau input pada form anggota
        anggotaInput.addEventListener('input', function() {
            var inputNim = anggotaInput.value;
            // Lakukan pencarian atau validasi nim disini
            // Misalnya, hasil pencarian disimpan dalam sebuah array
            var matchedMembers = [
                { nim: '123456', name: 'Nama Mahasiswa 1' },
                { nim: '234567', name: 'Nama Mahasiswa 2' },
                // Daftar anggota lainnya...
            ];

            // Tampilkan opsi nim anggota yang sesuai
            anggotaList.innerHTML = '';
            matchedMembers.forEach(function(member) {
                var option = document.createElement('option');
                option.value = member.nim;
                option.textContent = member.nim + ' - ' + member.name;
                anggotaList.appendChild(option);
            });
        });
        
        // Event listener untuk memilih anggota dari opsi yang muncul
        anggotaList.addEventListener('change', function() {
            // Tambahkan nim yang dipilih ke dalam input form anggota
            var selectedNim = anggotaList.value;
            anggotaInput.value += (anggotaInput.value ? ', ' : '') + selectedNim;
        });
    });
</script>




@endsection


@push('plugin-scripts')
@endpush


@section('custom-scripts')
@endsection


