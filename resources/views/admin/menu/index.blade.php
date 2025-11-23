@extends('layouts.admin') <!-- pakai layout utama dashboard admin -->

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark" style="font-size: 1.75rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <i class="fas fa-utensils me-2" style="color: #ffbe33;"></i>Daftar Menu
    </h2>
    <a href="{{ route('admin.menu.create') }}" class="btn" style="background: #ffbe33; color: #222831; border: none; border-radius: 10px; padding: 10px 20px; font-weight: 600;">
        <i class="fa-solid fa-plus me-2"></i>Tambah Menu
    </a>
</div>

<div class="card mb-4 shadow-sm border-0" style="border-radius: 20px;">
    <div class="card-body p-4">
        <form method="GET" action="{{ route('admin.menu.index') }}">
            <div class="row g-3 align-items-end">

                {{-- Dropdown Kategori --}}
                <div class="col-md-4">
                    <label class="form-label fw-bold" style="color: #222831;">
                        <i class="fas fa-filter me-2" style="color: #ffbe33;"></i>Filter Kategori
                    </label>
                    <select name="kategori" class="form-select" onchange="this.form.submit()" style="border-radius: 10px; border: 2px solid #e0e0e0; padding: 12px 16px;">
                        <option value="">Semua Kategori</option>
                        @foreach($listKategori as $item)
                            <option value="{{ $item->kategori }}"
                                {{ ($kategori == $item->kategori) ? 'selected' : '' }}>
                                {{ $item->kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Search Bar --}}
                <div class="col-md-4">
                    <label class="form-label fw-bold" style="color: #222831;">
                        <i class="fas fa-search me-2" style="color: #ffbe33;"></i>Cari Menu
                    </label>
                    <input type="text" name="search" class="form-control"
                           value="{{ $search }}" placeholder="Cari nama menu / deskripsi..."
                           style="border-radius: 10px; border: 2px solid #e0e0e0; padding: 12px 16px;">
                </div>

                {{-- Tombol Search --}}
                <div class="col-md-2">
                    <button class="btn w-100" style="background: #ffbe33; color: #222831; border: none; border-radius: 10px; padding: 12px; font-weight: 600;">
                        <i class="fa-solid fa-magnifying-glass me-1"></i>Cari
                    </button>
                </div>

                {{-- Tombol Reset --}}
                <div class="col-md-2">
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-secondary w-100" style="border-radius: 10px; padding: 12px; font-weight: 600;">
                        Reset
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>



@if(session('success'))
<div class="alert alert-success rounded-3 mb-4">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
</div>
@endif

{{-- Menu Cards Grid --}}
<div class="row">
    @foreach($menus as $index => $menu)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden; transition: all 0.3s ease;">
                @if($menu->gambar_menu)
                    <img src="{{ asset('storage/' . $menu->gambar_menu) }}" class="card-img-top" alt="{{ $menu->nama_menu }}" style="height: 200px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/400x200?text=No+Image" class="card-img-top" alt="{{ $menu->nama_menu }}" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title fw-bold" style="color: #222831;">{{ $menu->nama_menu }}</h5>
                    <span class="badge mb-2" style="background: #ffbe33; color: #222831; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem;">
                        {{ ucfirst($menu->kategori) }}
                    </span>
                    <p class="card-text text-muted" style="font-size: 0.9rem;">{{ Str::limit($menu->deskripsi, 80) }}</p>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 fw-bold" style="color: #ffbe33; font-size: 1.3rem;">Rp {{ number_format($menu->harga,0,',','.') }}</h6>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.menu.edit', $menu->menu_id) }}" class="btn btn-sm flex-fill" style="background: #ffbe33; color: #222831; border: none; border-radius: 8px; font-weight: 600;">
                            <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                        </a>
                        <form action="{{ route('admin.menu.destroy', $menu->menu_id) }}" method="POST" class="flex-fill" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100" style="border-radius: 8px; font-weight: 600;" onclick="return confirm('Yakin ingin hapus menu ini?')">
                                <i class="fa-solid fa-trash me-1"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="d-flex justify-content-center mt-4">
    {{ $menus->links('pagination::bootstrap-5') }}
</div>


@endsection
