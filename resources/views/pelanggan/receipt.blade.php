@extends('layouts.app')

@section('title', 'Kwitansi Pesanan')

@push('styles')
<style>
    .receipt-card {
        max-width: 600px;
        margin: 0 auto;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        background: white;
    }
    .receipt-header {
        text-align: center;
        border-bottom: 2px solid #f05340;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }
    .receipt-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }
    .receipt-item strong {
        flex: 1;
    }
    .receipt-item span {
        text-align: right;
    }
    .total-section {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .total-amount {
        font-size: 1.8rem;
        font-weight: bold;
        color: #f05340;
        text-align: right;
    }
    .alert-custom {
        background: #fff3cd;
        border-left: 4px solid #ff9800;
        padding: 15px;
        border-radius: 5px;
        margin: 20px 0;
    }
    .success-icon {
        font-size: 2rem;
        color: #28a745;
        text-align: center;
        margin-bottom: 15px;
    }
</style>
@endpush

@section('content')
<div class="container mt-4">
    <div class="receipt-card">
        <div class="success-icon">✓</div>
        <div class="receipt-header">
            <h2>Kwitansi Pesanan</h2>
            <p class="text-muted mb-0">No. Pesanan: #{{ $pesanan->pesanan_id }}</p>
        </div>

        <div class="receipt-item">
            <strong>Nama Pelanggan:</strong>
            <span>{{ $pesanan->nama_pelanggan }}</span>
        </div>

        <div class="receipt-item">
            <strong>No. HP:</strong>
            <span>{{ $pesanan->no_hp }}</span>
        </div>

            <div class="receipt-item">
                <strong>Nomor Meja:</strong>
                <span>{{ $pesanan->meja->nomor_meja ?? '-' }}</span>
            </div>

        <div class="receipt-item">
            <strong>Tanggal Pesanan:</strong>
            <span>{{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d/m/Y') }}</span>
        </div>

        <hr>

        <div class="receipt-item">
            <strong>Menu:</strong>
            <span>{{ $pesanan->menu->nama_menu ?? '-' }}</span>
        </div>

        <div class="receipt-item">
            <strong>Jumlah:</strong>
            <span>{{ $pesanan->jumlah }} pcs</span>
        </div>

        <div class="receipt-item">
            <strong>Harga Satuan:</strong>
            <span>Rp {{ number_format($pesanan->menu->harga ?? 0, 0, ',', '.') }}</span>
        </div>

        @if($pesanan->catatan)
        <div class="receipt-item">
            <strong>Catatan:</strong>
            <span>{{ $pesanan->catatan }}</span>
        </div>
        @endif

        <div class="total-section">
            <div class="receipt-item">
                <strong>Total Bayar:</strong>
            </div>
            <div class="total-amount">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</div>
        </div>

        <div class="alert-custom">
            <strong>⚠️ PERHATIAN!</strong><br>
            Silakan bayar langsung ke kasir dengan nominal: <strong>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong><br>
            Tunjukkan kwitansi ini sebagai bukti pesanan.
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('pelanggan.menu') }}" class="btn btn-primary flex-grow-1"><strong>Kembali ke Menu</strong></a>
            <a href="{{ route('pelanggan.logout') }}" class="btn btn-outline-secondary flex-grow-1"><strong>Logout</strong></a>
        </div>
    </div>
</div>
@endsection
