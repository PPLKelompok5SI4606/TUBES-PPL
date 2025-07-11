@extends('usermain')

@section('title', 'Riwayat Permintaan Pickup - Clean Homes')

@section('hero-content')
<p class="lead mb-4">Lihat riwayat permintaan pengambilan sampah Anda.</p>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-success text-white py-3 d-flex justify-content-between align-items-center">
                    <h2 class="h4 mb-0">Riwayat Permintaan Pickup</h2>
                    <a href="{{ route('pickup.create') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-plus-circle-fill me-1"></i>Buat Permintaan Baru
                    </a>
                </div>
                <div class="card-body p-0">
                    @if($pickupRequests->isEmpty())
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="bi bi-inbox-fill text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h3 class="h5 text-muted">Belum ada permintaan pickup</h3>
                            <p class="text-muted">Anda belum membuat permintaan pengambilan sampah.</p>
                            <a href="{{ route('pickup.create') }}" class="btn btn-success mt-3">
                                <i class="bi bi-plus-circle-fill me-1"></i>Buat Permintaan Pertama
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Alamat</th>
                                        <th>Jenis Sampah</th>
                                        <th>Jumlah Sampah</th>
                                        <th>Status</th>
                                        <th>Waktu Pengambilan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pickupRequests as $request)
                                        <tr>
                                            <td>{{ $request->created_at->format('d M Y, H:i') }}</td>
                                            <td>{{ Str::limit($request->address, 30) }}</td>
                                            <td>
                                                @if($request->jenis_sampah)
                                                    <span class="badge bg-primary">{{ $request->jenis_sampah }}</span>
                                                @else
                                                    <span class="text-muted">Tidak ditentukan</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($request->jumlah_sampah)
                                                    {{ $request->jumlah_sampah }}
                                                @else
                                                    <span class="text-muted">Tidak ditentukan</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($request->status == 'pending')
                                                    <span class="badge bg-warning">Menunggu</span>
                                                @elseif($request->status == 'accepted')
                                                    <span class="badge bg-info">Diterima</span>
                                                @elseif($request->status == 'rejected')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @elseif($request->status == 'completed')
                                                    <span class="badge bg-success">Selesai</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($request->pickup_time)
                                                    {{ \Carbon\Carbon::parse($request->pickup_time)->format('d M Y, H:i') }}
                                                @else
                                                    <span class="text-muted">Belum ditentukan</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('pickup.show', $request->id) }}" class="btn btn-sm btn-outline-success">
                                                    <i class="bi bi-eye-fill"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                @if($pickupRequests->hasPages())
                    <div class="card-footer bg-white">
                        {{ $pickupRequests->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection