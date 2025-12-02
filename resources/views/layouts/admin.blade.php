<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* SIDEBAR WRAPPER */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, #f05340, #ff7a5c);
            position: fixed;
            left: 0;
            top: 0;
            padding: 25px 20px;
            color: white;
            transition: all 0.3s ease-in-out;
            overflow: hidden;
        }

        /* COLLAPSED */
        .sidebar.collapsed {
            width: 70px;
            padding: 25px 10px;
        }

        /* SIDEBAR TITLE */
        .sidebar h3 {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 18px;
            letter-spacing: 1px;
            margin-bottom: 45px;
            text-align: center;
            transition: opacity .2s;
        }

        .sidebar.collapsed h3 {
            opacity: 0;
            height: 0;
            margin: 0;
            padding: 0;
        }

        /* SIDEBAR LINKS */
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 12px;
            color: white;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.22);
            transform: translateX(5px);
        }

        /* ICON ONLY WHEN COLLAPSED */
        .sidebar.collapsed a span {
            display: none;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 260px;
            padding: 40px;
            transition: margin-left 0.3s ease-in-out;
        }

        .main-content.collapsed {
            margin-left: 90px;
        }

        /* TOGGLE BUTTON */
        .toggle-btn {
            position: fixed;
            top: 20px;
            left: 260px;
            background: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            border: none;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            transition: left 0.3s ease-in-out;
        }

        .collapsed-toggle {
            left: 80px !important;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h3>UMKM Admin</h3>

        <a href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-gauge"></i> <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.menu.index') }}">
            <i class="fa-solid fa-utensils"></i> <span>Menu</span>
        </a>

        <a href="{{ route('admin.pesanan.index') }}">
            <i class="fa-solid fa-box"></i> <span>Pesanan</span>
        </a>

        <a href="{{ route('admin.logout') }}">
            <i class="fa-solid fa-right-from-bracket"></i> <span>Logout</span>
        </a>
    </div>

    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggleBtn">
        <i class="fa-solid fa-bars"></i>
    </button>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        @yield('content')
    </div>

    <!-- Script -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('toggleBtn');

        toggleBtn.addEventListener("click", function () {
            sidebar.classList.toggle("collapsed");
            main.classList.toggle("collapsed");
            toggleBtn.classList.toggle("collapsed-toggle");
        });
    </script>

</body>

</html>