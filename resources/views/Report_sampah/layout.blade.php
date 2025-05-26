<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laporan Sampah - Cleansweep')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .main-nav {
            background-color: #4CAF50;
            padding: 1rem 0;
            color: white;
        }
        .main-nav .nav-link {
            color: white;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
        }
        .main-nav .nav-link:hover {
            color: rgba(255, 255, 255, 0.8);
        }
        .main-nav .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }
        .navbar-brand {
            color: white;
            font-weight: bold;
            text-decoration: none;
        }
        .navbar-brand:hover {
            color: rgba(255, 255, 255, 0.8);
        }
        .auth-buttons {
            margin-left: auto;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Combined navbar -->
    <nav class="main-nav">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand me-4" href="{{ route('home') }}">CleanSweep</a>
                    
                    <div class="d-none d-md-flex">
                        <a class="nav-link {{ request()->routeIs('laporan') ? 'active' : '' }}" href="{{ route('laporan') }}">Laporan</a>
                        <a class="nav-link {{ request()->routeIs('waste-collection') ? 'active' : '' }}" href="{{ route('waste-collection') }}">Clean Collection</a>
                        <a class="nav-link {{ request()->routeIs('laporan.report-delay') ? 'active' : '' }}" href="{{ route('laporan.report-delay') }}">Report Delay</a>
                        <a class="nav-link {{ request()->routeIs('officers.index') ? 'active' : '' }}" href="{{ route('officers.index') }}">Officers</a>
                        <a class="nav-link {{ request()->routeIs('waste-transfer.index') ? 'active' : '' }}" href="{{ route('waste-transfer.index') }}">Transfer Sampah</a>
                    </div>
                </div>
                
                <div class="auth-buttons">
                    @auth
                    <div class="dropdown">
                        <button class="btn btn-link text-white text-decoration-none dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
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
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Sign In</a>
                        <a href="{{ route('register') }}" class="btn btn-light btn-sm">Sign Up</a>
                    @endauth
                </div>
            </div>
            
            <!-- Mobile navigation menu -->
            <div class="d-md-none mt-2 pt-2 border-top border-light">
                <div class="d-flex justify-content-between">
                    <a class="nav-link {{ request()->routeIs('laporan') ? 'active' : '' }}" href="{{ route('laporan') }}">Laporan</a>
                    <a class="nav-link {{ request()->routeIs('waste-collection') ? 'active' : '' }}" href="{{ route('waste-collection') }}">Clean Collection</a>
                    <a class="nav-link {{ request()->routeIs('laporan.report-delay') ? 'active' : '' }}" href="{{ route('laporan.report-delay') }}">Report Delay</a>
                    <a class="nav-link {{ request()->routeIs('waste-transfer.index') ? 'active' : '' }}" href="{{ route('waste-transfer.index') }}">Transfer</a>
                </div>
            </div>
        </div>
    </nav>
    
    @yield('content')
    
    <!-- Move Bootstrap JS to the bottom and ensure it loads before other scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>