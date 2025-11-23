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
            background: #ffbe33;
            position: fixed;
            left: 0;
            top: 0;
            padding: 25px 20px;
            color: #222831;
            transition: all 0.3s ease-in-out;
            overflow: hidden;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            z-index: 1000;
        }

        /* COLLAPSED */
        .sidebar.collapsed {
            width: 70px;
            padding: 25px 10px;
        }

        /* SIDEBAR LOGO */
        .sidebar-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 45px;
            transition: opacity .2s;
        }

        .sidebar-logo img {
            width: 120px;
            height: auto;
            margin-bottom: 10px;
        }

        .sidebar.collapsed .sidebar-logo {
            opacity: 0;
            height: 0;
            margin: 0;
            padding: 0;
        }

        .sidebar.collapsed .sidebar-logo img {
            display: none;
        }

        /* SIDEBAR LINKS */
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 10px;
            color: #222831;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            white-space: nowrap;
            position: relative;
        }

        .sidebar a:hover {
            background-color: rgba(34, 40, 49, 0.1);
            color: #222831;
            transform: translateX(5px);
        }
        
        .sidebar a.active {
            background-color: #222831;
            color: #ffbe33;
        }

        .sidebar a i {
            font-size: 18px;
            min-width: 20px;
            text-align: center;
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
            min-height: 100vh;
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
            width: 45px;
            height: 45px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
            z-index: 1001;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--theme-primary);
        }

        .toggle-btn:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, var(--theme-primary), var(--theme-secondary));
            color: white;
        }

        .collapsed-toggle {
            left: 80px !important;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #4facfe 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(255, 190, 51, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 190, 51, 0.12) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(34, 40, 49, 0.08) 0%, transparent 50%),
                repeating-linear-gradient(
                    45deg,
                    transparent,
                    transparent 35px,
                    rgba(255, 255, 255, 0.03) 35px,
                    rgba(255, 255, 255, 0.03) 70px
                );
            background-size: 100% 100%, 100% 100%, 100% 100%, 70px 70px;
            z-index: 0;
            pointer-events: none;
        }
        
        body::after {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: 
                radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: float 20s ease-in-out infinite;
            z-index: 0;
            pointer-events: none;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }
        
        .main-content {
            position: relative;
            z-index: 1;
        }
        
        .card, .alert {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37) !important;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('images/logo-ruang-rasa-text.svg') }}" alt="Ruang Rasa Logo">
        </div>

        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge"></i> <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.menu.index') }}" class="{{ request()->routeIs('admin.menu.*') ? 'active' : '' }}">
            <i class="fa-solid fa-utensils"></i> <span>Menu</span>
        </a>

        <a href="{{ route('admin.pesanan.index') }}" class="{{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
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