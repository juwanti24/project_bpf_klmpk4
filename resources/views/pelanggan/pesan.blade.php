@extends('layouts.app')

@section('title', 'Pesan Menu')

@push('styles')
<style>
    .order-card {
        max-width: 600px;
        margin: 0 auto;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .menu-image {
        width: 100%;
        max-height: 300px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .price-display {
        font-size: 1.5rem;
        font-weight: bold;
        color: #28a745;
    }
    .subtotal {
        font-size: 1.8rem;
        font-weight: bold;
        color: #f05340;
    }
</style>
@endpush

@section('content')
<div class="container mt-4">
    <div class="order-card bg-white">
        <h2 class="mb-4">{{ $menu->nama_menu }}</h2>

        @if($menu->gambar_menu)
            <img src="{{ asset('storage/'.$menu->gambar_menu) }}" alt="{{ $menu->nama_menu }}" class="menu-image">
        @endif

        <p class="text-muted">{{ $menu->deskripsi }}</p>
        <p class="mb-3"><strong>Kategori:</strong> {{ ucfirst($menu->kategori) }}</p>

        <form action="{{ route('pelanggan.pesan.simpan') }}" method="POST">
            @csrf
            <input type="hidden" name="menu_id" value="{{ $menu->menu_id }}">
            <input type="hidden" name="nama_pelanggan" value="{{ session('customer.nama') }}">
            <input type="hidden" name="no_hp" value="{{ session('customer.no_hp') }}">

            <div class="mb-4 row align-items-end">
                <div class="col-md-6">
                    <label class="form-label"><strong>Harga Satuan</strong></label>
                    <div class="price-display">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><strong>Jumlah Pesanan</strong></label>
                    <input type="number" id="jumlah" name="jumlah" class="form-control" value="1" min="1" required>
                </div>
            </div>

            <div class="mb-4 p-3 bg-light rounded">
                <div class="row">
                    <div class="col-6">
                        <span><strong>Total Bayar:</strong></span>
                    </div>
                    <div class="col-6 text-end">
                        <div class="subtotal" id="subtotal">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label"><strong>Catatan (Opsional)</strong></label>
                <textarea name="catatan" class="form-control" rows="3" placeholder="Contoh: kurang pedas, tanpa bawang..."></textarea>
            </div>

            <div class="alert alert-info mb-4">
                <strong>⚠️ Perhatian!</strong> Silakan bayar langsung ke kasir dengan nominal <span class="subtotal" id="bayar">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('pelanggan.menu') }}" class="btn btn-outline-secondary flex-grow-1">Kembali ke Menu</a>
                <button type="submit" class="btn btn-success flex-grow-1"><strong>Buat Pesanan</strong></button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const harga = {{ $menu->harga }};
    const jumlahInput = document.getElementById('jumlah');
    const subtotalDisplay = document.getElementById('subtotal');
    const bayarDisplay = document.getElementById('bayar');

    function updateTotal() {
        const jumlah = parseInt(jumlahInput.value) || 0;
        const total = jumlah * harga;
        const formatted = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(total);
        subtotalDisplay.textContent = formatted;
        bayarDisplay.textContent = formatted;
    }

    jumlahInput.addEventListener('input', updateTotal);
    updateTotal();
</script>
@endpush

@endsection
