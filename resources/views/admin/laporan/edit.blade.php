@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark"><i class="fas fa-edit me-2"></i>Edit Laporan Penjualan</h2>
        <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('admin.laporan.update', $laporan->laporan_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="bulan" class="form-label fw-semibold">Bulan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('bulan') is-invalid @enderror" 
                                   id="bulan" name="bulan" value="{{ old('bulan', $laporan->bulan) }}" required>
                            @error('bulan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_pesanan" class="form-label fw-semibold">Total Pesanan <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('total_pesanan') is-invalid @enderror" 
                                   id="total_pesanan" name="total_pesanan" value="{{ old('total_pesanan', $laporan->total_pesanan) }}" 
                                   min="0" required>
                            @error('total_pesanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_penjualan" class="form-label fw-semibold">Total Penjualan (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('total_penjualan') is-invalid @enderror" 
                                   id="total_penjualan" name="total_penjualan" value="{{ old('total_penjualan', $laporan->total_penjualan) }}" 
                                   step="0.01" min="0" required>
                            @error('total_penjualan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection