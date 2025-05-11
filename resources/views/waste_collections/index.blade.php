@extends('Report_sampah.layout')

@section('content')
\
<body class="bg-gray-100">
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
</body>
@endsection