@extends('dashboard.main')

@section('content')
<p class="font-poppins font-medium text-gray-800 text-[28px] ms-10 mb-6">Jadwal Pengangkutan</p>

<div class="px-10 mb-4">
    <a href="{{ route('jadwal-pengangkutan.create') }}" 
       class="bg-primary-green hover:bg-green-700 text-white text-sm font-semibold py-2 px-4 rounded">
        + Tambah Jadwal
    </a>
</div>

<div class="px-10 w-full">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-white uppercase bg-primary-green">
                <tr>
                    <th class="px-6 py-3">Petugas</th>
                    <th class="px-6 py-3">No Kontak</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Waktu</th>
                    <th class="px-6 py-3">Lokasi</th>
                    <th class="px-6 py-3">Keterangan</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwals as $jadwal)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $jadwal->nama_petugas }}</td>
                    <td class="px-6 py-4">{{ $jadwal->no_kontak }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</td>
                    <td class="px-6 py-4">{{ $jadwal->waktu }}</td>
                    <td class="px-6 py-4">{{ $jadwal->lokasi }}</td>
                    <td class="px-6 py-4">{{ $jadwal->keterangan }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('jadwal-pengangkutan.edit', $jadwal->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('jadwal-pengangkutan.destroy', $jadwal->id) }}" method="POST" class="inline"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr class="bg-white border-b">
                    <td colspan="7" class="px-6 py-4 text-center">Tidak ada data jadwal.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="px-10 mt-4">
    {{ $jadwals->links() }}
</div>
@endsection
