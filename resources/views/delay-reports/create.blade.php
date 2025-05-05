@extends('layouts.delay')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-clock-history me-2"></i>
                        Laporkan Keterlambatan Pengangkatan Sampah
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('delay-reports.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="location" class="form-label fw-bold">
                                <i class="bi bi-geo-alt text-success me-2"></i>Lokasi
                            </label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                id="location" name="location" value="{{ old('location') }}" 
                                placeholder="Masukkan lokasi keterlambatan" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">
                                <i class="bi bi-chat-text text-success me-2"></i>Deskripsi
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="4" 
                                placeholder="Jelaskan detail keterlambatan pengangkatan sampah" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-send me-2"></i>Kirim Laporan
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-outline-success">
                                <i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 