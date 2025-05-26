

@extends('Report_sampah.layout')

@section('title', 'Transfer Sampah - CleanSweep')

@push('styles')
<style>
    .page-title {
        color: #2d6a4f;
        margin-bottom: 0.3rem;
    }
    
    .page-subtitle {
        color: #52796f;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
    }
    
    /* Stats grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .stat-card {
        background: white;
        border-radius: 8px;
        padding: 1.2rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2d6a4f;
    }
    
    .stat-label {
        color: #52796f;
        font-size: 0.85rem;
    }
    
    /* Main content layout */
    .main-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .main-content {
            grid-template-columns: 1fr;
        }
    }
    
    /* Cards */
    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .card-header {
        background: #f8f9fa;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e9ecef;
    }
    
    .card-title {
        margin: 0;
        color: #2d6a4f;
        font-size: 1.2rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    /* Form elements */
    .form-group {
        margin-bottom: 1rem;
    }
    
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #2d6a4f;
    }
    
    .form-control {
        width: 100%;
        padding: 0.6rem 0.8rem;
        border: 1px solid #ced4da;
        border-radius: 4px;
        transition: border-color 0.15s ease-in-out;
    }
    
    .form-control:focus {
        outline: 0;
        border-color: #2d6a4f;
        box-shadow: 0 0 0 0.2rem rgba(45, 106, 79, 0.25);
    }
    
    .btn {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
        transition: background-color 0.15s ease-in-out;
    }
    
    .btn:hover {
        background-color: #4CAF50;
    }
    
    /* Alert styling */
    .alert {
        padding: 1rem;
        margin: 1rem 0;
        border-radius: 4px;
        display: none;
    }
    
    .alert.show {
        display: block;
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 4px solid #155724;
    }
    
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 4px solid #721c24;
    }
    
    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 3rem 0;
        color: #6c757d;
    }
    
    .empty-state-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
    
    /* Table styling */
    .transfer-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .transfer-table th,
    .transfer-table td {
        padding: 0.75rem 1rem;
        text-align: left;
    }
    
    .transfer-table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #2d6a4f;
        border-bottom: 2px solid #e9ecef;
    }
    
    .transfer-table tr {
        border-bottom: 1px solid #e9ecef;
    }
    
    .transfer-table tr:hover {
        background-color: #f8f9fa;
    }
    
    /* Status badge */
    .status-badge {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.85rem;
        font-weight: 500;
        background-color: #e9ecef;
    }
    
    /* Use classes instead of :contains pseudo-selector which isn't standard CSS */
    .status-badge.status-selesai {
        background-color: #d4edda;
        color: #155724;
    }
    
    .status-badge.status-proses {
        background-color: #fff3cd;
        color: #856404;
    }
