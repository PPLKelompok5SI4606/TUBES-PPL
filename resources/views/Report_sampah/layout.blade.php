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
        
        /* Navigation styles */
        .main-nav {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-size: 1.4rem;
            font-weight: bold;
            color: white !important;
            text-decoration: none;
        }
        
        .nav-link {
            color: white !important;
            margin: 0 10px;
            position: relative;
        }
        
        .nav-link:hover {
            color: rgba(255,255,255,0.8) !important;
        }
        
        .nav-link.active {
            color: rgba(255,255,255,1) !important;
        }
        
        .nav-link.active:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: white;
            border-radius: 2px;
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
        }
        
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
        
        .auth-buttons .btn {
            margin-left: 10px;
        }
        
        .btn-outline-light {
            border-color: rgba(255,255,255,0.5);
        }
        
        .btn-outline-light:hover {
            background-color: rgba(255,255,255,0.1);
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
                </div>
            </div>
        </div>
    </nav>
    
    @yield('content')
    
    <script>
        // Store temporary changes
        let statusChanges = {};
        let dateChanges = {};

        function updateDates(reportId, dateType, value) {
            if (!dateChanges[reportId]) {
                dateChanges[reportId] = {};
            }
            dateChanges[reportId][dateType] = value;
            
            const form = document.getElementById('statusForm' + reportId);
            const hiddenInput = form.querySelector(`input[name="${dateType}"]`);
            if (hiddenInput) {
                hiddenInput.value = value;
            }
        }

        function selectStatus(element, status, reportId) {
            const button = element.closest('.dropdown').querySelector('.action-button');
            const form = document.getElementById('statusForm' + reportId);
            
            // Store the status change temporarily
            statusChanges[reportId] = {
                form: form,
                status: status
            };
            
            // Update button text and class
            const statusText = status.charAt(0).toUpperCase() + status.slice(1).replace('_', ' ');
            button.textContent = statusText;
            button.className = 'action-button status-' + status.replace('_', '-');
            
            // Remove selected class from all options
            const allOptions = element.closest('.dropdown-content').querySelectorAll('.status-option');
            allOptions.forEach(option => option.classList.remove('selected'));
            
            // Add selected class to clicked option
            element.classList.add('selected');
            
            // Show/hide date inputs based on status
            const dispatchDateInput = document.getElementById('dispatchDate' + reportId);
            const completionDateInput = document.getElementById('completionDate' + reportId);
            const dispatchDateCell = dispatchDateInput ? dispatchDateInput.closest('td') : null;
            const completionDateCell = completionDateInput ? completionDateInput.closest('td') : null;
        
            if (dispatchDateCell) {
                if (status === 'pending') {
                    dispatchDateCell.innerHTML = '-';
                } else {
                    // Show dispatch date input for both in_progress and resolved
                    dispatchDateCell.innerHTML = `
                        <input type="date" 
                            class="form-control" 
                            style="width: 150px; padding: 4px 8px; border: 1px solid #ddd; border-radius: 4px;" 
                            value="${dateChanges[reportId]?.dispatch_date || ''}"
                            onchange="updateDates(${reportId}, 'dispatch_date', this.value)"
                            id="dispatchDate${reportId}"
                            ${status === 'resolved' ? 'readonly' : ''}
                            placeholder="Pilih tanggal">
                    `;
                }
            }
        
            if (completionDateCell) {
                if (status === 'resolved') {
                    // Get the existing completion date from the form or database
                    const existingDate = form.querySelector('input[name="completion_date"]').value || 
                                (document.getElementById('completionDate' + reportId)?.value || '');
                    
                    // Show completion date input immediately when resolved is selected
                    completionDateCell.innerHTML = `
                        <input type="date" 
                            class="form-control" 
                            style="width: 150px; padding: 4px 8px; border: 1px solid #ddd; border-radius: 4px;" 
                            value="${existingDate}"
                            onchange="updateDates(${reportId}, 'completion_date', this.value)"
                            id="completionDate${reportId}"
                            placeholder="Pilih tanggal">
                    `;
                } else {
                    completionDateCell.innerHTML = '-';
                }
            }
            
            // Close the dropdown
            element.closest('.dropdown-content').style.display = 'none';
        }

        function submitAllChanges() {
            // Get all reports that have changes
            const reportIds = new Set([
                ...Object.keys(statusChanges),
                ...Object.keys(dateChanges)
            ]);
            
            const promises = [];
            
            reportIds.forEach(reportId => {
                const form = document.getElementById('statusForm' + reportId);
                const formData = new FormData(form);
                
                // Add status if changed
                if (statusChanges[reportId]) {
                    formData.set('status', statusChanges[reportId].status);
                }
                
                // Add dates if changed
                if (dateChanges[reportId]) {
                    if (dateChanges[reportId].dispatch_date) {
                        formData.set('dispatch_date', dateChanges[reportId].dispatch_date);
                    }
                    if (dateChanges[reportId].completion_date) {
                        formData.set('completion_date', dateChanges[reportId].completion_date);
                    }
                }
                
                promises.push(
                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                );
            });
        
            // If there are changes, submit them
            if (promises.length > 0) {
                Promise.all(promises)
                    .then(() => {
                        // Clear all changes
                        statusChanges = {};
                        dateChanges = {};
                        // Reload the page to show updated data
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Error updating reports:', error);
                    });
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('.dropdown-content');
            dropdowns.forEach(dropdown => {
                if (!event.target.closest('.dropdown')) {
                    dropdown.style.display = 'none';
                }
            });
        });

        // Toggle dropdown visibility
        document.querySelectorAll('.action-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation();
                const dropdown = this.nextElementSibling;
                const allDropdowns = document.querySelectorAll('.dropdown-content');
                
                // Close all other dropdowns
                allDropdowns.forEach(d => {
                    if (d !== dropdown) {
                        d.style.display = 'none';
                    }
                });
                
                // Toggle current dropdown
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>
</body>
</html>