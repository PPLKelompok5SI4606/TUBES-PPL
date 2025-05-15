@extends('Report_sampah.layout')

@section('content')
<style>
    .footer {
        background-color: #28a745;
        color: white;
        padding: 1rem 0;
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
    }
    
    .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    body {
        padding-bottom: 60px;
        background-color: #f8f9fa;
    }
</style>

<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Waste Collection Summary</h1>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 px-4 border">Location</th>
                <th class="py-2 px-4 border">Type</th>
                <th class="py-2 px-4 border">Total Waste (kg)</th>
                <th class="py-2 px-4 border">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wasteCollections as $collection)
                <tr>
                    <td class="py-2 px-4 border">{{ $collection->location ?? 'N/A' }}</td>
                    <td class="py-2 px-4 border">{{ $collection->type ?? 'N/A' }}</td>
                    <td class="py-2 px-4 border">{{ number_format($collection->amount_kg, 2) }}</td>
                    <td class="py-2 px-4 border">{{ $collection->status ?? 'Completed' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Footer Section -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div>
                <p class="mb-0">Cleansweep Initiative</p>
                <small>Making our world cleaner, one waste at a time.</small>
            </div>
            <div>
                <small>© {{ date('Y') }} Cleansweep. All rights reserved.</small>
            </div>
        </div>
    </div>
</footer>
@endsection