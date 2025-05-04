@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Data TPS/TPA</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tps-tpa.store') }}">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="nama" class="col-md-4 col-form-label text-md-right">Nama</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autofocus>
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="tipe" class="col-md-4 col-form-label text-md-right">Tipe</label>
                            <div class="col-md-6">
                                <select id="tipe" class="form-control @error('tipe') is-invalid @enderror" name="tipe" required>
                                    <option value="">Pilih Tipe</option>
                                    <option value="TPS" {{ old('tipe') == 'TPS' ? 'selected' : '' }}>TPS</option>
                                    <option value="TPA" {{ old('tipe') == 'TPA' ? 'selected' : '' }}>TPA</option>
                                </select>
                                @error('tipe')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="kapasitas_total" class="col-md-4 col-form-label text-md-right">Kapasitas Total (m³)</label>
                            <div class="col-md-6">
                                <input id="kapasitas_total" type="number" step="0.01" class="form-control @error('kapasitas_total') is-invalid @enderror" name="kapasitas_total" value="{{ old('kapasitas_total') }}" required>
                                @error('kapasitas_total')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="kapasitas_terisi" class="col-md-4 col-form-label text-md-right">Kapasitas Terisi (m³)</label>
                            <div class="col-md-6">
                                <input id="kapasitas_terisi" type="number" step="0.01" class="form-control @error('kapasitas_terisi') is-invalid @enderror" name="kapasitas_terisi" value="{{ old('kapasitas_terisi') }}" required>
                                @error('kapasitas_terisi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="lokasi" class="col-md-4 col-form-label text-md-right">Lokasi</label>
                            <div class="col-md-6">
                                <input id="lokasi" type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" value="{{ old('lokasi') }}" required>
                                @error('lokasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>
                            <div class="col-md-6">
                                <input id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                                <a href="{{ route('tps-tpa.index') }}" class="btn btn-secondary">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 