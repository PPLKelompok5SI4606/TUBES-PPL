<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jadwal Pengangkutan</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .btn-success {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }
        .btn-success:hover {
            background-color: #45a049;
            border-color: #45a049;
        }
        .bg-success {
            background-color: #4CAF50 !important;
        }
        .text-success {
            color: #4CAF50 !important;
        }
    </style>
</head>
<body class="min-h-screen">
    @include('partial.navbar')

    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Jadwal Pengangkutan</h1>
            <p class="lead">Lihat jadwal pengangkutan sampah yang telah dijadwalkan untuk area Anda.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h3 class="card-title mb-0">Daftar Jadwal Pengangkutan</h3>
                    </div>
                    <div class="card-body">
                        @if($jadwals->isEmpty())
                            <div class="text-center py-4">
                                <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                                <p class="mt-3 text-muted">Belum ada jadwal pengangkutan yang tersedia.</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Lokasi</th>
                                            <th>Petugas</th>
                                            <th>Kontak</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jadwals as $jadwal)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d F Y') }}</td>
                                                <td>{{ $jadwal->waktu }}</td>
                                                <td>{{ $jadwal->lokasi }}</td>
                                                <td>{{ $jadwal->nama_petugas }}</td>
                                                <td>{{ $jadwal->no_kontak }}</td>
                                                <td>{{ $jadwal->keterangan ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $jadwals->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-success text-white py-5 mt-auto">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h3 class="h5 mb-3">About Us</h3>
                    <p class="mb-0">We're dedicated to keeping our communities clean and environmentally friendly.</p>
                </div>
                <div class="col-md-4">
                    <h3 class="h5 mb-3">Contact</h3>
                    <p class="mb-0">Email: info@cleansweep.com<br>Phone: (123) 456-7890</p>
                </div>
                <div class="col-md-4">
                    <h3 class="h5 mb-3">Follow Us</h3>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white text-decoration-none">Facebook</a>
                        <a href="#" class="text-white text-decoration-none">Twitter</a>
                        <a href="#" class="text-white text-decoration-none">Instagram</a>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-4 border-top border-light text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Clean Homes Initiative. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 