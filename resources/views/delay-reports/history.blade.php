@extends('layouts.delay')

@section('title', 'Delay Report History - Cleansweep')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2 class="text-success">
                <i class="bi bi-clock-history"></i> Delay Report History
            </h2>
        </div>
        <div class="col text-end">
            <a href="{{ route('delay-reports.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Create New Report
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($reports->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-inbox text-success" style="font-size: 3rem;"></i>
                    <h4 class="mt-3">No Delay Reports Found</h4>
                    <p class="text-muted">You haven't submitted any delay reports yet.</p>
                    <a href="{{ route('delay-reports.create') }}" class="btn btn-success mt-3">
                        <i class="bi bi-plus-circle"></i> Create Your First Report
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <td>{{ $report->created_at->format('d M Y H:i') }}</td>
                                    <td>{{ $report->location }}</td>
                                    <td>{{ Str::limit($report->description, 50) }}</td>
                                    <td>
                                        <span class="badge bg-success">Pending</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $reports->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 