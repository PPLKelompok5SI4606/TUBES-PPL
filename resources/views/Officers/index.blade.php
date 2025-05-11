@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Petugas</h2>
        <button class="btn btn-success" onclick="openAddModal()">
            <i class="bi bi-plus"></i> Tambah Petugas
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Petugas</th>
                    <th>Area Tugas</th>
                    <th>Hari Tugas</th>
                    <th>Kontak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($officers as $index => $officer)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $officer->name }}</td>
                    <td>{{ $officer->area }}</td>
                    <td>{{ $officer->schedule_days }}</td>
                    <td>{{ $officer->phone }}</td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="showDetails({{ $officer->id }})">
                            Lihat Detail
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Officer Modal -->
    <div class="modal fade" id="addOfficerModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Petugas Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('officers.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Petugas</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>No. Telepon</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Area Tugas</label>
                            <select name="area" class="form-control" required>
                                @foreach($collectionPoints as $point)
                                    <option value="{{ $point->name }}">{{ $point->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Jenis Kelamin</label>
                            <select name="gender" class="form-control" required>
                                <option value="male">Laki-laki</option>
                                <option value="female">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Hari Tugas</label>
                            <input type="text" name="schedule_days" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Petugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>Nama:</strong>
                        <p id="detail-name"></p>
                    </div>
                    <div class="mb-3">
                        <strong>Area Tugas:</strong>
                        <p id="detail-area"></p>
                    </div>
                    <div class="mb-3">
                        <strong>Jadwal:</strong>
                        <p id="detail-schedule"></p>
                    </div>
                    <div class="mb-3">
                        <strong>Kontak:</strong>
                        <p id="detail-contact"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openAddModal() {
    new bootstrap.Modal(document.getElementById('addOfficerModal')).show();
}

function showDetails(officerId) {
    fetch(`/officers/${officerId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('detail-name').textContent = data.name;
            document.getElementById('detail-area').textContent = data.area;
            document.getElementById('detail-schedule').textContent = data.schedule_days;
            document.getElementById('detail-contact').textContent = `${data.phone} | ${data.email}`;
            new bootstrap.Modal(document.getElementById('detailModal')).show();
        });
}
</script>
@endpush
@endsection