<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Help Keep Our Homes Clean')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles -->
    <style>
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
        /* Bootstrap overrides */
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
    </style>
</head>
<body>
    <!-- Include the Navbar -->
    @include('partial.navbar')

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Join us in making our world cleaner,<br>one waste at a time</h1>
            @yield('hero-content')
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center text-success mb-5">Our Services</h2>
            
            <div class="row g-4">
                <!-- Service 1 -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="mb-4">
                                <svg class="text-success" style="width: 48px; height: 48px;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h3 class="h5 text-success">Waste Tracking</h3>
                            <p class="text-muted">Keep track of your waste</p>
                        </div>
                    </div>
                </div>
                
                <!-- Service 2 -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="mb-4">
                                <svg class="text-success" style="width: 48px; height: 48px;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h3 class="h5 text-success">Report Litter</h3>
                            <p class="text-muted">Report any litter you see and we will clean it up for you.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Service 3 -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="mb-4">
                                <svg class="text-success" style="width: 48px; height: 48px;" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                                </svg>
                            </div>
                            <h3 class="h5 text-success">In Depth Information</h3>
                            <p class="text-muted">Get information about waste pickup times, capacity of TOA & TPS and more!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-5">
        <div class="container">
            @yield('content')
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-success text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h3 class="h5 mb-3">About Us</h3>
                    <p class="mb-0">We're dedicated to keeping our communities clean and environmentally friendly.</p>
                </div>
                <div class="col-md-4">
                    <h3 class="h5 mb-3">Contact</h3>
                    <p class="mb-0">Email: info@cleanhomes.com<br>Phone: (123) 456-7890</p>
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

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html