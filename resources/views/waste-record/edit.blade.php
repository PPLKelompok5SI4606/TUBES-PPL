@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Edit Catatan Sampah</span>
                    <a href="{{ route('waste-record.index') }}" class="btn btn-sm btn-secondary">Kembali ke Riwayat</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('waste-record.update', $wasteRecord) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="date" class="form-label">Tanggal</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $wasteRecord->date->format('Y-m-d')) }}" required>
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori Sampah</label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="organik" {{ old('category', $wasteRecord->category) == 'organik' ? 'selected' : '' }}>Organik</option>
                                <option value="anorganik" {{ old('category', $wasteRecord->category) == 'anorganik' ? 'selected' : '' }}>Anorganik</option>
                                <option value="b3" {{ old('category', $wasteRecord->category) == 'b3' ? 'selected' : '' }}>B3 (Bahan Berbahaya dan Beracun)</option>
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi (Opsional)</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Misalnya: Sisa makanan, botol plastik, baterai bekas, dll">{{ old('description', $wasteRecord->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Perbarui Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```