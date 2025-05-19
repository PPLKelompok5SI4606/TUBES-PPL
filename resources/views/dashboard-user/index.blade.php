<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Pengguna - CleanSweep</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('images/login.png') }}" rel="icon" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
        .text-success, .text-primary-green {
            color: #4CAF50 !important;
        }
        .bg-success {
            background-color: #4CAF50 !important;
        }
        .border-success, .border-primary-green {
            border-color: #4CAF50 !important;
        }
        .hover-opacity:hover {
            opacity: 0.8;
        }
        .card {
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn-success {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }
        .btn-success:hover {
            background-color: #45a049;
            border-color: #45a049;
        }
        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }
        .dashboard-card {
            transition: transform 0.3s ease;
            border-left: 4px solid #4CAF50;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: white;
            border-radius: 0.75rem;
        }
        .dashboard-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .card-icon {
            width: 3rem;
            height: 3rem;
            color: #4CAF50;
        }
        .bg-anorganik {
            background-color: #2196F3 !important;
        }
        .bg-b3 {
            background-color: #F44336 !important;
        }
        .border-anorganik {
            border-color: #2196F3 !important;
        }
        .border-b3 {
            border-color: #F44336 !important;
        }
        .text-anorganik {
            color: #2196F3 !important;
        }
        .text-b3 {
            color: #F44336 !important;
        }
    </style>
