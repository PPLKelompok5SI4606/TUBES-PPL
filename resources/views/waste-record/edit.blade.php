<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CleanSweep - Edit Catatan Sampah</title>
    <!-- Bootstrap CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
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
</head>
<body>
    <!-- Navbar dengan warna #4CAF50 -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4CAF50;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">CleanSweep</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/articles">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('waste-reports.index') }}">Waste Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('delay-reports.index') }}">Delay Reports</a>
                    </li>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                </ul>
                
                <div class="d-flex gap-2">
                    @auth
                        <a href="{{ route('user.dashboard') }}" class="btn btn-light me-2">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <a href="{{ route('pickup.create') }}" class="btn btn-light me-2">
                            <i class="bi bi-truck"></i> Request Pickup
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-link text-white text-decoration-none dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('pickup.index') }}">My Pickups</a></li>
                                <li><a class="dropdown-item" href="{{ route('waste-reports.index') }}">My Waste Reports</a></li>
                                <li><a class="dropdown-item" href="{{ route('delay-reports.index') }}">My Delay Reports</a></li>
                                <li><a class="dropdown-item" href="{{ route('waste-record.index') }}">Waste Record</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('auth.user.logout') }}">
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
        </div>
    </nav>

    <!-- Konten halaman -->
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Edit Catatan Sampah</span>
                            <a href="{{ route('waste-record.index') }}" class="btn btn-sm btn-secondary">Kembali ke Riwayat</a>
                        </div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('waste-record.update', $wasteRecord) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="date" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $wasteRecord->date->format('Y-m-d')) }}" required>
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">Kategori Sampah</label>
                                    <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="organik" {{ old('category', $wasteRecord->category) == 'organik' ? 'selected' : '' }}>Organik</option>
                                        <option value="anorganik" {{ old('category', $wasteRecord->category) == 'anorganik' ? 'selected' : '' }}>Anorganik</option>
                                        <option value="b3" {{ old('category', $wasteRecord->category) == 'b3' ? 'selected' : '' }}>B3 (Bahan Berbahaya dan Beracun)</option>
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="weight" class="form-label">Berat (Kantong)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight', $wasteRecord->weight ?? 1) }}" min="1" step="1" required>
                                        <span class="input-group-text">kantong</span>
                                    </div>
                                    <div class="form-text">Masukkan jumlah kantong sampah yang dihasilkan</div>
                                    @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi (Opsional)</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Misalnya: Sisa makanan, botol plastik, baterai bekas, dll">{{ old('description', $wasteRecord->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>