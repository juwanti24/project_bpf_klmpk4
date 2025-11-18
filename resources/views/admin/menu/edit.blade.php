@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark"><i class="fas fa-edit me-2"></i>Edit Menu</h2>
        <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('admin.menu.update', $menu->menu_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="nama_menu" class="form-label fw-semibold">Nama Menu <span class="text-danger">*</span></label>
                            <input type="text" name="nama_menu" id="nama_menu" 
                                   class="form-control @error('nama_menu') is-invalid @enderror" 
                                   value="{{ old('nama_menu', $menu->nama_menu) }}" required>
                            @error('nama_menu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" id="kategori" 
                                    class="form-select @error('kategori') is-invalid @enderror" required>
                                <option value="makanan" {{ old('kategori', $menu->kategori) == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="minuman" {{ old('kategori', $menu->kategori) == 'minuman' ? 'selected' : '' }}>Minuman</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" 
                                      class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="harga" id="harga" 
                                   class="form-control @error('harga') is-invalid @enderror" 
                                   value="{{ old('harga', $menu->harga) }}" min="0" step="0.01" required>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar_menu" class="form-label fw-semibold">Gambar Menu</label>
                            @if($menu->gambar_menu)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$menu->gambar_menu) }}" 
                                     alt="Gambar Menu" 
                                     class="img-thumbnail" 
                                     style="max-width: 200px;">
                            </div>
                            @endif
                            <input type="file" name="gambar_menu" id="gambar_menu" 
                                   class="form-control @error('gambar_menu') is-invalid @enderror" 
                                   accept="image/*">
                            @error('gambar_menu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Batal</a>
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
