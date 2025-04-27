<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laporan Sampah - Cleansweep')</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
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

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Waste Collection Summary</h1>
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="py-2 px-4 border">Location</th>
                    <th class="py-2 px-4 border">Total Waste (kg)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($summary as $item)
                    <tr>
                        <td class="py-2 px-4 border">{{ $item->location }}</td>
                        <td class="py-2 px-4 border">{{ number_format($item->total_waste, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>