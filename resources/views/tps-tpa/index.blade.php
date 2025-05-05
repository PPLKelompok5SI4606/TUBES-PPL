@extends('dashboard.main')

@section('content')
    <p class="font-poppins font-medium text-gray-800 text-[28px] ms-10 mb-6">Manajemen Kapasitas TPS dan TPA</p>

    <div class="px-10 w-full">
        <div class="flex justify-between items-center mb-4">
            <div></div>
            <a href="{{ route('tps-tpa.create') }}" class="bg-primary-green hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                Tambah Data
            </a>
        </div>

        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-white uppercase bg-primary-green">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Tipe</th>
                        <th scope="col" class="px-6 py-3">Kapasitas Total</th>
                        <th scope="col" class="px-6 py-3">Kapasitas Terisi</th>
                        <th scope="col" class="px-6 py-3">Persentase Terisi</th>
                        <th scope="col" class="px-6 py-3">Lokasi</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tpsTpa as $item)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $item->nama }}</td>
                        <td class="px-6 py-4">{{ $item->tipe }}</td>
                        <td class="px-6 py-4">{{ number_format($item->kapasitas_total, 2) }} m³</td>
                        <td class="px-6 py-4">{{ number_format($item->kapasitas_terisi, 2) }} m³</td>
                        <td class="px-6 py-4">
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="h-2.5 rounded-full {{ $item->persentase_terisi > 80 ? 'bg-red-500' : ($item->persentase_terisi > 60 ? 'bg-yellow-400' : 'bg-green-500') }}" 
                                     style="width: {{ $item->persentase_terisi }}%"></div>
                            </div>
                            <span class="text-xs font-medium mt-1 block">{{ number_format($item->persentase_terisi, 1) }}%</span>
                        </td>
                        <td class="px-6 py-4">{{ $item->lokasi }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('tps-tpa.edit', $item->id) }}" 
                               class="text-primary-green hover:underline">
                                Edit
                            </a>
                            <form action="{{ route('tps-tpa.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:underline"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @if(count($tpsTpa) == 0)
                    <tr class="bg-white border-b">
                        <td colspan="8" class="px-6 py-4 text-center">
                            Tidak ada data TPS atau TPA.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    @if(method_exists($tpsTpa, 'links'))
    <div class="px-10 mt-4">
        {{ $tpsTpa->links() }}
    </div>
    @endif
@endsection