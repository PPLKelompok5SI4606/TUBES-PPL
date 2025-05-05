@extends('Report_sampah.layout')

@section('content')
<!-- Content section -->
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col">
            <h2 class="text-success">
                <i class="bi bi-clock-history"></i> Report Delay
            </h2>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($reports->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-inbox text-success" style="font-size: 3rem;"></i>
                    <h4 class="mt-3">No Delay Reports Found</h4>
                    <p class="text-muted">There are no delay reports to display.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th>No.</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>Report Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $report->location }}</td>
                                <td>{{ $report->description }}</td>
                                <td>{{ $report->created_at->format('d M Y') }}</td>
                                <td>
                                    <span class="badge 
                                        @if($report->status === 'pending') bg-secondary
                                        @elseif($report->status === 'in_progress') bg-warning
                                        @elseif($report->status === 'resolved') bg-success
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $report->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" 
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-gear"></i> Change Status
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form class="status-form" action="{{ route('laporan.report-delay.update', $report->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="{{ $report->status }}">
                                                    
                                                    <a class="dropdown-item status-option" href="#" data-status="pending">
                                                        <span class="badge bg-secondary me-2">Pending</span>
                                                        <small class="text-muted">New report, waiting for handling</small>
                                                    </a>
                                                    <a class="dropdown-item status-option" href="#" data-status="in_progress">
                                                        <span class="badge bg-warning me-2">In Progress</span>
                                                        <small class="text-muted">Report is being handled</small>
                                                    </a>
                                                    <a class="dropdown-item status-option" href="#" data-status="resolved">
                                                        <span class="badge bg-success me-2">Resolved</span>
                                                        <small class="text-muted">Report has been resolved</small>
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle status changes
    document.querySelectorAll('.status-option').forEach(option => {
        option.addEventListener('click', function(e) {
            e.preventDefault();
            const status = this.dataset.status;
            const form = this.closest('.status-form');
            
            // Update status and submit
            form.querySelector('input[name="status"]').value = status;
            form.submit();
        });
    });
});
</script>
@endsection