<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Café - @yield('title', 'Selamat Datang')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
                body{padding-top:70px}
                .menu-card{transition: transform .12s}
                .menu-card:hover{transform: translateY(-6px)}
        </style>
        @stack('styles')
</head>
<body>
        @if(session('customer'))
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">Café</a>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item me-3"><span class="nav-link">Hi, <strong>{{ session('customer.nama') }}</strong></span></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('pelanggan.logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        @endif

        <main class="container">
                @if(session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif
                @yield('content')
        </main>

        <footer class="text-center py-4 mt-5">
            <div class="container">
                <small>&copy; {{ date('Y') }} Café — Fresh & Friendly</small>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
</body>
</html>
