@extends('layouts.admin') <!-- pakai layout utama dashboard admin -->

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Menu</h2>
    <a href="{{ route('admin.menu.create') }}" class="btn btn-success"><i class="fa-solid fa-plus"></i> Tambah Menu</a>
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
@endsection
