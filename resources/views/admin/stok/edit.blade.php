@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark"><i class="fas fa-edit me-2"></i>Edit Stok</h2>
        <a href="{{ route('admin.stok.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('admin.stok.update', $stok->stok_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="menu_id" class="form-label fw-semibold">Menu <span class="text-danger">*</span></label>
                            <select class="form-select @error('menu_id') is-invalid @enderror" id="menu_id" name="menu_id" required>
                                <option value="">Pilih Menu</option>
                                @foreach($menus as $menu)
                                <option value="{{ $menu->menu_id }}" 
                                    {{ old('menu_id', $stok->menu_id) == $menu->menu_id ? 'selected' : '' }}>
                                    {{ $menu->nama_menu }} - {{ ucfirst($menu->kategori) }} (Rp {{ number_format($menu->harga, 0, ',', '.') }})
                                </option>
                                @endforeach
                            </select>
                            @error('menu_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_stok" class="form-label fw-semibold">Jumlah Stok <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('jumlah_stok') is-invalid @enderror" 
                                   id="jumlah_stok" name="jumlah_stok" value="{{ old('jumlah_stok', $stok->jumlah_stok) }}" 
                                   min="0" required>
                            @error('jumlah_stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.stok.index') }}" class="btn btn-secondary">Batal</a>
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

