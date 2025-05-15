<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Help Keep Our Homes Clean')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('images/login.png') }}" rel="icon" type="image/png">
    
    <style>
        .min-h-screen {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
        }
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                              url('{{ asset('images/cleanup-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
        .service-icon {
            color: #4CAF50;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .btn-primary {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }
        .btn-primary:hover {
            background-color: #45a049;
            border-color: #45a049;
        }
        .bg-primary {
            background-color: #4CAF50 !important;
        }
        .text-success {
            color: #4CAF50 !important;
        }
        .bg-success {
            background-color: #4CAF50 !important;
        }
        .border-success {
            border-color: #4CAF50 !important;
        }
        .hover-opacity:hover {
            opacity: 0.8;
        }
        .card {
            transition: transform 0.3s ease;
        }

        .btn-success {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }
        .btn-success:hover {
            background-color: #45a049;
            border-color: #45a049;
        }
    </style>
</head>
<body class="min-h-screen">
    @include('partial.navbar')

<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Riwayat Sampah</span>
                        <a href="{{ route('waste-record.create') }}" class="btn btn-sm btn-primary">Tambah Catatan Baru</a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Filter Form -->
                        <div class="mb-4">
                            <form method="GET" action="{{ route('waste-record.index') }}" class="row g-3">
                                <!-- Filter Tanggal -->
                                <div class="col-md-3">
                                    <label for="date" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="date" name="date" value="{{ request('date') }}">
                                </div>

                                <!-- Filter Kategori Sampah -->
                                <div class="col-md-3">
                                    <label for="category" class="form-label">Kategori</label>
                                    <select class="form-select" id="category" name="category">
                                        <option value="">Semua Kategori</option>
                                        <option value="organik" {{ request('category') == 'organik' ? 'selected' : '' }}>Organik</option>
                                        <option value="anorganik" {{ request('category') == 'anorganik' ? 'selected' : '' }}>Anorganik</option>
                                        <option value="lainnya" {{ request('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        <option value="b3" {{ request('category') == 'b3' ? 'selected' : '' }}>B3 (Bahan Berbahaya dan Beracun)</option> <!-- New Option -->
                                    </select>
                                </div>

                                <!-- Tombol Filter dan Reset -->
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-secondary me-2">Filter</button>
                                    <a href="{{ route('waste-record.index') }}" class="btn btn-outline-secondary">Reset</a>
                                </div>
                            </form>
                        </div>

                        <!-- Tabel Riwayat Sampah -->
                        @if($wasteRecords->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Kategori</th>
                                            <th>Berat (Kantong)</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($wasteRecords as $wasteRecord)
                                            <tr>
                                                <td>{{ $wasteRecord->date->format('d/m/Y') }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $wasteRecord->category == 'organik' ? 'success' : 
                                                        ($wasteRecord->category == 'anorganik' ? 'danger' : 
                                                        ($wasteRecord->category == 'b3' ? 'dark' : 'warning')) }}">
                                                        {{ $wasteRecord->category_name }}
                                                    </span>
                                                </td>
                                                <td>{{ $wasteRecord->weight }} kantong</td>
                                                <td>{{ $wasteRecord->description ?? '-' }}</td>
                                                <td>
                                                    <div class="action-btns">
                                                        <a href="{{ route('waste-record.edit', $wasteRecord) }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                                                        <form action="{{ route('waste-record.destroy', $wasteRecord) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                {{ $wasteRecords->links() }}
                            </div>
                        @else
                            <div class="alert alert-info text-center">
                                Belum ada data sampah yang tercatat.
                                <a href="{{ route('waste-record.create') }}" class="alert-link">Tambah catatan baru</a>!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>