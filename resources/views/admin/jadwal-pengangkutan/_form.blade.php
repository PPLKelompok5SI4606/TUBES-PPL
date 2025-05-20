{{-- resources/views/admin/jadwal-pengangkutan/_form.blade.php --}}
@csrf

<div class="mb-4">
  <label class="block font-medium">Nama Petugas</label>
  <input
    type="text"
    name="nama_petugas"
    value="{{ old('nama_petugas', $jadwal->nama_petugas ?? '') }}"
    class="border rounded w-full px-3 py-2"
  >
  @error('nama_petugas')
    <div class="text-red-600 text-sm">{{ $message }}</div>
  @enderror
</div>

<div class="mb-4">
  <label class="block font-medium">No. Kontak</label>
  <input
    type="text"
    name="no_kontak"
    value="{{ old('no_kontak', $jadwal->no_kontak ?? '') }}"
    class="border rounded w-full px-3 py-2"
  >
  @error('no_kontak')
    <div class="text-red-600 text-sm">{{ $message }}</div>
  @enderror
</div>

<div class="grid grid-cols-2 gap-4 mb-4">
  <div>
    <label class="block font-medium">Tanggal</label>
    <input
      type="date"
      name="tanggal"
      value="{{ old('tanggal', optional($jadwalPengangkutan)->tanggal) }}"
      class="border rounded w-full px-3 py-2"
    >
    @error('tanggal')
      <div class="text-red-600 text-sm">{{ $message }}</div>
    @enderror
  </div>
  <div>
    <label class="block font-medium">Waktu</label>
    <input
      type="time"
      name="waktu"
      value="{{ old('waktu', optional($jadwalPengangkutan)->waktu) }}"
      class="border rounded w-full px-3 py-2"
    >
    @error('waktu')
      <div class="text-red-600 text-sm">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="mb-4">
  <label class="block font-medium">Lokasi</label>
  <input
    type="text"
    name="lokasi"
    value="{{ old('lokasi', $jadwal->lokasi ?? '') }}"
    class="border rounded w-full px-3 py-2"
  >
  @error('lokasi')
    <div class="text-red-600 text-sm">{{ $message }}</div>
  @enderror
</div>

<div class="mb-4">
  <label class="block font-medium">Keterangan (opsional)</label>
  <textarea
    name="keterangan"
    class="border rounded w-full px-3 py-2"
    rows="3"
  >{{ old('keterangan', $jadwal->keterangan ?? '') }}</textarea>
  @error('keterangan')
    <div class="text-red-600 text-sm">{{ $message }}</div>
  @enderror
</div>
