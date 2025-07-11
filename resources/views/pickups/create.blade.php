@extends('layouts.pickup')

@section('title', 'Create Pickup Request - Cleansweep')

@section('hero-content')
<p class="lead mb-4">Butuh pengambilan sampah mendesak? Kami siap membantu Anda.</p>
<a href="#pickup-form" class="btn btn-primary btn-lg">Buat Permintaan Pickup</a>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card" id="pickup-form">
            <div class="card-body p-4">
                <h2 class="text-center mb-4">Create Pickup Request</h2>

                <form action="{{ route('pickup.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="address" class="form-label">Alamat Pengambilan</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" rows="3" required>{{ old('address') }}</textarea>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Deskripsi Sampah</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                            name="description" rows="3" required>{{ old('description') }}</textarea>
                        <small class="text-muted">Silakan jelaskan jenis sampah yang akan diambil.</small>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="jenis_sampah" class="form-label">Jenis Sampah</label>
                        <select class="form-select @error('jenis_sampah') is-invalid @enderror" id="jenis_sampah"
                            name="jenis_sampah" required>
                            <option value="" disabled selected>Pilih jenis sampah</option>
                            <option value="Organik" {{ old('jenis_sampah') == 'Organik' ? 'selected' : '' }}>Organik</option>
                            <option value="Anorganik" {{ old('jenis_sampah') == 'Anorganik' ? 'selected' : '' }}>Anorganik</option>
                            <option value="B3" {{ old('jenis_sampah') == 'B3' ? 'selected' : '' }}>B3 (Berbahaya dan Beracun)</option>
                            <option value="Lainnya" {{ old('jenis_sampah') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('jenis_sampah')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="jumlah_sampah" class="form-label">Jumlah Kantong Sampah</label>
                        <input type="number" class="form-control @error('jumlah_sampah') is-invalid @enderror"
                            id="jumlah_sampah" name="jumlah_sampah" value="{{ old('jumlah_sampah', 1) }}" min="1" required>
                        <small class="text-muted">Masukkan jumlah kantong sampah yang akan diangkut.</small>
                        @error('jumlah_sampah')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="pickup_time" class="form-label">Waktu Pengambilan yang Diinginkan</label>
                        <input type="datetime-local" class="form-control @error('pickup_time') is-invalid @enderror"
                            id="pickup_time" name="pickup_time" value="{{ old('pickup_time') }}">
                        <small class="text-muted">Pilih tanggal dan waktu pengambilan (opsional).</small>
                        @error('pickup_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-check-circle"></i> Kirim Permintaan
                        </button>
                        <a href="{{ route('pickup.request-page') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="card mt-4">
            <div class="card-body">
                <h3 class="h5 mb-3">Informasi Penting</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-info-circle text-success me-2"></i>Permintaan pengambilan diproses dalam waktu 24 jam.</li>
                    <li class="mb-2"><i class="bi bi-info-circle text-success me-2"></i>Tim kami akan menghubungi Anda untuk mengonfirmasi waktu pengambilan.</li>
                    <li class="mb-2"><i class="bi bi-info-circle text-success me-2"></i>Pastikan sampah dikemas dengan baik dan mudah diakses.</li>
                    <li><i class="bi bi-info-circle text-success me-2"></i>Untuk pengambilan darurat, silakan hubungi tim dukungan kami di (123) 456-7890.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Set minimum datetime for pickup time
    document.addEventListener('DOMContentLoaded', function() {
        const pickupTimeInput = document.getElementById('pickup_time');
        const now = new Date();
        const minDateTime = new Date(now.getTime() + 24 * 60 * 60 * 1000); // 24 hours from now
        pickupTimeInput.min = minDateTime.toISOString().slice(0, 16);
    });
</script>
@endpush