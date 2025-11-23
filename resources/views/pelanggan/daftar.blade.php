@extends('layouts.app')

@section('title', 'Daftar - Ruang Rasa')

@push('styles')
<style>
    .hero-register {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1920') center/cover;
        min-height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        padding: 60px 20px;
    }
    
    .register-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        padding: 40px;
        margin-top: -50px;
        position: relative;
        z-index: 1;
    }
</style>
@endpush

@section('content')
    {{-- Hero Section --}}
    <div class="hero-register">
        <div class="container">
            <h1 style="font-size: 2.5rem; font-weight: 700;">Selamat Datang di Ruang Rasa</h1>
            <p style="font-size: 1.1rem;">Daftar sekarang untuk memesan makanan dan minuman favorit Anda</p>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="register-card">
                    <h4 class="mb-4 fw-bold text-center" style="color: #222831; font-size: 1.75rem;">
                        <i class="fas fa-user-plus me-2" style="color: #ffbe33;"></i>Daftar Pelanggan
                    </h4>

                    @if (session('error'))
                        <div class="alert alert-danger rounded-3">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pelanggan.simpan') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: #222831;">
                                <i class="fas fa-user me-2" style="color: #ffbe33;"></i>Nama
                            </label>
                            <input type="text" name="nama" class="form-control form-control-lg" 
                                   value="{{ old('nama') }}" required 
                                   style="border: 2px solid #e0e0e0; padding: 12px 16px; border-radius: 10px;">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: #222831;">
                                <i class="fas fa-phone me-2" style="color: #ffbe33;"></i>No HP
                            </label>
                            <input type="text" name="no_hp" class="form-control form-control-lg" 
                                   value="{{ old('no_hp') }}" required 
                                   style="border: 2px solid #e0e0e0; padding: 12px 16px; border-radius: 10px;">
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn-feane btn-lg">
                                <i class="fas fa-check me-2"></i>Daftar & Lihat Menu
                            </button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('pelanggan.menu') }}" class="text-decoration-none" style="color: #666;">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Menu
                            </a>
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <a href="{{ route('admin.login') }}" class="btn btn-outline-dark w-100" style="border-radius: 10px;">
                                <i class="fas fa-user-shield me-2"></i>Login sebagai Admin
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
