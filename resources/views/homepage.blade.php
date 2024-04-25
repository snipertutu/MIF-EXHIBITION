@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Banner</h4>
                    <button type="button" class="btn btn-success btn-fw" data-toggle="modal" data-target="#addHomepageModal">
                        <i class="mdi mdi-plus"></i>Tambah
                    </button>
                </div>
                <p class="card-description">Data Banner</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($banners as $banner)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $banner->title }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $banner->image_url) }}" alt="{{ $banner->title }}" width="100">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-icons btn-rounded" data-toggle="modal" data-target="#addHomepageModal">
                                                  <i class="mdi mdi-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-icons btn-rounded btn-danger delete-button" data-id="{{ $banner->id }}" data-toggle="modal" data-target="#deleteBannerModal">
                                                  <i class="mdi mdi-archive"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Tidak ada banner yang tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Proyek Modal -->
<div class="modal fade" id="addHomepageModal" tabindex="-1" role="dialog" aria-labelledby="addHomepageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addHomepageModalLabel">Tambah Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addProjectForm" action="{{ route('homepage.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Judul Banner</label>
                                <input type="text" class="form-control" id="nama_aplikasi" name="title" placeholder="Judul Banner" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image_url">Banner</label>
                        <input type="file" class="form-control-file" id="gambar" name="image_url" multiple required>
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

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteBannerModal" tabindex="-1" role="dialog" aria-labelledby="deleteBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBannerModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus banner ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<form id="deleteBannerForm" method="POST">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('plugin-scripts')
<script src="{{asset('assets/plugins/chartjs/chart.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
@endpush

@push('custom-scripts')

<script>
    $(document).ready(function(){
        $('.delete-button').click(function(){
            var id = $(this).data('id');
            var actionUrl = '/homepage/' + id;
            $('#deleteBannerForm').attr('action', actionUrl); // Update form action URL
            $('#deleteBannerModal').modal('show'); // Show the modal
        });

        $('#confirmDeleteButton').click(function(){
            $('#deleteBannerForm').submit(); // Submit the form for deletion
        });
    });
</script>





<script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
