@extends('Report_sampah.layout')

@section('content')
<div class="container">
    <div class="row mb-4 mt-4">
        <div class="col">
            <h2 class="text-success">
                <i class="bi bi-trash"></i> Waste Tracking
            </h2>
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
            @if($wasteReports->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-inbox text-success" style="font-size: 3rem;"></i>
                    <h4 class="mt-3">No Waste Reports Found</h4>
                    <p class="text-muted">There are no waste reports to display.</p>
                </div>
            @else
                <div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wasteReports as $report)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $report->location }}
                                    <button class="btn btn-sm btn-outline-primary ms-2" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#locationModal"
                                            data-location="{{ $report->location }}"
                                            data-lat="{{ $report->latitude }}"
                                            data-lng="{{ $report->longitude }}">
                                        <i class="bi bi-map"></i> View Map
                                    </button>
                                </td>
                                <td>{{ $report->description }}</td>
                                <td>{{ $report->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle 
                                            @if($report->status === 'pending') btn-outline-secondary
                                            @elseif($report->status === 'in_progress') btn-outline-warning
                                            @elseif($report->status === 'resolved') btn-outline-success
                                            @endif" 
                                            data-bs-toggle="dropdown">
                                            {{ ucfirst(str_replace('_', ' ', $report->status)) }}
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form id="statusForm{{ $report->id }}" action="{{ route('waste-reports.update', $report) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="{{ $report->status }}">
                                                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); selectStatus(this, 'pending', {{ $report->id }})">
                                                        <span class="badge bg-secondary me-2">Pending</span>
                                                        <small>New report, waiting for handling</small>
                                                    </a>
                                                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); selectStatus(this, 'in_progress', {{ $report->id }})">
                                                        <span class="badge bg-warning me-2">In Progress</span>
                                                        <small>Report is being handled</small>
                                                    </a>
                                                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); selectStatus(this, 'resolved', {{ $report->id }})">
                                                        <span class="badge bg-success me-2">Resolved</span>
                                                        <small>Report has been resolved</small>
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

                <div class="d-flex justify-content-end mt-4">
                    <button onclick="submitAllChanges()" class="btn btn-success">
                        <i class="bi bi-save"></i> Save All Changes
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Location Modal -->
<div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationModalLabel">Location Map</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="map" style="height: 400px; width: 100%;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Include Leaflet CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    // Initialize map variable
    let map;
    let marker;

    // Handle modal show event
    document.getElementById('locationModal').addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const location = button.getAttribute('data-location');
        const lat = parseFloat(button.getAttribute('data-lat'));
        const lng = parseFloat(button.getAttribute('data-lng'));
        
        // Update modal title
        document.getElementById('locationModalLabel').textContent = `Location: ${location}`;
        
        // Initialize map if not already done
        if (!map) {
            map = L.map('map').setView([lat, lng], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
        } else {
            map.setView([lat, lng], 15);
        }
        
        // Remove existing marker if any
        if (marker) {
            map.removeLayer(marker);
        }
        
        // Add new marker
        marker = L.marker([lat, lng]).addTo(map)
            .bindPopup(`<b>${location}</b><br>Waste report location`);
    });

    function selectStatus(element, status, id) {
        const form = document.getElementById(`statusForm${id}`);
        form.querySelector('input[name="status"]').value = status;
        form.submit();
    }

    function submitAllChanges() {
        // Implement your logic to submit all changes
        alert('All changes have been saved!');
    }
</script>

<style>
    .dropdown-menu {
        min-width: 250px;
    }
    .dropdown-item small {
        display: block;
        color: #6c757d;
        font-size: 0.875em;
    }
</style>
@endsection