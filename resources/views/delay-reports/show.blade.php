@extends('layouts.delay')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Detail Laporan Keterlambatan
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <h5>Lokasi</h5>
                        <p>{{ $delayReport->location }}</p>
                    </div>

                    <div class="mb-3">
                        <h5>Deskripsi</h5>
                        <p>{{ $delayReport->description }}</p>
                    </div>

                    <div class="mb-3">
                        <h5>Status</h5>
                        @switch($delayReport->status)
                            @case('pending')
                                <span class="badge bg-warning">Menunggu</span>
                                @break
                            @case('in_progress')
                                <span class="badge bg-info">Diproses</span>
                                @break
                            @case('resolved')
                                <span class="badge bg-success">Selesai</span>
                                @break
                        @endswitch
                    </div>

                    @if($delayReport->admin_notes)
                        <div class="mb-3">
                            <h5>Catatan Admin</h5>
                            <p>{{ $delayReport->admin_notes }}</p>
                        </div>
                    @endif

                    <div class="mb-3">
                        <h5>Tanggal Laporan</h5>
                        <p>{{ $delayReport->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('delay-reports.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 