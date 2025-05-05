@extends('layouts.delay')

@section('title', 'Delay Reports - Cleansweep')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2 class="text-success">
                <i class="bi bi-exclamation-triangle"></i> Delay Reports
            </h2>
        </div>
        <div class="col text-end">
            <a href="{{ route('delay-reports.history') }}" class="btn btn-outline-success">
                <i class="bi bi-clock-history"></i> View History
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title text-success">
                        <i class="bi bi-info-circle"></i> About Delay Reports
                    </h5>
                    <p class="card-text">
                        Use this form to report any delays in waste collection services. Your reports help us improve our service and address issues promptly.
                    </p>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle text-success"></i> Report collection delays</li>
                        <li><i class="bi bi-check-circle text-success"></i> Track service issues</li>
                        <li><i class="bi bi-check-circle text-success"></i> Help improve our service</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-success">
                        <i class="bi bi-plus-circle"></i> Create New Report
                    </h5>
                    <form action="{{ route('delay-reports.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                   id="location" name="location" value="{{ old('location') }}" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-send"></i> Submit Report
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 