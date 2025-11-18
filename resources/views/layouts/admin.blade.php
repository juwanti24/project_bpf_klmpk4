<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f7f7f7;
            margin: 0;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            background: linear-gradient(180deg, #f05340, #ff7a5c);
            position: fixed;
            top: 0;
            left: 0;
            padding: 30px 15px;
            color: white;
        }

        .sidebar h3 {
            text-align: center;
            margin-bottom: 40px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .main-content {
            margin-left: 260px;
            padding: 40px 30px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h3>UMKM Admin</h3>
        <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
        @if(session('admin_role') === 'super_admin')
        <a href="{{ route('admin.menu.index') }}"><i class="fa-solid fa-utensils"></i> Menu</a>
        <a href="{{ route('admin.stok.index') }}"><i class="fa-solid fa-boxes"></i> Manajemen Stok</a>
        <a href="{{ route('admin.laporan.index') }}"><i class="fa-solid fa-chart-line"></i> Laporan Penjualan</a>
        <a href="{{ route('admin.superadmin.index') }}"><i class="fa-solid fa-users-cog"></i> Kelola Admin</a>
        @endif
        <a href="{{ route('admin.pesanan.index') }}"><i class="fa-solid fa-box"></i> Pesanan</a>
        <a href="{{ route('admin.logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>

</html>
