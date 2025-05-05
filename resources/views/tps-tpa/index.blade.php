@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Manajemen Kapasitas TPS dan TPA</h3>
                    <a href="{{ route('tps-tpa.create') }}" class="btn btn-primary">Tambah Data</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tipe</th>
                                    <th>Kapasitas Total</th>
                                    <th>Kapasitas Terisi</th>
                                    <th>Persentase Terisi</th>
                                    <th>Lokasi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tpsTpa as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->tipe }}</td>
                                    <td>{{ number_format($item->kapasitas_total, 2) }} m³</td>
                                    <td>{{ number_format($item->kapasitas_terisi, 2) }} m³</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar {{ $item->persentase_terisi > 80 ? 'bg-danger' : ($item->persentase_terisi > 60 ? 'bg-warning' : 'bg-success') }}" 
                                                 role="progressbar" 
                                                 style="width: {{ $item->persentase_terisi }}%"
                                                 aria-valuenow="{{ $item->persentase_terisi }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                {{ number_format($item->persentase_terisi, 1) }}%
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->lokasi }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <a href="{{ route('tps-tpa.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('tps-tpa.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 