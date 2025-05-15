@extends('Report_sampah.layout')

@section('content')
<!-- Styles -->
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .modal-content {
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .modal-header {
        background-color: #f8f9fa;
        border-radius: 15px 15px 0 0;
        padding: 1.5rem;
    }
    
    .modal-body {
        padding: 2rem;
    }
    
    .modal-footer {
        padding: 1.5rem;
        border-top: 1px solid #eee;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        padding: 0.75rem;
        border: 1px solid #dee2e6;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #81C974;
        box-shadow: 0 0 0 0.2rem rgba(129, 201, 116, 0.25);
    }
    
    .btn-success {
        background-color: #81C974;
        border-color: #81C974;
    }
    
    .btn-success:hover {
        background-color: #6db162;
        border-color: #6db162;
    }
    
    .modal-title {
        font-weight: 600;
        color: #2c3e50;
    }
    
    .form-label {
        font-weight: 500;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }
</style>
@endpush

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex align-items-center mb-4">
        <i class="bi bi-people fs-3 me-2"></i>
        <h2 class="mb-0">Daftar Petugas</h2>
        <button class="btn btn-success ms-auto rounded-pill px-4" onclick="openAddModal()">
            + Tambah Petugas
        </button>
    </div>

    <!-- Table Card -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Petugas</th>
                            <th>Area Tugas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($officers as $index => $officer)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $officer->name }}</td>
                            <td>{{ $officer->area }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" onclick="showDetails({{ $officer->id }})">
                                    <i class="bi bi-eye"></i> Lihat Detail
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

<!-- Modals -->
<div class="modal fade" id="addOfficerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; padding: 20px;">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-person-plus me-2"></i>Tambah Petugas Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('officers.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <label class="form-label">Nama Petugas</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama petugas" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Area Tugas</label>
                        <select name="area" class="form-select" required>
                            <option value="">Pilih area tugas</option>
                            <!-- TPA Options -->
                            <optgroup label="TPA (Tempat Pembuangan Akhir)">
                                <option value="TPA Sarimukti">TPA Sarimukti</option>
                                <option value="TPA Jelekong">TPA Jelekong</option>
                            </optgroup>
                            <!-- TPS Options -->
                            <optgroup label="TPS (Tempat Pembuangan Sementara)">
                                <option value="TPS Ciroyom">TPS Ciroyom</option>
                                <option value="TPS Balubur">TPS Balubur</option>
                                <option value="TPS Cicadas">TPS Cicadas</option>
                                <option value="TPS Soekarno-Hatta">TPS Soekarno-Hatta</option>
                                <option value="TPS Cibeunying">TPS Cibeunying</option>
                                <option value="TPS Cijerah">TPS Cijerah</option>
                                <option value="TPS Cibiru">TPS Cibiru</option>
                                <option value="TPS Gedebage">TPS Gedebage</option>
                                <option value="TPS Leuwigajah">TPS Leuwigajah</option>
                                <option value="TPS Pasir Impun">TPS Pasir Impun</option>
                                <option value="TPS 3R Antapani">TPS 3R Antapani</option>
                                <option value="TPS Babakan Sari">TPS Babakan Sari</option>
                                <option value="TPS Terpadu Babakan Sari">TPS Terpadu Babakan Sari</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Hari Tugas</label>
                        <input type="text" name="schedule_days" class="form-control" placeholder="Contoh: Senin, Rabu, Jumat" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="phone" class="form-control" placeholder="Contoh: 08123456789" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Contoh: petugas@email.com" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="gender" class="form-select" required>
                            <option value="">Pilih jenis kelamin</option>
                            <option value="male">Laki-laki</option>
                            <option value="female">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4">Simpan</button>
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
                    <strong>Hari Tugas:</strong>
                    <p id="detail-schedule"></p>
                </div>
                <div class="mb-3">
                    <strong>No. Telepon:</strong>
                    <p id="detail-phone"></p>
                </div>
                <div class="mb-3">
                    <strong>Email:</strong>
                    <p id="detail-email"></p>
                </div>
                <div class="mb-3">
                    <strong>Alamat Petugas:</strong>
                    <p id="detail-address"></p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    window.openAddModal = function() {
        var modal = new bootstrap.Modal(document.getElementById('addOfficerModal'));
        modal.show();
    }

    window.showDetails = function(officerId) {
        fetch(`/officers/${officerId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('detail-name').textContent = data.name;
                document.getElementById('detail-area').textContent = data.area;
                document.getElementById('detail-schedule').textContent = data.schedule_days;
                document.getElementById('detail-phone').textContent = data.phone;
                document.getElementById('detail-email').textContent = data.email;
                document.getElementById('detail-address').textContent = data.address;
                var detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
                detailModal.show();
            });
    }
});
</script>
@endpush
@endsection