</style>
@endpush

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            🚛 Transfer Sampah TPS ke TPA
        </h1>
        <p class="page-subtitle">Pencatatan perpindahan sampah dari Tempat Penampungan Sementara ke Tempat Pemrosesan Akhir</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number" id="totalTransferred">{{ $todayTransfers }}</div>
            <div class="stat-label">Total Dipindahkan Hari Ini (m³)</div>
        </div>
        <div class="stat-card">
            <div class="stat-number" id="todayTransfers">
                {{ $todayTransferCount }}
            </div>
            <div class="stat-label">Transfer Hari Ini</div>
        </div>
        <div class="stat-card">
            <div class="stat-number" id="totalTransferred">{{ $transferHistory->sum('waste_amount') }}</div>
            <div class="stat-label">Total Dipindahkan (m³)</div>
        </div>
        <div class="stat-card">
            <div class="stat-number" id="transferCount">{{ $transferHistory->count() }}</div>
            <div class="stat-label">Jumlah Transfer</div>
        </div>
        <div class="stat-card">
            <div class="stat-number" id="avgTransfer">
                {{ $transferHistory->count() > 0 ? round($transferHistory->sum('waste_amount') / $transferHistory->count(), 1) : 0 }}
            </div>
            <div class="stat-label">Rata-rata per Transfer (m³)</div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="main-content">
        <!-- Transfer Form Card -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Form Transfer Sampah TPS ke TPA</h2>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success show">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger show">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form id="transferForm" action="{{ route('waste-transfer.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="tps_id">TPS Asal</label>
                        <select class="form-control" name="tps_id" id="tps_id" required>
                            <option value="">Pilih TPS Asal</option>
                            @foreach($tpsLocations as $tps)
                                <option value="{{ $tps->id }}" data-capacity="{{ $tps->kapasitas_terisi }}">
                                    {{ $tps->nama }} ({{ $tps->kapasitas_terisi }} m³ terisi)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="tpa_id">TPA Tujuan</label>
                        <select class="form-control" name="tpa_id" id="tpa_id" required>
                            <option value="">Pilih TPA Tujuan</option>
                            @foreach($tpaLocations as $tpa)
                                <option value="{{ $tpa->id }}" data-available="{{ $tpa->kapasitas_total - $tpa->kapasitas_terisi }}">
                                    {{ $tpa->nama }} ({{ $tpa->kapasitas_total - $tpa->kapasitas_terisi }} m³ tersedia)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="waste_amount">Volume Sampah (m³)</label>
                        <input type="number" class="form-control" name="waste_amount" id="waste_amount" step="0.1" min="0.1" placeholder="0.0" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="waste_type">Jenis Sampah</label>
                        <select class="form-control" name="waste_type" id="waste_type" required>
                            <option value="">Pilih Jenis Sampah</option>
                            <option value="Organik">Organik</option>
                            <option value="Anorganik">Anorganik</option>
                            <option value="Campuran">Campuran</option>
                            <option value="B3 (Bahan Berbahaya Beracun)">B3 (Bahan Berbahaya Beracun)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="transfer_date">Tanggal & Waktu Transfer</label>
                        <input type="datetime-local" class="form-control" name="transfer_date" id="transfer_date" required>
                    </div>
                    
                    <button type="submit" class="btn">🚛 Catat Transfer Sampah</button>
                </form>

                <div id="transferAlert" class="alert"></div>
            </div>
        </div>

        <!-- Transfer Records -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Riwayat Transfer Sampah</h2>
            </div>
            <div class="card-body">
                <div id="transferRecords">
                    @if($transferHistory->isEmpty())
                        <div class="empty-state">
                            <div class="empty-state-icon">📋</div>
                            <p>Belum ada catatan transfer sampah</p>
                        </div>
                    @else
                        <table class="transfer-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>TPS Asal</th>
                                    <th>TPA Tujuan</th>
                                    <th>Volume (m³)</th>
                                    <th>Jenis</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transferHistory as $index => $transfer)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $transfer->tpsSource->nama }}</td>
                                        <td>{{ $transfer->tpaDestination->nama }}</td>
                                        <td><strong>{{ $transfer->waste_amount }}</strong></td>
                                        <td>{{ $transfer->waste_type }}</td>
                                        <td>{{ $transfer->transfer_date->format('d/m/Y') }}<br>
                                            <small style="color: #666;">{{ $transfer->transfer_date->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ strtolower($transfer->status) }}">
                                                {{ $transfer->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('transfer_date').value = new Date().toISOString().slice(0, 16);

        // Add validation for waste amount
        document.getElementById('waste_amount').addEventListener('input', function(e) {
            const tpsSelect = document.getElementById('tps_id');
            const tpaSelect = document.getElementById('tpa_id');
            const amount = parseFloat(e.target.value);
            
            if (tpsSelect.value) {
                const tpsCapacity = parseFloat(tpsSelect.selectedOptions[0].dataset.capacity);
                if (amount > tpsCapacity) {
                    showAlert('transferAlert', 'danger', `❌ Volume melebihi kapasitas TPS (${tpsCapacity} m³)`);
                    e.target.value = tpsCapacity;
                }
            }
            
            if (tpaSelect.value) {
                const tpaAvailable = parseFloat(tpaSelect.selectedOptions[0].dataset.available);
                if (amount > tpaAvailable) {
                    showAlert('transferAlert', 'danger', `❌ Volume melebihi kapasitas tersedia TPA (${tpaAvailable} m³)`);
                    e.target.value = tpaAvailable;
                }
            }
        });
    });

    function showAlert(elementId, type, message) {
        const alertElement = document.getElementById(elementId);
        alertElement.className = `alert alert-${type}`;
        alertElement.innerHTML = message;
        alertElement.classList.add('show');
        
        if (type === 'success') {
            setTimeout(() => hideAlert(elementId), 5000);
        }
    }

    function hideAlert(elementId) {
        const alertElement = document.getElementById(elementId);
        alertElement.classList.remove('show');
    }
</script>
@endpush