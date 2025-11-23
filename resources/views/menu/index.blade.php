@extends('layouts.app')

@section('title', 'Menu - Ruang Rasa')

@push('styles')
<style>
    .hero-menu {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1920') center/cover;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        padding: 80px 20px;
    }
    
    .hero-menu h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
    }
    
    .hero-menu p {
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto 30px;
    }
</style>
@endpush

@section('content')
    {{-- Hero Section --}}
    <div class="hero-menu">
        <div class="container">
            <h1>Ruang Rasa</h1>
            <p>Selamat datang di Ruang Rasa! Nikmati berbagai pilihan makanan dan minuman berkualitas dengan cita rasa yang memukau. Setiap hidangan disajikan dengan penuh cinta dan perhatian untuk memberikan pengalaman kuliner yang tak terlupakan.</p>
            <a href="#menu" class="btn-feane">Order Now</a>
        </div>
    </div>

    {{-- Menu Section --}}
    <div id="menu" class="container py-5">
        <div class="section-title">
            <h2>Our Menu</h2>
        </div>

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- Filter Tabs --}}
        <div class="filter-tabs">
            <a href="{{ route('pelanggan.menu') }}" class="filter-tab {{ !request('kategori') ? 'active' : '' }}">
                All
            </a>
            @if(isset($listKategori))
                @foreach($listKategori as $item)
                    <a href="{{ route('pelanggan.menu', ['kategori' => $item->kategori]) }}" 
                       class="filter-tab {{ request('kategori') == $item->kategori ? 'active' : '' }}">
                        {{ ucfirst($item->kategori) }}
                    </a>
                @endforeach
            @endif
        </div>

        {{-- Search Bar --}}
        <div class="row mb-4">
            <div class="col-md-8 mx-auto">
                <form method="GET" action="{{ route('pelanggan.menu') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-lg" 
                               placeholder="Cari menu..." value="{{ request('search') }}">
                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                        <button class="btn btn-feane" type="submit">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Menu Cards --}}
        <div class="row">
            @forelse ($menus as $m)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="menu-card-feane">
                        @if($m->gambar_menu)
                            <img src="{{ Storage::url($m->gambar_menu) }}" alt="{{ $m->nama_menu }}">
                        @else
                            <img src="https://via.placeholder.com/400x250?text=No+Image" alt="{{ $m->nama_menu }}">
                        @endif
                        <div class="card-body">
                            <h5>{{ $m->nama_menu }}</h5>
                            <div class="menu-category">{{ ucfirst($m->kategori) }}</div>
                            <p>{{ Str::limit($m->deskripsi ?? 'Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam voluptatem repellendus sed eaque', 80) }}</p>
                            <div class="price">Rp {{ number_format($m->harga, 0, ',', '.') }}</div>
                            <a href="{{ route('pelanggan.pesan', $m->menu_id) }}" class="btn-feane w-100 text-center">
                                Order Now
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i>Belum ada menu tersedia.
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($menus->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $menus->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
@endsection
