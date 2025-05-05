@extends('dashboard.main')

@section('content')
<!-- Dashboard Title -->
<div class="px-10 mb-6">
    <h1 class="font-poppins font-semibold text-3xl text-gray-800">Dashboard Overview</h1>
    <p class="text-gray-500 mt-2">Welcome to your management dashboard</p>
</div>

<!-- Main Grid Layout -->
<div class="px-10 grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Left Column -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Quick Stats Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Quick Statistics</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach([
                ['label' => 'Total Users', 'value' => $userCount, 'icon' => 'M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z', 'color' => 'bg-blue-50 border-blue-500 text-blue-600'],
                ['label' => 'Total Admins', 'value' => $adminCount, 'icon' => 'M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z', 'color' => 'bg-purple-50 border-purple-500 text-purple-600'],
                ['label' => 'Total Managers', 'value' => $pengelolaCount, 'icon' => 'M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z', 'color' => 'bg-indigo-50 border-indigo-500 text-indigo-600'],
                ] as $card)
                <div class="transition-transform transform hover:scale-105 border-l-4 {{ $card['color'] }} px-6 py-8 flex items-center justify-between shadow-lg bg-white rounded-xl hover:shadow-2xl">
                    <div class="flex flex-col">
                        <p class="font-poppins font-medium {{ $card['color'] }} text-lg">{{ $card['label'] }}</p>
                        <p class="font-poppins font-light text-gray-700 text-xl">{{ $card['value'] }}</p>
                    </div>
                    <svg class="w-12 h-12 {{ $card['color'] }}" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="{{ $card['icon'] }}"></path>
                    </svg>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Content Statistics -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Content Statistics</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach([
                ['label' => 'Published Articles', 'value' => $publishedArticles, 'icon' => 'M5 4v16l7-7 7 7V4H5z', 'color' => 'bg-green-50 border-green-500 text-green-600'],
                ['label' => 'Draft Articles', 'value' => $unpublishedArticles, 'icon' => 'M5 4v16l7-7 7 7V4H5z', 'color' => 'bg-yellow-50 border-yellow-500 text-yellow-600'],
                ] as $card)
                <div class="transition-transform transform hover:scale-105 border-l-4 {{ $card['color'] }} px-6 py-8 flex items-center justify-between shadow-lg bg-white rounded-xl hover:shadow-2xl">
                    <div class="flex flex-col">
                        <p class="font-poppins font-medium {{ $card['color'] }} text-lg">{{ $card['label'] }}</p>
                        <p class="font-poppins font-light text-gray-700 text-xl">{{ $card['value'] }}</p>
                    </div>
                    <svg class="w-12 h-12 {{ $card['color'] }}" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="{{ $card['icon'] }}"></path>
                    </svg>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Pickup Request Chart -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Pickup Request Status Chart</h2>
            <div class="w-full" style="height: 400px;">
                <canvas id="grafikStatusPickup"></canvas>
            </div>
        </div>

        <!-- Waste Report Statistics -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 mt-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Waste Report Statistics</h2>
            <div class="grid grid-cols-1 sm:grid-cols-5 gap-6">
                <div class="text-center">
                    <div class="font-bold text-2xl text-gray-800">{{ $totalWasteReports }}</div>
                    <div class="text-gray-500">Total Reports</div>
                </div>
                <div class="text-center">
                    <div class="font-bold text-2xl text-yellow-500">{{ $pendingWasteReports }}</div>
                    <div class="text-gray-500">Pending</div>
                </div>
                <div class="text-center">
                    <div class="font-bold text-2xl text-blue-500">{{ $inProgressWasteReports }}</div>
                    <div class="text-gray-500">In Progress</div>
                </div>
                <div class="text-center">
                    <div class="font-bold text-2xl text-green-500">{{ $resolvedWasteReports }}</div>
                    <div class="text-gray-500">Resolved</div>
                </div>
                <div class="text-center">
                    <div class="font-bold text-2xl text-red-500">{{ $rejectedWasteReports }}</div>
                    <div class="text-gray-500">Rejected</div>
                </div>
            </div>
        </div>

        <!-- Waste Report Chart -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 mt-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Waste Report Status Chart</h2>
            <div class="w-full" style="height: 400px;">
                <canvas id="wasteReportChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Right Column -->
    <div class="space-y-8">
        <!-- Pickup Request Stats -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Pickup Request Status</h2>
            <div class="space-y-4">
                @foreach([
                ['label' => 'Total Pickup Requests', 'value' => $totalPickupRequest, 'icon' => 'M12 2L1 21h22L12 2zm0 3.84L19.74 19H4.26L12 5.84zM11 10v4h2v-4h2zm0 6v2h2v-2h-2z', 'color' => 'bg-teal-50 border-teal-500 text-teal-600'],
                ['label' => 'Completed Pickups', 'value' => $completedPickup, 'icon' => 'M9 16.17l-3.88-3.88L4 13.41l5 5 9-9-1.41-1.42z', 'color' => 'bg-green-50 border-green-500 text-green-600'],
                ['label' => 'Accepted Pickups', 'value' => $acceptedPickup, 'icon' => 'M9 16.17l-3.88-3.88L4 13.41l5 5 9-9-1.41-1.42z', 'color' => 'bg-blue-50 border-blue-500 text-blue-600'],
                ['label' => 'Pending Pickups', 'value' => $pendingPickup, 'icon' => 'M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2zm1 15h-2v-6h2zm0-8h-2V7h2z', 'color' => 'bg-yellow-50 border-yellow-500 text-yellow-600'],
                ['label' => 'Rejected Pickups', 'value' => $rejectedPickup, 'icon' => 'M9 16.17l-3.88-3.88L4 13.41l5 5 9-9-1.41-1.42z', 'color' => 'bg-red-50 border-red-500 text-red-600'],
                ] as $card)
                <div class="transition-transform transform hover:scale-105 border-l-4 {{ $card['color'] }} px-6 py-8 flex items-center justify-between shadow-lg bg-white rounded-xl hover:shadow-2xl">
                    <div class="flex flex-col">
                        <p class="font-poppins font-medium {{ $card['color'] }} text-lg">{{ $card['label'] }}</p>
                        <p class="font-poppins font-light text-gray-700 text-xl">{{ $card['value'] }}</p>
                    </div>
                    <svg class="w-12 h-12 {{ $card['color'] }}" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="{{ $card['icon'] }}"></path>
                    </svg>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Delay Reports Stats -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Delay Report Status</h2>
            <div class="space-y-4">
                @foreach([
                ['label' => 'Total Delay Reports', 'value' => $totalDelayReports, 'icon' => 'M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2zm1 15h-2v-6h2zm0-8h-2V7h2z', 'color' => 'bg-orange-50 border-orange-500 text-orange-600'],
                ['label' => 'Pending Reports', 'value' => $pendingDelayReports, 'icon' => 'M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2zm1 15h-2v-6h2zm0-8h-2V7h2z', 'color' => 'bg-yellow-50 border-yellow-500 text-yellow-600'],
                ['label' => 'In Progress Reports', 'value' => $inProgressDelayReports, 'icon' => 'M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2zm1 15h-2v-6h2zm0-8h-2V7h2z', 'color' => 'bg-blue-50 border-blue-500 text-blue-600'],
                ['label' => 'Resolved Reports', 'value' => $resolvedDelayReports, 'icon' => 'M9 16.17l-3.88-3.88L4 13.41l5 5 9-9-1.41-1.42z', 'color' => 'bg-green-50 border-green-500 text-green-600'],
                ] as $card)
                <div class="transition-transform transform hover:scale-105 border-l-4 {{ $card['color'] }} px-6 py-8 flex items-center justify-between shadow-lg bg-white rounded-xl hover:shadow-2xl">
                    <div class="flex flex-col">
                        <p class="font-poppins font-medium {{ $card['color'] }} text-lg">{{ $card['label'] }}</p>
                        <p class="font-poppins font-light text-gray-700 text-xl">{{ $card['value'] }}</p>
                    </div>
                    <svg class="w-12 h-12 {{ $card['color'] }}" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="{{ $card['icon'] }}"></path>
                    </svg>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const canvasStatus = document.getElementById('grafikStatusPickup');
    const ctxStatus = canvasStatus.getContext('2d');
    const chartStatus = new Chart(ctxStatus, {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Pending Pickups',
                data: @json($statusPending),
                borderColor: '#F59E0B',
                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                fill: true,
            }, {
                label: 'Accepted Pickups',
                data: @json($statusAccepted),
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                fill: true,
            }, {
                label: 'Rejected Pickups',
                data: @json($statusRejected),
                borderColor: '#EF4444',
                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                fill: true,
            }, {
                label: 'Completed Pickups',
                data: @json($statusCompleted),
                borderColor: '#10B981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                fill: true,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true,
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

    // Waste Report Chart
    const wasteCtx = document.getElementById('wasteReportChart').getContext('2d');
    new Chart(wasteCtx, {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [
                {
                    label: 'Pending',
                    data: @json($pendingData),
                    borderColor: '#F59E0B',
                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                    fill: true,
                },
                {
                    label: 'In Progress',
                    data: @json($inProgressData),
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                },
                {
                    label: 'Resolved',
                    data: @json($resolvedData),
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    fill: true,
                },
                {
                    label: 'Rejected',
                    data: @json($rejectedData),
                    borderColor: '#EF4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    fill: true,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: {
                    display: true,
                    text: 'Waste Report Status per Month'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });
});
</script>
@endsection