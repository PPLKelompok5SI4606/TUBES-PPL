<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Dashboard - CleanSweep</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
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
    </style>
</head>
<body class="min-h-screen">
    @include('partial.navbar')

    <div class="content py-5">
        <div class="container py-4">
            <!-- Dashboard Title -->
            <div class="mb-4">
                <h1 class="font-poppins fw-bold fs-1 text-dark">User Dashboard</h1>
                <p class="font-poppins text-secondary fs-5">Welcome, {{ Auth::user()->name }}!</p>
            </div>

            <!-- Grid Cards -->
            <div class="row g-4 mb-5">
                @foreach([
                    ['label' => 'Total Pickup Requests', 'value' => $userPickupRequests, 'icon' => '<i class="bi bi-truck text-success fs-1"></i>'],
                    ['label' => 'Completed Pickups', 'value' => $completedPickups, 'icon' => '<i class="bi bi-check-circle text-success fs-1"></i>'],
                    ['label' => 'Pending Pickups', 'value' => $pendingPickups, 'icon' => '<i class="bi bi-clock text-success fs-1"></i>'],
                    ['label' => 'Rejected Pickups', 'value' => $rejectedPickups, 'icon' => '<i class="bi bi-x-circle text-success fs-1"></i>'],
                ] as $card)
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card">
                        <div>
                            <p class="font-poppins fw-medium text-primary-green mb-1">{{ $card['label'] }}</p>
                            <p class="font-poppins fw-light text-secondary fs-4 mb-0">{{ $card['value'] }}</p>
                        </div>
                        <div class="card-icon">
                            {!! $card['icon'] !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pickup Requests Chart -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div style="height: 400px;">
                        <canvas id="grafikUserPickup"></canvas>
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
                        <a href="#" class="text-white text-decoration-none hover-opacity">Facebook</a>
                        <a href="#" class="text-white text-decoration-none hover-opacity">Twitter</a>
                        <a href="#" class="text-white text-decoration-none hover-opacity">Instagram</a>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-4 border-top border-light text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Clean Homes Initiative. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvasUserPickup = document.getElementById('grafikUserPickup');
        const ctxUserPickup = canvasUserPickup.getContext('2d');
        const chartUserPickup = new Chart(ctxUserPickup, {
            type: 'bar',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Pending',
                    data: @json($userPendingData),
                    backgroundColor: '#FF9F40',
                    borderColor: '#FF9F40',
                    borderWidth: 1
                }, {
                    label: 'Completed',
                    data: @json($userCompletedData),
                    backgroundColor: '#36A2EB',
                    borderColor: '#36A2EB',
                    borderWidth: 1
                }, {
                    label: 'Rejected',
                    data: @json($userRejectedData),
                    backgroundColor: '#FF6384',
                    borderColor: '#FF6384',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Your Pickup Request Status (Monthly)',
                        font: {
                            size: 18,
                            family: 'Poppins',
                            weight: 'bold'
                        },
                        padding: {
                            bottom: 20
                        }
                    },
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 10,
                            padding: 20,
                            font: {
                                family: 'Poppins'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: {
                            family: 'Poppins',
                            size: 14
                        },
                        bodyFont: {
                            family: 'Poppins',
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y + ' requests';
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Month',
                            font: {
                                family: 'Poppins',
                                size: 14
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        title: {
                            display: true,
                            text: 'Number of Requests',
                            font: {
                                family: 'Poppins',
                                size: 14
                            }
                        },
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    });
    </script>
</body>
</html>