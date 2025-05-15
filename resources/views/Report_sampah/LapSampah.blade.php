@extends('Report_sampah.layout')

@section('content')
<!-- Add meta tags and custom styles -->
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<!-- Content section -->
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="d-flex align-items-center mb-4">
        <i class="bi bi-trash fs-3 me-2"></i>
        <h2 class="mb-0">Laporan Sampah</h2>
    </div>
</div>

<!-- Table section -->
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>No.</th>
                            <th>Lokasi</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wasteReports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->location }}</td>
                            <td>{{ $report->description }}</td>
                            <td>{{ $report->created_at->format('d F Y') }}</td>
                            <td>
                                <span class="badge rounded-pill bg-{{ $report->status == 'pending' ? 'warning' : ($report->status == 'in_progress' ? 'primary' : 'success') }}">
                                    {{ ucfirst($report->status) }}
                                </span>
                            </td>
                            <td>
                                <button onclick="openModal({{ $report->id }})" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-square"></i> Update
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

<!-- Modal styles -->
<style>
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .modal-content {
        background: #fff;
        margin: 5% auto;
        padding: 20px;
        width: 90%;
        max-width: 500px;
        border: 1px solid #ddd;
    }

    .modal-title {
        font-size: 24px;
        margin-bottom: 20px;
        font-weight: normal;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-style: italic;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 5px;
        border: 1px solid #ccc;
    }

    .button-group {
        text-align: right;
        margin-top: 20px;
    }

    .btn-cancel,
    .btn-save {
        padding: 8px 20px;
        margin-left: 10px;
        cursor: pointer;
    }

    .btn-cancel {
        background: #6c757d;
        color: white;
        border: none;
    }

    .btn-save {
        background: #28a745;
        color: white;
        border: none;
    }
</style>

<!-- Modal structure -->
<div id="statusModal" class="modal">
    <div class="modal-content">
        <h2 class="modal-title">Update Status Laporan</h2>
        <form id="updateStatusForm" method="POST">
            @csrf
            <input type="hidden" id="reportId" name="report_id">
            
            <div class="form-group">
                <label for="location">Lokasi Pembuangan</label>
                <select id="location" name="location" required>
                    <option value="">-- Pilih Lokasi --</option>
                    
                    @foreach($tpsPoints as $site)
                        <option value="{{ $site->nama }}">{{ $site->nama }} ({{ $site->tipe }})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="total_waste">Total Waste (kg)</label>
                <input type="number" id="total_waste" name="total_waste" step="0.01" value="0.00" required>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select id="type" name="type" required>
                    <option value="TPA">TPA</option>
                    <option value="TPS">TPS</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="pending">Pending - Laporan baru, menunggu penanganan</option>
                    <option value="in_progress">In Progress - Laporan sedang ditangani</option>
                    <option value="resolved">Resolved - Laporan telah selesai ditangani</option>
                </select>
            </div>

            <div class="button-group">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal JavaScript -->
<script>
    function openModal(reportId) {
        document.getElementById('reportId').value = reportId;
        document.getElementById('statusModal').style.display = 'block';
        
        // Fetch existing data and populate form
        fetch(`/api/waste-reports/${reportId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('location').value = data.location || '';
                document.getElementById('total_waste').value = data.total_waste || '';
                document.getElementById('type').value = data.type || 'TPS';
                document.getElementById('status').value = data.status || 'pending';
            });
    }

    function closeModal() {
        document.getElementById('statusModal').style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target == document.getElementById('statusModal')) {
            closeModal();
        }
    }

    // Handle form submission
    document.getElementById('updateStatusForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const reportId = document.getElementById('reportId').value;
        const formData = new FormData(this);

        // Add the CSRF token to the form data
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

        fetch(`/waste-reports/${reportId}/update-with-collection`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Status updated and collection recorded successfully!');
                window.location.reload(); // Reload to see changes
            } else {
                alert('Failed to update: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update status. Please try again.');
        });
    });
</script>

<!-- Footer Section -->
<style>
    .footer {
        background-color: #28a745;
        color: white;
        padding: 1rem 0;
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
    }
    
    .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Add padding to main content to prevent overlap with fixed footer */
    body {
        padding-bottom: 60px;
    }
</style>

<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div>
                <p class="mb-0">Cleansweep Initiative</p>
                <small>Making our world cleaner, one waste at a time.</small>
            </div>
            <div>
                <small>© {{ date('Y') }} Cleansweep. All rights reserved.</small>
            </div>
        </div>
    </div>
</footer>
@endsection