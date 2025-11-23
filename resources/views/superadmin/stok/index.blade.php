@extends('layouts.superadmin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark" style="font-size: 1.75rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <i class="fas fa-boxes me-2" style="color: #ffbe33;"></i>Manajemen Stok
        </h2>
        <a href="{{ route('superadmin.stok.create') }}" class="btn" style="background: #ffbe33; color: #222831; border: none; border-radius: 10px; padding: 10px 20px; font-weight: 600;">
            <i class="fas fa-plus me-2"></i>Tambah Stok
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success rounded-3 mb-4">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background: #ffbe33; color: #222831;">
                        <tr>
                            <th style="padding: 15px; font-weight: 600;">ID</th>
                            <th style="padding: 15px; font-weight: 600;">Menu</th>
                            <th style="padding: 15px; font-weight: 600;">Kategori</th>
                            <th style="padding: 15px; font-weight: 600;">Jumlah Stok</th>
                            <th style="padding: 15px; font-weight: 600;">Status</th>
                            <th style="padding: 15px; font-weight: 600;">Terakhir Update</th>
                            <th style="padding: 15px; font-weight: 600;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stoks as $stok)
                        <tr style="border-bottom: 1px solid #e0e0e0;">
                            <td style="padding: 15px;">{{ $stok->stok_id }}</td>
                            <td style="padding: 15px; font-weight: 600; color: #222831;">
                                <strong>{{ $stok->menu->nama_menu ?? '-' }}</strong>
                            </td>
                            <td style="padding: 15px;">
                                @if($stok->menu)
                                    <span class="badge" style="background: #ffbe33; color: #222831; padding: 5px 12px; border-radius: 20px;">{{ ucfirst($stok->menu->kategori) }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td style="padding: 15px;">
                                <span class="badge" style="background: {{ $stok->jumlah_stok > 10 ? '#28a745' : ($stok->jumlah_stok > 0 ? '#ffc107' : '#dc3545') }}; color: white; padding: 5px 12px; border-radius: 20px; font-size: 0.9rem;">
                                    {{ $stok->jumlah_stok }}
                                </span>
                            </td>
                            <td style="padding: 15px;">
                                @if($stok->jumlah_stok > 10)
                                    <span class="badge" style="background: #28a745; color: white; padding: 5px 12px; border-radius: 20px;">Tersedia</span>
                                @elseif($stok->jumlah_stok > 0)
                                    <span class="badge" style="background: #ffc107; color: #222831; padding: 5px 12px; border-radius: 20px;">Menipis</span>
                                @else
                                    <span class="badge" style="background: #dc3545; color: white; padding: 5px 12px; border-radius: 20px;">Habis</span>
                                @endif
                            </td>
                            <td style="padding: 15px;">{{ $stok->updated_at->format('d M Y H:i') }}</td>
                            <td style="padding: 15px;">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('superadmin.stok.edit', $stok->stok_id) }}" 
                                       class="btn btn-sm" style="background: #ffbe33; color: #222831; border: none; border-radius: 8px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('superadmin.stok.destroy', $stok->stok_id) }}" 
                                          method="POST" style="display:inline-block;"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus stok ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" style="border-radius: 8px;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2"></i>
                                <p>Tidak ada data stok</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
