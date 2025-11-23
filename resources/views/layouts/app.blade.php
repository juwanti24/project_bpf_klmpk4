<!doctype html>
<html lang="id">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ruang Rasa - @yield('title', 'Café & Restoran')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                
                body {
                    font-family: 'Poppins', sans-serif;
                    padding-top: 0;
                    background: #f7f7f7;
                    min-height: 100vh;
                }
                
                /* Navbar Feane Style */
                .navbar-feane {
                    background: #ffbe33;
                    padding: 15px 0;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                }
                
                .navbar-feane .navbar-brand {
                    font-size: 28px;
                    font-weight: 700;
                    color: #222831 !important;
                    text-decoration: none;
                    display: flex;
                    align-items: center;
                }
                
                .navbar-feane .navbar-brand img {
                    height: 55px;
                    width: auto;
                    transition: transform 0.3s ease;
                }
                
                .navbar-feane .navbar-brand:hover img {
                    transform: scale(1.05);
                }
                
                .navbar-feane .nav-link {
                    color: #222831 !important;
                    font-weight: 500;
                    margin: 0 10px;
                    transition: color 0.3s;
                }
                
                .navbar-feane .nav-link:hover {
                    color: #fff !important;
                }
                
                /* Hero Section */
                .hero-section {
                    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1920') center/cover;
                    min-height: 500px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    text-align: center;
                    color: white;
                    padding: 100px 20px;
                }
                
                .hero-section h1 {
                    font-size: 3.5rem;
                    font-weight: 700;
                    margin-bottom: 20px;
                }
                
                .hero-section p {
                    font-size: 1.2rem;
                    margin-bottom: 30px;
                    max-width: 700px;
                    margin-left: auto;
                    margin-right: auto;
                }
                
                /* Menu Cards Feane Style */
                .menu-card-feane {
                    background: white;
                    border-radius: 15px;
                    overflow: hidden;
                    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                    transition: all 0.3s ease;
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                }
                
                .menu-card-feane:hover {
                    transform: translateY(-10px);
                    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
                }
                
                .menu-card-feane img {
                    width: 100%;
                    height: 250px;
                    object-fit: cover;
                }
                
                .menu-card-feane .card-body {
                    padding: 25px;
                    flex-grow: 1;
                    display: flex;
                    flex-direction: column;
                }
                
                .menu-card-feane h5 {
                    font-size: 1.5rem;
                    font-weight: 600;
                    color: #222831;
                    margin-bottom: 10px;
                }
                
                .menu-card-feane .menu-category {
                    color: #ffbe33;
                    font-weight: 500;
                    font-size: 0.9rem;
                    margin-bottom: 10px;
                }
                
                .menu-card-feane p {
                    color: #666;
                    flex-grow: 1;
                    margin-bottom: 15px;
                }
                
                .menu-card-feane .price {
                    font-size: 1.5rem;
                    font-weight: 700;
                    color: #ffbe33;
                    margin-bottom: 15px;
                }
                
                /* Button Feane Style */
                .btn-feane {
                    background: #ffbe33;
                    color: #222831;
                    border: none;
                    padding: 12px 30px;
                    border-radius: 5px;
                    font-weight: 600;
                    transition: all 0.3s;
                    text-decoration: none;
                    display: inline-block;
                }
                
                .btn-feane:hover {
                    background: #ffa500;
                    color: #222831;
                    transform: translateY(-2px);
                    box-shadow: 0 5px 15px rgba(255,190,51,0.3);
                }
                
                /* Filter Tabs */
                .filter-tabs {
                    display: flex;
                    justify-content: center;
                    gap: 15px;
                    margin: 40px 0;
                    flex-wrap: wrap;
                }
                
                .filter-tab {
                    background: white;
                    border: 2px solid #ffbe33;
                    color: #222831;
                    padding: 10px 25px;
                    border-radius: 25px;
                    cursor: pointer;
                    transition: all 0.3s;
                    text-decoration: none;
                    font-weight: 500;
                }
                
                .filter-tab:hover,
                .filter-tab.active {
                    background: #ffbe33;
                    color: white;
                }
                
                /* Section Title */
                .section-title {
                    text-align: center;
                    margin: 60px 0 40px;
                }
                
                .section-title h2 {
                    font-size: 2.5rem;
                    font-weight: 700;
                    color: #222831;
                    margin-bottom: 10px;
                }
                
                /* Footer Feane Style */
                .footer-feane {
                    background: #222831;
                    color: white;
                    padding: 60px 0 20px;
                    margin-top: 80px;
                }
                
                .footer-feane h4 {
                    color: #ffbe33;
                    margin-bottom: 20px;
                    font-weight: 600;
                }
                
                .footer-feane a {
                    color: #fff;
                    text-decoration: none;
                    transition: color 0.3s;
                }
                
                .footer-feane a:hover {
                    color: #ffbe33;
                }
                
                .footer-feane .footer-bottom {
                    border-top: 1px solid #444;
                    padding-top: 20px;
                    margin-top: 40px;
                    text-align: center;
                }
                
                @media (max-width: 768px) {
                    .hero-section h1 {
                        font-size: 2rem;
                    }
                    .hero-section p {
                        font-size: 1rem;
                    }
                }
        </style>
        @stack('styles')
</head>
<body>
        @if(session('customer'))
        <nav class="navbar navbar-expand-lg navbar-feane">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('pelanggan.menu') }}" style="text-decoration: none;">
                    <img src="{{ asset('images/logo-ruang-rasa-text.svg') }}" alt="Ruang Rasa" height="50" class="me-2">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pelanggan.menu') }}">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pelanggan.menu') }}#menu">
                                <i class="fas fa-utensils me-1"></i>Menu
                            </a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">Hi, <strong>{{ session('customer.nama') }}</strong></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pelanggan.logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @endif

        <main>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
        </main>

        <footer class="footer-feane">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <img src="{{ asset('images/logo-ruang-rasa-text.svg') }}" alt="Ruang Rasa" height="60" class="mb-3">
                        <p>Ruang Rasa - Tempat terbaik untuk menikmati makanan dan minuman berkualitas dengan suasana yang nyaman.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h4>Contact Us</h4>
                        <p><i class="fas fa-map-marker-alt me-2"></i> Rumbai</p>
                        <p><i class="fas fa-phone me-2"></i> Call +6285259056330</p>
                        <p><i class="fas fa-envelope me-2"></i> RuangRasa@gmail.com</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h4>Opening Hours</h4>
                        <p>Everyday</p>
                        <p>10.00 Am - 10.00 Pm</p>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
</body>
</html>
