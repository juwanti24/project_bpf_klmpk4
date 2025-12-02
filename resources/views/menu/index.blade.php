@extends('layouts.app')

@section('title', 'Menu Café')

@push('styles')
<style>
    /* colors / accents inspired by admin theme */
    .accent-bg { background: linear-gradient(180deg,#f05340,#ff7a5c); color: white; }
    .menu-card{transition: transform .12s}
    .menu-card:hover{transform: translateY(-6px)}
</style>
@endpush

@section('content')
<div class="container mt-4">
    <h1 class="h3 mb-4">Menu Café</h1>

    <div class="row">
        @forelse ($menus as $m)
            <div class="col-md-4 mb-4">
                <div class="card menu-card shadow-sm">
                    @if($m->gambar_menu)
                        <img src="{{ asset('storage/'.$m->gambar_menu) }}" class="card-img-top" alt="{{ $m->nama_menu }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $m->nama_menu }}</h5>
                        <h6 class="text-muted">{{ ucfirst($m->kategori) }}</h6>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($m->deskripsi, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Rp {{ number_format($m->harga, 0, ',', '.') }}</strong>
                            <a href="{{ route('pelanggan.pesan', $m->menu_id) }}" class="btn btn-sm btn-success">Pesan Sekarang</a>
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

    <div class="d-flex justify-content-center mt-3">{{-- pagination placeholder --}}</div>
</div>
@endsection
