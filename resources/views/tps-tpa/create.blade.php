@extends('dashboard.main')

@section('content')
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="font-poppins font-medium text-gray-800 text-[28px] mb-6">Tambah Data TPS/TPA</p>
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-primary-green text-white font-medium">
                    Data Baru
                </div>
                
                <div class="p-6">
                    <form method="POST" action="{{ route('tps-tpa.store') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                            <input id="nama" type="text" 
                                class="w-full px-4 py-2 border rounded-lg focus:ring-primary-green focus:border-primary-green @error('nama') border-red-500 @enderror" 
                                name="nama" value="{{ old('nama') }}" required autofocus placeholder="Masukkan nama TPS/TPA">
                            @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="tipe" class="block text-sm font-medium text-gray-700 mb-2">Tipe</label>
                            <select id="tipe" 
                                class="w-full px-4 py-2 border rounded-lg focus:ring-primary-green focus:border-primary-green @error('tipe') border-red-500 @enderror" 
                                name="tipe" required>
                                <option value="">Pilih Tipe</option>
                                <option value="TPS" {{ old('tipe') == 'TPS' ? 'selected' : '' }}>TPS</option>
                                <option value="TPA" {{ old('tipe') == 'TPA' ? 'selected' : '' }}>TPA</option>
                            </select>
                            @error('tipe')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="kapasitas_total" class="block text-sm font-medium text-gray-700 mb-2">Kapasitas Total (m³)</label>
                            <input id="kapasitas_total" type="number" step="0.01"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-primary-green focus:border-primary-green @error('kapasitas_total') border-red-500 @enderror" 
                                name="kapasitas_total" value="{{ old('kapasitas_total') }}" required placeholder="0.00">
                            @error('kapasitas_total')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="kapasitas_terisi" class="block text-sm font-medium text-gray-700 mb-2">Kapasitas Terisi (m³)</label>
                            <input id="kapasitas_terisi" type="number" step="0.01" 
                                class="w-full px-4 py-2 border rounded-lg focus:ring-primary-green focus:border-primary-green @error('kapasitas_terisi') border-red-500 @enderror" 
                                name="kapasitas_terisi" value="{{ old('kapasitas_terisi') }}" required placeholder="0.00">
                            @error('kapasitas_terisi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                            <input id="lokasi" type="text" 
                                class="w-full px-4 py-2 border rounded-lg focus:ring-primary-green focus:border-primary-green @error('lokasi') border-red-500 @enderror" 
                                name="lokasi" value="{{ old('lokasi') }}" required placeholder="Masukkan lokasi">
                            @error('lokasi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="status" 
                                class="w-full px-4 py-2 border rounded-lg focus:ring-primary-green focus:border-primary-green @error('status') border-red-500 @enderror" 
                                name="status" required>
                                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                <option value="Maintenance" {{ old('status') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('tps-tpa.index') }}" 
                               class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition duration-300">
                                Batal
                            </a>
                            <button type="submit" 
                                   class="px-4 py-2 bg-primary-green hover:bg-green-700 text-white rounded-lg transition duration-300">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection