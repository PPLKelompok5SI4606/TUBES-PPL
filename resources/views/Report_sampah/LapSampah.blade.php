<!DOCTYPE html>
<html lang="en">
<!-- Add this in the head section -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laporan Sampah - Cleansweep')</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Add these styles in the head section -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #81C974;
            padding: 15px;
            color: white;
            display: flex;
            align-items: center;
        }
        .header img {
            width: 40px;
            height: 40px;
            margin-right: 15px;
        }
        .profile-section {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .profile-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #81C974;
        }
        .report-button {
            background-color: #81C974;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th {
            background-color: #81C974;
            color: black;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 250px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 4px;
            margin-top: 2px;
        }
        
        .dropdown-content a {
            color: #000;
            padding: 8px 16px;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #eee;
        }

        .dropdown-content a:last-child {
            border-bottom: none;
        }
        
        .dropdown-content a:hover {
            background-color: #f8f9fa;
        }zz
        
        .status-description {
            font-size: 12px;
            color: #666;
            margin-top: 4px;
        }

        .action-button {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 200px;
        }

        .action-button:after {
            content: '▼';
            margin-left: 8px;
            font-size: 12px;
        }

        .status-pending { color: #856404; background-color: #fff3cd; }
        .status-in-progress { color: #004085; background-color: #cce5ff; }
        .status-resolved { color: #155724; background-color: #d4edda; }
        .submit-button {
            background-color: #81C974;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #81C974;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">CleanSweep</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('laporan') }}">Laporan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('waste-collection') }}">Clean Collection</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex gap-2">
                @auth
                    <div class="dropdown">
                        <button class="btn btn-link text-white text-decoration-none dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('auth.pengelola.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-light">Sign Up</a>
                @endauth
            </div>
        </div>
    </nav>
    
    @push('styles')
    <style>
        .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .dropdown-item {
            padding: 0.5rem 1rem;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #4B7F52;
        }
        
        .btn-link {
            color: white;
            text-decoration: none;
        }
        
        .btn-link:hover {
            color: rgba(255, 255, 255, 0.8);
        }
    </style>
    @endpush    
    <!-- Replace the existing table section with this -->
    <div style="padding: 20px;">
        <table>
            <thead>
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
                    <td>{{ ucfirst($report->status) }}</td>
                    <td>
                        <button onclick="openModal({{ $report->id }})" class="btn btn-primary">
                            Update Status
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Add this modal form -->
    <!-- Update the modal styles -->
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
    
    <!-- Update the modal HTML structure -->
    <div id="statusModal" class="modal">
        <div class="modal-content">
            <h2 class="modal-title">Update Status Laporan</h2>
            <form id="updateStatusForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="reportId" name="report_id">
                
                <!-- Replace the location input with this dropdown -->
                <div class="form-group">
                    <label for="location">Lokasi Pembuangan</label>
                    <select id="location" name="location" required>
                      
    
                        <!-- TPS Options -->
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
    
    <!-- Update the JavaScript section -->
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
            const statusValue = document.getElementById('status').value;
    
            fetch(`/waste-reports/${reportId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the status in the table
                    const statusCell = document.querySelector(`tr[data-report-id="${reportId}"] td:nth-child(5)`);
                    if (statusCell) {
                        statusCell.textContent = statusValue.charAt(0).toUpperCase() + statusValue.slice(1);
                        
                        // Update status cell styling
                        statusCell.className = ''; // Remove existing status classes
                        statusCell.classList.add(`status-${statusValue.replace('_', '-')}`);
                    }
                    closeModal();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to update status. Please try again.');
            });
        });
    </script>
    <!-- Update the footer section -->
    <footer class="bg-success" style="background-color: #81C974 !important; padding: 10px 0; position: fixed; bottom: 0; width: 100%;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-bold">CleanSweep</span>
                            <span class="mx-2">|</span>
                            <span>Making our world cleaner, one waste at a time.</span>
                        </div>
                        <div>
                            <span>© 2025 CleanSweep. All rights reserved.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>