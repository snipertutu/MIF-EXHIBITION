@extends('layout.master')

@push('plugin-styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Table Mahasiswa</h4>
                <p class="card-description">Data Mahasiswa</p>
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
@endsection

@push('plugin-scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endpush

@push('custom-scripts')
<script>
    $(document).ready(function() {
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
    });
</script>
@endpush
