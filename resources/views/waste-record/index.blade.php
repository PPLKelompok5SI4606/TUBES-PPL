<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CleanSweep - Riwayat Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
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
        .action-btns {
            display: flex;
            gap: 5px;
        }
        .action-btns button {
            border-radius: 8px;
            padding: 8px 12px;
        }
        .btn-outline-primary {
            color: #0d6efd;
            border-color: #0d6efd;
        }
        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: white;
        }
        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }
        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4CAF50;">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">CleanSweep</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/articles">Articles</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('waste-reports.index') }}">Waste Reports</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('delay-reports.index') }}">Delay Reports</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
            </ul>
            <div class="d-flex gap-2">
                @auth
                    <a href="{{ route('user.dashboard') }}" class="btn btn-light me-2"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    <a href="{{ route('pickup.create') }}" class="btn btn-light me-2"><i class="bi bi-truck"></i> Request Pickup</a>
                    <div class="dropdown">
                        <button class="btn btn-link text-white dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('pickup.index') }}">My Pickups</a></li>
                            <li><a class="dropdown-item" href="{{ route('waste-reports.index') }}">My Waste Reports</a></li>
                            <li><a class="dropdown-item" href="{{ route('delay-reports.index') }}">My Delay Reports</a></li>
                            <li><a class="dropdown-item" href="{{ route('waste-record.index') }}">Waste Record</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('auth.user.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
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
    </div>
</nav>

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
