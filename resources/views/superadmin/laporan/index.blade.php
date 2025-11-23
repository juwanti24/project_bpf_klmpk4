@extends('layouts.superadmin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark" style="font-size: 1.75rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <i class="fas fa-chart-line me-2" style="color: #ffbe33;"></i>Laporan Penjualan
        </h2>
        <div>
            <a href="{{ route('superadmin.laporan.create') }}" class="btn" style="background: #ffbe33; color: #222831; border: none; border-radius: 10px; padding: 10px 20px; font-weight: 600;">
                <i class="fas fa-plus me-2"></i>Tambah Laporan Manual
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success rounded-3 mb-4">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    </div>
    @endif

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm border-0" style="background: white; border-radius: 15px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 600;">Total Pesanan</h6>
                            <h3 class="mb-0 fw-bold" style="color: #ffbe33; font-size: 2rem;">{{ number_format($totalPesanan) }}</h3>
                        </div>
                        <div class="fs-1" style="color: #ffbe33;">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm border-0" style="background: white; border-radius: 15px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 600;">Total Penjualan</h6>
                            <h3 class="mb-0 fw-bold" style="color: #ffbe33; font-size: 1.5rem;">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</h3>
                        </div>
                        <div class="fs-1" style="color: #ffbe33;">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background: #ffbe33; color: #222831;">
                        <tr>
                            <th style="padding: 15px; font-weight: 600;">No</th>
                            <th style="padding: 15px; font-weight: 600;">Bulan</th>
                            <th style="padding: 15px; font-weight: 600;">Total Pesanan</th>
                            <th style="padding: 15px; font-weight: 600;">Total Penjualan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $index => $laporan)
                        <tr style="border-bottom: 1px solid #e0e0e0;">
                            <td style="padding: 15px;">{{ $index + 1 }}</td>
                            <td style="padding: 15px; font-weight: 600; color: #222831;"><strong>{{ date('F Y', strtotime($laporan->bulan . '-01')) }}</strong></td>
                            <td style="padding: 15px;">
                                <span class="badge" style="background: #ffbe33; color: #222831; padding: 5px 12px; border-radius: 20px;">{{ number_format($laporan->total_pesanan) }}</span>
                            </td>
                            <td style="padding: 15px;">
                                <strong style="color: #ffbe33; font-size: 1.1rem;">Rp {{ number_format($laporan->total_penjualan, 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2"></i>
                                <p>Belum ada data pesanan</p>
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