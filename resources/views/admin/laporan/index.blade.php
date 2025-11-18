@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark"><i class="fas fa-chart-line me-2"></i>Laporan Penjualan</h2>
        <a href="{{ route('admin.laporan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Laporan
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Total Pesanan</h6>
                            <h3 class="mb-0 fw-bold">{{ number_format($totalPesanan) }}</h3>
                        </div>
                        <div class="fs-1">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Total Penjualan</h6>
                            <h3 class="mb-0 fw-bold">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</h3>
                        </div>
                        <div class="fs-1">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Bulan</th>
                            <th>Total Pesanan</th>
                            <th>Total Penjualan</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $laporan)
                        <tr>
                            <td>{{ $laporan->laporan_id }}</td>
                            <td><strong>{{ $laporan->bulan }}</strong></td>
                            <td>
                                <span class="badge bg-primary">{{ number_format($laporan->total_pesanan) }}</span>
                            </td>
                            <td>
                                <strong class="text-success">Rp {{ number_format($laporan->total_penjualan, 0, ',', '.') }}</strong>
                            </td>
                            <td>{{ $laporan->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.laporan.edit', $laporan->laporan_id) }}" 
                                       class="btn btn-sm btn-warning text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.laporan.destroy', $laporan->laporan_id) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
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
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2"></i>
                                <p>Tidak ada data laporan</p>
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

