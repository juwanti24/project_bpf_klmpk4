@extends('layouts.admin') <!-- pakai layout utama dashboard admin -->

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Menu</h2>
    <a href="{{ route('admin.menu.create') }}" class="btn btn-success"><i class="fa-solid fa-plus"></i> Tambah Menu</a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.menu.index') }}">
            <div class="row g-3 align-items-end">

                {{-- Dropdown Kategori --}}
                <div class="col-md-4">
                    <label class="form-label fw-bold">Filter Kategori</label>
                    <select name="kategori" class="form-select" onchange="this.form.submit()">
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
                    <label class="form-label fw-bold">Cari Menu</label>
                    <input type="text" name="search" class="form-control"
                           value="{{ $search }}" placeholder="Cari nama menu / deskripsi...">
                </div>

                {{-- Tombol Search --}}
                <div class="col-md-2">
                    <button class="btn btn-primary w-100">
                        <i class="fa-solid fa-magnifying-glass"></i> Cari
                    </button>
                </div>

                {{-- Tombol Reset --}}
                <div class="col-md-2">
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary w-100">
                        Reset
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>



@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-hover rounded shadow-sm">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Menu</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($menus as $index => $menu)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $menu->nama_menu }}</td>
            <td>{{ $menu->kategori }}</td>
            <td>{{ $menu->deskripsi }}</td>
            <td>Rp {{ number_format($menu->harga,0,',','.') }}</td>
            <td>
               @if($menu->gambar_menu)
<img src="{{ asset('storage/'.$menu->gambar_menu) }}" width="80" alt="Gambar Menu">
@endif

            </td>
            <td>
                <a href="{{ route('admin.menu.edit', $menu->menu_id) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                <form action="{{ route('admin.menu.destroy', $menu->menu_id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus menu ini?')"><i class="fa-solid fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center mt-4">
    {{ $menus->links('pagination::bootstrap-5') }}
</div>


@endsection
