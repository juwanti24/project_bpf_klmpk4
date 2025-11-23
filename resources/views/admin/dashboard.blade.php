@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark" style="font-size: 1.75rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <i class="fas fa-chart-pie me-2" style="color: #ffbe33;"></i>Dashboard Admin
        </h2>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0" style="background: white; border-radius: 15px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 600;">Total Menu</h6>
                            <h3 class="mb-0 fw-bold" style="color: #ffbe33; font-size: 2rem;">{{ number_format($totalMenu) }}</h3>
                        </div>
                        <div class="fs-1" style="color: #ffbe33;">
                            <i class="fas fa-utensils"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
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
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0" style="background: white; border-radius: 15px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 600;">Total Stok</h6>
                            <h3 class="mb-0 fw-bold" style="color: #ffbe33; font-size: 2rem;">{{ number_format($totalStok) }}</h3>
                        </div>
                        <div class="fs-1" style="color: #ffbe33;">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
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

    <!-- Additional Stats -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-body">
                    <h6 class="text-muted mb-2" style="font-weight: 600;">Total Admin</h6>
                    <h4 class="fw-bold" style="color: #ffbe33; font-size: 1.8rem;">{{ number_format($totalAdmin) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-body">
                    <h6 class="text-muted mb-2" style="font-weight: 600;">Total Pelanggan</h6>
                    <h4 class="fw-bold" style="color: #ffbe33; font-size: 1.8rem;">{{ number_format($totalPelanggan) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-body">
                    <h6 class="text-muted mb-2" style="font-weight: 600;">Pesanan Hari Ini</h6>
                    <h4 class="fw-bold" style="color: #ffbe33; font-size: 1.8rem;">{{ number_format($pesananHariIni) }}</h4>
                    <small class="text-muted">Penjualan: Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
