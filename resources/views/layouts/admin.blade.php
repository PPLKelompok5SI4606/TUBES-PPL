<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom Styles for basic elements and sidebar -->
    <style>
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            color: #1f2937; /* Default text color (gray-900 equivalent) */
            background-color: #f3f4f6; /* Default background (gray-100 equivalent) */
        }
        [x-cloak] { display: none !important; }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Explicit style for admin sidebar background */
        .admin-sidebar {
            background: linear-gradient(to bottom, #4CAF50, #2E7D32) !important; /* Using solid colors matching the gradient intent */
            color: white !important; /* Ensure text is white */
        }
        .admin-sidebar h2 {
             color: rgba(255, 255, 255, 0.7) !important; /* Text color for section headers */
        }
         .admin-sidebar a {
             color: rgba(255, 255, 255, 0.8) !important; /* Default link color */
         }
         .admin-sidebar a:hover {
             background-color: rgba(255, 255, 255, 0.1) !important; /* Hover background */
             color: white !important; /* Hover text color */
         }
        .admin-sidebar a.active {
            background-color: rgba(255, 255, 255, 0.2) !important; /* Active background */
            color: white !important; /* Active text color */
            font-weight: bold !important;
        }

    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('partial.menuadmin')

        <!-- Main Content -->
        <div class="flex-1 p-6 md:p-8">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html> 