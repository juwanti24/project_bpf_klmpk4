@extends('layouts.superadmin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark" style="font-size: 1.75rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <i class="fas fa-users-cog me-2" style="color: #ffbe33;"></i>Manajemen Admin
        </h2>
        <a href="{{ route('superadmin.admins.create') }}" class="btn" style="background: #ffbe33; color: #222831; border: none; border-radius: 10px; padding: 10px 20px; font-weight: 600;">
            <i class="fas fa-plus me-2"></i>Tambah Admin
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success rounded-3 mb-4">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger rounded-3 mb-4">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
    </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background: #ffbe33; color: #222831;">
                        <tr>
                            <th style="padding: 15px; font-weight: 600;">ID</th>
                            <th style="padding: 15px; font-weight: 600;">Username</th>
                            <th style="padding: 15px; font-weight: 600;">Role</th>
                            <th style="padding: 15px; font-weight: 600;">Dibuat</th>
                            <th style="padding: 15px; font-weight: 600;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $admin)
                        <tr style="border-bottom: 1px solid #e0e0e0;">
                            <td style="padding: 15px;">{{ $admin->admin_id }}</td>
                            <td style="padding: 15px; font-weight: 600; color: #222831;"><strong>{{ $admin->username }}</strong></td>
                            <td style="padding: 15px;">
                                @if($admin->role === 'superadmin')
                                <span class="badge" style="background: #dc3545; color: white; padding: 5px 12px; border-radius: 20px;">Super Admin</span>
                                @else
                                <span class="badge" style="background: #ffbe33; color: #222831; padding: 5px 12px; border-radius: 20px;">Kasir</span>
                                @endif
                            </td>
                            <td style="padding: 15px;">{{ $admin->created_at->format('d M Y') }}</td>
                            <td style="padding: 15px;">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('superadmin.admins.edit', $admin->admin_id) }}" 
                                       class="btn btn-sm" style="background: #ffbe33; color: #222831; border: none; border-radius: 8px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('superadmin.admins.destroy', $admin->admin_id) }}" 
                                          method="POST" style="display:inline-block;"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
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
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2"></i>
                                <p>Tidak ada data admin</p>
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
