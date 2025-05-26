@extends('dashboard.main')

@section('content')
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="font-poppins font-medium text-gray-800 text-[28px] mb-6">Edit Jadwal Pengangkutan</p>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                {{-- Header Card --}}
                <div class="px-6 py-4 bg-primary-green text-white font-medium">
                    Edit Data
                </div>

                {{-- Body Form --}}
                <div class="p-6">
                    <form method="POST" action="{{ route('jadwal-pengangkutan.update', $jadwalPengangkutan->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Nama Petugas --}}
                        <div class="mb-6">
                            <label for="nama_petugas" class="block text-sm font-medium text-gray-700 mb-2">Nama Petugas</label>
                            <input id="nama_petugas" type="text"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-primary-green focus:border-primary-green @error('nama_petugas') border-red-500 @enderror"
                                name="nama_petugas" value="{{ old('nama_petugas', $jadwalPengangkutan->nama_petugas) }}" required autofocus
                                placeholder="Masukkan nama petugas">
                            @error('nama_petugas')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- No Kontak --}}
                        <div class="mb-6">
                            <label for="no_kontak" class="block text-sm font-medium text-gray-700 mb-2">No Kontak</label>
                            <input id="no_kontak" type="text"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-primary-green focus:border-primary-green @error('no_kontak') border-red-500 @enderror"
                                name="no_kontak" value="{{ old('no_kontak', $jadwalPengangkutan->no_kontak) }}" required
                                placeholder="08xxxxxxxxxx">
                            @error('no_kontak')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal --}}
                        <div class="mb-6">
                            <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                            <input id="tanggal" type="date"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-primary-green focus:border-primary-green @error('tanggal') border-red-500 @enderror"
                                name="tanggal" value="{{ old('tanggal', $jadwalPengangkutan->tanggal) }}" required>
                            @error('tanggal')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Waktu --}}
                        <div class="mb-6">
                            <label for="waktu" class="block text-sm font-medium text-gray-700 mb-2">Waktu</label>
                            <input id="waktu" type="time"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-primary-green focus:border-primary-green @error('waktu') border-red-500 @enderror"
                                name="waktu" value="{{ old('waktu', $jadwalPengangkutan->waktu) }}" required>
                            @error('waktu')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Lokasi --}}
                        <div class="mb-6">
                            <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                            <input id="lokasi" type="text"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-primary-green focus:border-primary-green @error('lokasi') border-red-500 @enderror"
                                name="lokasi" value="{{ old('lokasi', $jadwalPengangkutan->lokasi) }}" required
                                placeholder="Masukkan lokasi pengangkutan">
                            @error('lokasi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Keterangan (opsional) --}}
                        <div class="mb-6">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan (opsional)</label>
                            <textarea id="keterangan" rows="3"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-primary-green focus:border-primary-green @error('keterangan') border-red-500 @enderror"
                                name="keterangan" placeholder="Tuliskan keterangan jika ada">{{ old('keterangan', $jadwalPengangkutan->keterangan) }}</textarea>
                            @error('keterangan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('jadwal-pengangkutan.index') }}"
                               class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition duration-300">
                                Batal
                            </a>
                            <button type="submit"
                                   class="px-4 py-2 bg-primary-green hover:bg-green-700 text-white rounded-lg transition duration-300">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