</head>
<body class="min-h-screen font-poppins">
    {{-- Navbar --}}
    @include('partial.navbar')

    <!-- Main Content -->
    <div class="container content py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0"><i class="bi bi-recycle text-success me-2"></i>Dashboard Pengelolaan Sampah</h1>
            <a href="{{ route('waste-record.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Catat Sampah Baru
            </a>
        </div>
        
        <!-- Statistik Utama -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="dashboard-card">
                    <div>
                        <h6 class="text-muted mb-1">Total Sampah Dikelola</h6>
                        <h3 class="mb-0 fw-bold">{{ number_format($totalWaste, 0) }} kantong</h3>
                    </div>
                    <div class="card-icon">
                        <i class="bi bi-trash-fill fs-1"></i>
                    </div>
                </div>
            </div>
            
            @php
                $organikWeight = 0;
                $anorganikWeight = 0;
                $b3Weight = 0;
                
                foreach ($wasteByCategory as $category) {
                    if (strtolower($category->category) === 'organik') {
                        $organikWeight = $category->total_weight;
                    } elseif (strtolower($category->category) === 'anorganik') {
                        $anorganikWeight = $category->total_weight;
                    } elseif (strtolower($category->category) === 'b3') {
                        $b3Weight = $category->total_weight;
                    }
                }
            @endphp
            
            <div class="col-md mb-3">
                <div class="dashboard-card" style="border-left-color: #4CAF50">
                    <div>
                        <h6 class="text-muted mb-1">Organik</h6>
                        <h3 class="mb-0 fw-bold">{{ number_format($organikWeight, 0) }} kantong</h3>
                    </div>
                    <div class="card-icon">
                        <i class="bi bi-egg-fill fs-1" style="color: #4CAF50"></i>
                    </div>
                </div>
            </div>

            <div class="col-md mb-3">
                <div class="dashboard-card" style="border-left-color: #2196F3">
                    <div>
                        <h6 class="text-muted mb-1">Anorganik</h6>
                        <h3 class="mb-0 fw-bold">{{ number_format($anorganikWeight, 0) }} kantong</h3>
                    </div>
                    <div class="card-icon">
                        <i class="bi bi-box-seam fs-1" style="color: #2196F3"></i>
                    </div>
                </div>
            </div>

            <div class="col-md mb-3">
                <div class="dashboard-card" style="border-left-color: #F44336">
                    <div>
                        <h6 class="text-muted mb-1">B3</h6>
                        <h3 class="mb-0 fw-bold">{{ number_format($b3Weight, 0) }} kantong</h3>
                    </div>
                    <div class="card-icon">
                        <i class="bi bi-exclamation-triangle fs-1" style="color: #F44336"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Grafik -->
        <div class="row mb-4">
            <div class="col-lg-8 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom border-success">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="bi bi-graph-up-arrow me-2 text-success"></i>Tren Sampah 6 Bulan Terakhir</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlySummaryChart" height="300"></canvas>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom border-success">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="bi bi-pie-chart-fill me-2 text-success"></i>Distribusi Kategori</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="categoryPieChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Grafik Mingguan per Kategori -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom border-success">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="bi bi-bar-chart-line me-2 text-success"></i>Sampah per Kategori (4 Minggu Terakhir)</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="weeklyTrendChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="mb-3 text-success"><i class="bi bi-recycle me-2"></i>CleanSweep</h5>
                    <p class="text-muted">Solusi pengelolaan sampah yang efisien dan ramah lingkungan untuk masa depan yang lebih bersih dan berkelanjutan.</p>
                </div>
                {{-- Removed Navigasi section --}}
                {{-- <div class="col-md-2 mb-3">
                    <h6 class="mb-3">Navigasi</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('user.dashboard') }}" class="text-decoration-none text-muted">Dashboard User</a></li>
                        <li class="mb-2"><a href="{{ route('waste-record.index') }}" class="text-decoration-none text-muted">Catatan Sampah</a></li>
                        <li class="mb-2"><a href="{{ route('waste-reports.index') }}" class="text-decoration-none text-muted">Laporan</a></li>

                    </ul>
                </div> --}}
            </div>
            <hr class="my-4">
            <div class="text-center text-muted">
                <small>&copy; 2025 CleanSweep. Hak Cipta Dilindungi.</small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap & Chart Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set warna sesuai tema CleanSweep
        const primaryColor = '#4CAF50';
        const secondaryColor = '#2196F3';
        const dangerColor = '#F44336';
        
        // Data untuk grafik bulanan
        const monthlySummaryChart = new Chart(
            document.getElementById('monthlySummaryChart'),
            {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Total Sampah (kantong)',
                        data: {!! json_encode($chartData) !!},
                        backgroundColor: 'rgba(76, 175, 80, 0.2)',
                        borderColor: primaryColor,
                        borderWidth: 2,
                        tension: 0.4,
                        pointBackgroundColor: primaryColor,
                        pointBorderColor: '#fff',
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Berat (kantong)',
                                font: {
                                    family: "'Poppins', sans-serif"
                                }
                            },
                            grid: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Bulan',
                                font: {
                                    family: "'Poppins', sans-serif"
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                font: {
                                    family: "'Poppins', sans-serif"
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.9)',
                            titleColor: '#000',
                            bodyColor: '#000',
                            titleFont: {
                                family: "'Poppins', sans-serif",
                                weight: 'bold'
                            },
                            bodyFont: {
                                family: "'Poppins', sans-serif"
                            },
                            borderColor: primaryColor,
                            borderWidth: 1,
                            padding: 12,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return `Total: ${context.raw} kantong`;
                                }
                            }
                        }
                    }
                }
            }
        );
        
        // Data untuk grafik pie kategori
        const categoryData = [
            {{ $organikWeight }}, 
            {{ $anorganikWeight }}, 
            {{ $b3Weight }}
        ];
        
        const categoryPieChart = new Chart(
            document.getElementById('categoryPieChart'),
            {
                type: 'doughnut',
                data: {
                    labels: ['Organik', 'Anorganik', 'B3'],
                    datasets: [{
                        data: categoryData,
                        backgroundColor: [
                            primaryColor,
                            secondaryColor,
                            dangerColor
                        ],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                font: {
                                    family: "'Poppins', sans-serif"
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.9)',
                            titleColor: '#000',
                            bodyColor: '#000',
                            titleFont: {
                                family: "'Poppins', sans-serif",
                                weight: 'bold'
                            },
                            bodyFont: {
                                family: "'Poppins', sans-serif"
                            },
                            borderColor: '#ccc',
                            borderWidth: 1,
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.raw} kantong`;
                                }
                            }
                        }
                    }
                }
            }
        );
        
        // Data untuk grafik mingguan per kategori
        const weeklyTrendChart = new Chart(
            document.getElementById('weeklyTrendChart'),
            {
                type: 'bar',
                data: {
                    labels: {!! isset($weeklyChartData['labels']) ? json_encode($weeklyChartData['labels']) : '["Minggu 1", "Minggu 2", "Minggu 3", "Minggu 4"]' !!},
                    datasets: [
                        {
                            label: 'Organik',
                            data: {!! isset($weeklyChartData['organik']) ? json_encode($weeklyChartData['organik']) : '[0, 0, 0, 0]' !!},
                            backgroundColor: primaryColor,
                            borderRadius: 4
                        },
                        {
                            label: 'Anorganik',
                            data: {!! isset($weeklyChartData['anorganik']) ? json_encode($weeklyChartData['anorganik']) : '[0, 0, 0, 0]' !!},
                            backgroundColor: secondaryColor,
                            borderRadius: 4
                        },
                        {
                            label: 'B3',
                            data: {!! isset($weeklyChartData['b3']) ? json_encode($weeklyChartData['b3']) : '[0, 0, 0, 0]' !!},
                            backgroundColor: dangerColor,
                            borderRadius: 4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Berat (kantong)',
                                font: {
                                    family: "'Poppins', sans-serif"
                                }
                            },
                            grid: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Minggu',
                                font: {
                                    family: "'Poppins', sans-serif"
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                padding: 20,
                                font: {
                                    family: "'Poppins', sans-serif"
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.9)',
                            titleColor: '#000',
                            bodyColor: '#000',
                            titleFont: {
                                family: "'Poppins', sans-serif",
                                weight: 'bold'
                            },
                            bodyFont: {
                                family: "'Poppins', sans-serif"
                            },
                            borderColor: '#ccc',
                            borderWidth: 1,
                            padding: 12
                        }
                    }
                }
            }
        );
    </script>
</body>
</html>