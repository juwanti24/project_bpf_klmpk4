@extends('layouts.app')

@section('title', 'Menu Café')

@push('styles')
<style>
    /* BACKGROUND GRADIENT */
    .accent-bg { 
        background: linear-gradient(180deg,#f05340,#ff7a5c); 
        color: white; 
    }

    /* CARD ANIMATION */
    .menu-card{
        transition: transform .12s, box-shadow .12s;
        border-radius: 12px;
        overflow: hidden;
    }
    .menu-card:hover{
        transform: translateY(-6px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }

    .menu-card img {
        height: 200px;
        object-fit: cover;
    }

    /* BUTTON STYLE */
    .btn-success{
        background: linear-gradient(90deg, #47c76a, #3fab54);
        border: none;
        transition: .2s;
    }
    .btn-success:hover{
        background: linear-gradient(90deg, #3fab54, #47c76a);
        transform: scale(1.05);
    }

    /* FILTER CARD */
    .card.shadow-sm {
        border-radius: 12px;
    }
</style>
@endpush

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h4 fw-bold">Menu Café</h1>
    </div>

    {{-- FILTER & SEARCH BAR --}}
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <form method="GET" action="{{ route('pelanggan.menu') }}">
                <div class="row g-3 align-items-end">

                    {{-- Dropdown Kategori --}}
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Filter Kategori</label>
                        <select name="kategori" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Kategori</option>
                            
                            @if(isset($listKategori))
                                @foreach($listKategori as $item)
                                    <option value="{{ $item->kategori }}" 
                                        {{ request('kategori') == $item->kategori ? 'selected' : '' }}>
                                        {{ ucfirst($item->kategori) }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    {{-- Search Bar --}}
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Cari Menu</label>
                        <input type="text" name="search" class="form-control"
                               placeholder="Cari nama menu / deskripsi..."
                               value="{{ request('search') }}">
                    </div>

                    {{-- Search Button --}}
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">
                            <i class="fa-solid fa-search"></i> Cari
                        </button>
                    </div>

                    {{-- Reset --}}
                    <div class="col-md-2">
                        <a href="{{ route('pelanggan.menu') }}" class="btn btn-secondary w-100">
                            Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- CARD LIST --}}
    <div class="row mt-4">
        @forelse ($menus as $m)
            <div class="col-md-4 mb-4">
                <div class="card menu-card shadow-sm">
                    @if($m->gambar_menu)
                        <img src="{{ Storage::url($m->gambar_menu) }}" class="card-img-top" alt="{{ $m->nama_menu }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $m->nama_menu }}</h5>
                        <h6 class="text-muted">{{ ucfirst($m->kategori) }}</h6>
                        <p class="card-text">{{ Str::limit($m->deskripsi, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Rp {{ number_format($m->harga, 0, ',', '.') }}</strong>
                            <a href="{{ route('pelanggan.pesan', $m->menu_id) }}" class="btn btn-sm btn-success">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada menu tersedia.</div>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $menus->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection
