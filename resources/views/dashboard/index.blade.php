
@extends('dashboard.main')

@section('title', 'Admin Dashboard - CleanSweep')

@section('content')
<!-- Dashboard Title -->
<div class="mb-6">
    <h1 class="font-poppins font-semibold text-3xl text-gray-800">Dashboard Overview</h1>
    <p class="text-gray-500 mt-2">Welcome to your management dashboard</p>
</div>

<!-- User Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- User Count Card -->
    <div class="transition-transform transform hover:scale-105 border-l-4 bg-blue-50 border-blue-500 text-blue-600 px-6 py-8 flex items-center justify-between shadow-lg bg-white rounded-xl hover:shadow-2xl">
        <div class="flex flex-col">
            <p class="font-poppins font-medium text-blue-600 text-lg">Total Users</p>
            <p class="font-poppins font-light text-gray-700 text-xl">{{ $userCount }}</p>
        </div>
        <svg class="w-12 h-12 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"></path>
            <path d="M12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
        </svg>
    </div>

    <!-- Admin Count Card -->
    <div class="transition-transform transform hover:scale-105 border-l-4 bg-purple-50 border-purple-500 text-purple-600 px-6 py-8 flex items-center justify-between shadow-lg bg-white rounded-xl hover:shadow-2xl">
        <div class="flex flex-col">
            <p class="font-poppins font-medium text-purple-600 text-lg">Total Admins</p>
            <p class="font-poppins font-light text-gray-700 text-xl">{{ $adminCount }}</p>
        </div>
        <svg class="w-12 h-12 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"></path>
            <path d="M12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
        </svg>
    </div>

    <!-- Manager Count Card -->
    <div class="transition-transform transform hover:scale-105 border-l-4 bg-indigo-50 border-indigo-500 text-indigo-600 px-6 py-8 flex items-center justify-between shadow-lg bg-white rounded-xl hover:shadow-2xl">
        <div class="flex flex-col">
            <p class="font-poppins font-medium text-indigo-600 text-lg">Total Managers</p>
            <p class="font-poppins font-light text-gray-700 text-xl">{{ $pengelolaCount }}</p>
        </div>
        <svg class="w-12 h-12 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"></path>
            <path d="M12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
        </svg>
    </div>
</div>

<!-- TPS/TPA Statistics Cards -->
<h2 class="text-xl font-semibold text-gray-800 mb-4">TPS/TPA Statistics</h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <!-- Daily Waste Input -->
    <div class="transition-transform transform hover:scale-105 border-l-4 bg-green-50 border-green-500 text-green-600 px-6 py-8 flex items-center justify-between shadow-lg bg-white rounded-xl hover:shadow-2xl">
        <div class="flex flex-col">
            <p class="font-poppins font-medium text-green-600 text-lg">Waste In</p>
            <p class="font-poppins font-light text-gray-700 text-xl">
                @if(isset($dailyInputData) && count($dailyInputData) > 0)
                    {{ end($dailyInputData) }} m³
                @else
                    0 m³
                @endif
            </p>
        </div>
        <svg class="w-12 h-12 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 4h-3V2h-2v2h-4V2H8v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10z"></path>
            <path d="M14 12h-4v4h4v-4z"></path>
        </svg>
    </div>

    <!-- Daily Waste Processed -->
    <div class="transition-transform transform hover:scale-105 border-l-4 bg-teal-50 border-teal-500 text-teal-600 px-6 py-8 flex items-center justify-between shadow-lg bg-white rounded-xl hover:shadow-2xl">
        <div class="flex flex-col">
            <p class="font-poppins font-medium text-teal-600 text-lg">Daily Waste Processed</p>
            <p class="font-poppins font-light text-gray-700 text-xl">-</p>
            <p class="font-poppins font-light text-gray-500 text-xs mt-1">Data not available yet</p>
        </div>
        <svg class="w-12 h-12 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path d="M9 16.17l-3.88-3.88L4 13.41l5 5 9-9-1.41-1.42z"></path>
        </svg>
    </div>
</div>

<!-- TPS/TPA Capacity Charts -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- TPS Capacity Chart -->
    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">TPS Capacity Status</h2>
        <div class="w-full" style="height: 300px;">
            <canvas id="tpsCapacityChart"></canvas>
        </div>
    </div>

    <!-- TPA Capacity Chart -->
    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">TPA Capacity Status</h2>
        <div class="w-full" style="height: 300px;">
            <canvas id="tpaCapacityChart"></canvas>
        </div>
    </div>
</div>

<!-- Daily Waste Report Chart -->
<div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Daily Waste Processing</h2>
    <div class="w-full" style="height: 400px;">
        <canvas id="dailyWasteChart"></canvas>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // TPS Capacity Chart
        const tpsCtx = document.getElementById('tpsCapacityChart').getContext('2d');
        new Chart(tpsCtx, {
            type: 'doughnut',
            data: {
                labels: ['Used', 'Available'],
                datasets: [{
                    data: [{{ $tpsCapacityUsed }}, {{ $tpsCapacityAvailable }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 0.3)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });

        // TPA Capacity Chart
        const tpaCtx = document.getElementById('tpaCapacityChart').getContext('2d');
        new Chart(tpaCtx, {
            type: 'doughnut',
            data: {
                labels: ['Used', 'Available'],
                datasets: [{
                    data: [{{ $tpaCapacityUsed }}, {{ $tpaCapacityAvailable }}],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 0.3)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });

        // Daily Waste Processing Chart
        const dailyCtx = document.getElementById('dailyWasteChart').getContext('2d');
        new Chart(dailyCtx, {
            type: 'line',
            data: {
                labels: @json($dailyDates),
                datasets: [
                    {
                        label: 'Waste Input',
                        data: @json($dailyInputData),
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.1)',
                        fill: true,
                    },
                    {
                        label: 'Waste Processed',
                        data: @json($dailyProcessedData),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.1)',
                        fill: true,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    });
</script>
@endsection