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
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                              url('{{ asset('images/cleanup-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 0;
            position: relative;
        }
        .hero-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(to bottom, transparent, white);
        }
        .btn-success {
            background-color: #4CAF50;
            border-color: #4CAF50;
            transition: all 0.3s ease;
        }
        .btn-success:hover {
            background-color: #45a049;
            border-color: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .bg-success {
            background-color: #4CAF50 !important;
        }
        .text-success {
            color: #4CAF50 !important;
        }
        .schedule-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .schedule-card:hover {
            transform: translateY(-5px);
        }
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }
        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            padding: 15px;
        }
        .table td {
            padding: 15px;
            vertical-align: middle;
        }
        .table tbody tr {
            transition: background-color 0.3s ease;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
        }
        .pagination {
            margin-top: 2rem;
        }
        .pagination .page-link {
            color: #4CAF50;
            border: 1px solid #dee2e6;
            margin: 0 2px;
            border-radius: 5px;
        }
        .pagination .page-item.active .page-link {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }
        .empty-state {
            padding: 3rem 0;
        }
        .empty-state i {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 1rem;
        }
        .info-box {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 4px solid #4CAF50;
        }
    </style>
</head>
<body class="min-h-screen">
    @include('partial.navbar')

    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Jadwal Pengangkutan</h1>
                    <p class="lead mb-0">Lihat jadwal pengangkutan sampah yang telah dijadwalkan untuk area Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="info-box">
                    <h5 class="mb-3"><i class="bi bi-info-circle me-2"></i>Informasi Jadwal</h5>
                    <p class="mb-0">Jadwal pengangkutan sampah diurutkan berdasarkan tanggal terbaru. Pastikan untuk memeriksa jadwal secara berkala untuk informasi terbaru.</p>
                </div>

                <div class="card schedule-card">
                    <div class="card-header bg-success text-white py-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar-check me-2"></i>
                            <h3 class="card-title mb-0">Daftar Jadwal Pengangkutan</h3>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @if($jadwals->isEmpty())
                            <div class="empty-state text-center">
                                <i class="bi bi-calendar-x"></i>
                                <h4 class="text-muted mt-3">Belum ada jadwal pengangkutan</h4>
                                <p class="text-muted">Saat ini belum ada jadwal pengangkutan yang tersedia. Silakan periksa kembali nanti.</p>
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
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-calendar-date text-success me-2"></i>
                                                        {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d F Y') }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-clock text-success me-2"></i>
                                                        {{ $jadwal->waktu }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-geo-alt text-success me-2"></i>
                                                        {{ $jadwal->lokasi }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-person text-success me-2"></i>
                                                        {{ $jadwal->nama_petugas }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-telephone text-success me-2"></i>
                                                        {{ $jadwal->no_kontak }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-dark">
                                                        {{ $jadwal->keterangan ?? '-' }}
                                                    </span>
                                                </td>
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