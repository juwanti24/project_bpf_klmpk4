@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark"><i class="fas fa-chart-pie me-2"></i>Dashboard Admin</h2>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Total Menu</h6>
                            <h3 class="mb-0 fw-bold">{{ number_format($totalMenu) }}</h3>
                        </div>
                        <div class="fs-1">
                            <i class="fas fa-utensils"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-success text-white">
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
        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Total Stok</h6>
                            <h3 class="mb-0 fw-bold">{{ number_format($totalStok) }}</h3>
                        </div>
                        <div class="fs-1">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-warning text-white">
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

    <!-- Additional Stats -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Admin</h6>
                    <h4 class="fw-bold text-primary">{{ number_format($totalAdmin) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Pelanggan</h6>
                    <h4 class="fw-bold text-success">{{ number_format($totalPelanggan) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Pesanan Hari Ini</h6>
                    <h4 class="fw-bold text-info">{{ number_format($pesananHariIni) }}</h4>
                    <small class="text-muted">Penjualan: Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
