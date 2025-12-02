@extends('layouts.superadmin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark"><i class="fas fa-users-cog me-2"></i>Manajemen Admin</h2>
        <a href="{{ route('admin.superadmin.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Admin
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $admin)
                        <tr>
                            <td>{{ $admin->admin_id }}</td>
                            <td><strong>{{ $admin->username }}</strong></td>
                            <td>{{ $admin->email ?? '-' }}</td>
                            <td>{{ $admin->nama_lengkap ?? '-' }}</td>
                            <td>
                                @if($admin->role === 'super_admin')
                                <span class="badge bg-danger">Super Admin</span>
                                @else
                                <span class="badge bg-primary">Admin</span>
                                @endif
                            </td>
                            <td>{{ $admin->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.superadmin.edit', $admin->admin_id) }}" 
                                       class="btn btn-sm btn-warning text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.superadmin.destroy', $admin->admin_id) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
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
