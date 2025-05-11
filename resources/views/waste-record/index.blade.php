@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Riwayat Sampah</span>
                    <a href="{{ route('waste-record.create') }}" class="btn btn-sm btn-primary">Tambah Catatan Baru</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <form method="GET" action="{{ route('waste-record.index') }}" class="row g-3">
                            <div class="col-md-4">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date" class="form-label">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-secondary me-2">Filter</button>
                                <a href="{{ route('waste-record.index') }}" class="btn btn-outline-secondary">Reset</a>
                            </div>
                        </form>
                    </div>

                    @if($records->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{ $record->date->format('d/m/Y') }}</td>
                                            <td>
                                                <span class="badge bg-{{ $record->category == 'organik' ? 'success' : ($record->category == 'anorganik' ? 'danger' : 'warning') }}">
                                                    {{ $record->category_name }}
                                                </span>
                                            </td>
                                            <td>{{ $record->description ?? '-' }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('waste-record.edit', $record) }}" class="btn btn-outline-primary">Edit</a>
                                                    <form action="{{ route('waste-record.destroy', $record) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus catatan ini?')">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $records->links() }}
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            Belum ada data sampah yang tercatat.
                            <a href="{{ route('waste-record.create') }}" class="alert-link">Tambah catatan baru</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection