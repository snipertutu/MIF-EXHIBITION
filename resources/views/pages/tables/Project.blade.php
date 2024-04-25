@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Table Project</h4>
                <p class="card-description">Data Project</p>
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

@endsection
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


@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush
