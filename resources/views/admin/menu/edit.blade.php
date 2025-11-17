@extends('layouts.admin')

@section('content')
<h2>Edit Menu</h2>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
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
        <label>Nama Menu</label>
        <input type="text" name="nama_menu" class="form-control" value="{{ $menu->nama_menu }}" required>
    </div>
    <div class="mb-3">
        <label>Kategori</label>
        <input type="text" name="kategori" class="form-control" value="{{ $menu->kategori }}" required>
    </div>
    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control">{{ $menu->deskripsi }}</textarea>
    </div>
    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" value="{{ $menu->harga }}" required>
    </div>
    <div class="mb-3">
        <label>Gambar Menu</label>
        <input type="file" name="gambar_menu" class="form-control">
        @if($menu->gambar_menu)
        <img src="{{ asset('storage/'.$menu->gambar_menu) }}" width="100" class="mt-2">
        @endif
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
