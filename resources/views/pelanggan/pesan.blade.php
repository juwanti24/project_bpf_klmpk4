@extends('layouts.app')

@section('title', 'Pesan Menu - Ruang Rasa')

@push('styles')
<style>
    .order-hero {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1920') center/cover;
        min-height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        padding: 40px 20px;
    }
    
    .order-card {
        max-width: 700px;
        margin: -50px auto 50px;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        background: white;
        position: relative;
        z-index: 1;
    }
    
    .menu-image {
        width: 100%;
        max-height: 350px;
        object-fit: cover;
        border-radius: 15px;
        margin-bottom: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .price-display {
        font-size: 1.8rem;
        font-weight: 700;
        color: #ffbe33;
    }
    
    .subtotal {
        font-size: 2rem;
        font-weight: 700;
        color: #ffbe33;
    }
    
    .order-card h2 {
        color: #222831;
        font-weight: 700;
        margin-bottom: 15px;
    }
    
    .form-control, .form-select {
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        padding: 12px 16px;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #ffbe33;
        box-shadow: 0 0 0 0.2rem rgba(255,190,51,0.25);
    }
</style>
@endpush

@section('content')
    <div class="order-hero">
        <div class="container">
            <h1 style="font-size: 2.5rem; font-weight: 700;">Pesan Menu Favorit Anda</h1>
        </div>
    </div>

    <div class="container">
        <div class="order-card">
            <h2 class="text-center mb-4">
                <i class="fas fa-utensils me-2" style="color: #ffbe33;"></i>{{ $menu->nama_menu }}
            </h2>

            @if($menu->gambar_menu)
                <img src="{{ Storage::url($menu->gambar_menu) }}" alt="{{ $menu->nama_menu }}" class="menu-image">
            @else
                <img src="https://via.placeholder.com/700x350?text=No+Image" alt="{{ $menu->nama_menu }}" class="menu-image">
            @endif

            <div class="text-center mb-4">
                <span class="badge" style="background: #ffbe33; color: #222831; padding: 8px 20px; font-size: 1rem; border-radius: 20px;">
                    {{ ucfirst($menu->kategori) }}
                </span>
            </div>

            <p class="text-center text-muted mb-4">{{ $menu->deskripsi ?? 'Menu lezat dengan kualitas terbaik' }}</p>

            <form action="{{ route('pelanggan.pesan.simpan') }}" method="POST">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->menu_id }}">
                <input type="hidden" name="nama_pelanggan" value="{{ session('customer.nama') }}">
                <input type="hidden" name="no_hp" value="{{ session('customer.no_hp') }}">

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold" style="color: #222831;">
                            <i class="fas fa-tag me-2" style="color: #ffbe33;"></i>Harga Satuan
                        </label>
                        <div class="price-display">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold" style="color: #222831;">
                            <i class="fas fa-shopping-cart me-2" style="color: #ffbe33;"></i>Jumlah Pesanan
                        </label>
                        <input type="number" id="jumlah" name="jumlah" class="form-control form-control-lg" 
                               value="1" min="1" max="{{ $stokMenu->jumlah_stok ?? 999 }}" required>
                        @if(isset($stokMenu))
                            <small class="text-muted">Stok tersedia: {{ $stokMenu->jumlah_stok }}</small>
                        @endif
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold" style="color: #222831;">
                        <i class="fas fa-chair me-2" style="color: #ffbe33;"></i>Nomor Meja
                    </label>
                    <input type="text" name="nomor_meja" class="form-control form-control-lg" 
                           placeholder="Masukkan nomor meja" required>
                </div>

                <div class="mb-4 p-4" style="background: #f8f9fa; border-radius: 15px;">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="fw-bold" style="color: #222831; font-size: 1.2rem;">Total Bayar:</span>
                        </div>
                        <div class="col-6 text-end">
                            <div class="subtotal" id="subtotal">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold" style="color: #222831;">
                        <i class="fas fa-sticky-note me-2" style="color: #ffbe33;"></i>Catatan (Opsional)
                    </label>
                    <textarea name="catatan" class="form-control" rows="3" 
                              placeholder="Contoh: kurang pedas, tanpa bawang..."></textarea>
                </div>

                <div class="alert alert-warning mb-4" style="border-radius: 10px; border-left: 4px solid #ffbe33;">
                    <strong><i class="fas fa-exclamation-triangle me-2"></i>Perhatian!</strong> 
                    Silakan bayar langsung ke kasir dengan nominal 
                    <span class="subtotal" id="bayar">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn-feane btn-lg">
                        <i class="fas fa-check me-2"></i><strong>Buat Pesanan</strong>
                    </button>
                    <a href="{{ route('pelanggan.menu') }}" class="btn btn-outline-secondary btn-lg" style="border-radius: 10px;">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Menu
                    </a>
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
