@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Daftar Laporan Keterlambatan</span>
                    <a href="{{ route('delay-reports.create') }}" class="btn btn-primary">Buat Laporan Baru</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($reports->isEmpty())
                        <div class="alert alert-info">
                            Belum ada laporan keterlambatan.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Lokasi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reports as $report)
                                        <tr>
                                            <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $report->location }}</td>
                                            <td>
                                                @switch($report->status)
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
                                            </td>
                                            <td>
                                                <a href="{{ route('delay-reports.show', $report) }}" 
                                                   class="btn btn-sm btn-info">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 