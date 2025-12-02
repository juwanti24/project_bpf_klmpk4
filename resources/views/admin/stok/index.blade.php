@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark"><i class="fas fa-boxes me-2"></i>Manajemen Stok</h2>
        <a href="{{ route('admin.stok.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Stok
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Menu</th>
                            <th>Kategori</th>
                            <th>Jumlah Stok</th>
                            <th>Status</th>
                            <th>Terakhir Update</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stoks as $stok)
                        <tr>
                            <td>{{ $stok->stok_id }}</td>
                            <td>
                                <strong>{{ $stok->menu->nama_menu ?? '-' }}</strong>
                            </td>
                            <td>
                                @if($stok->menu)
                                    <span class="badge bg-info">{{ ucfirst($stok->menu->kategori) }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $stok->jumlah_stok > 10 ? 'bg-success' : ($stok->jumlah_stok > 0 ? 'bg-warning' : 'bg-danger') }} fs-6">
                                    {{ $stok->jumlah_stok }}
                                </span>
                            </td>
                            <td>
                                @if($stok->jumlah_stok > 10)
                                    <span class="badge bg-success">Tersedia</span>
                                @elseif($stok->jumlah_stok > 0)
                                    <span class="badge bg-warning">Menipis</span>
                                @else
                                    <span class="badge bg-danger">Habis</span>
                                @endif
                            </td>
                            <td>{{ $stok->updated_at->format('d M Y H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.stok.edit', $stok->stok_id) }}" 
                                       class="btn btn-sm btn-warning text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.stok.destroy', $stok->stok_id) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus stok ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2"></i>
                                <p>Tidak ada data stok</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
