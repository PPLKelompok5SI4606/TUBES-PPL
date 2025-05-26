@extends('usermain')

@section('title', 'Jadwal Pengangkutan')

@section('hero-content')
    <p class="lead">Lihat jadwal pengangkutan sampah yang telah dijadwalkan untuk area Anda.</p>
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title mb-0">Jadwal Pengangkutan</h3>
                </div>
                <div class="card-body">
                    @if($jadwals->isEmpty())
                        <div class="text-center py-4">
                            <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                            <p class="mt-3 text-muted">Belum ada jadwal pengangkutan yang tersedia.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Lokasi</th>
                                        <th>Petugas</th>
                                        <th>Kontak</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwals as $jadwal)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d F Y') }}</td>
                                            <td>{{ $jadwal->waktu }}</td>
                                            <td>{{ $jadwal->lokasi }}</td>
                                            <td>{{ $jadwal->nama_petugas }}</td>
                                            <td>{{ $jadwal->no_kontak }}</td>
                                            <td>{{ $jadwal->keterangan ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $jadwals->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 