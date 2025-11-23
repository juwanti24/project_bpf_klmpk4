<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Ruang Rasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body { 
            background: #f7f7f7;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }
        
        .hero-login {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1920') center/cover;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding: 60px 20px;
        }
        
        .hero-login h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .hero-login p {
            font-size: 1.1rem;
        }
        
        .login-wrapper {
            padding: 40px 20px;
        }
        
        .login-card { 
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 500px;
            margin: -50px auto 0;
            position: relative;
            z-index: 1;
        }
        
        .login-card h4 {
            font-weight: 700;
            color: #222831;
            margin-bottom: 30px;
            text-align: center;
            font-size: 1.75rem;
        }
        
        .login-card .form-label {
            font-weight: 600;
            color: #222831;
            margin-bottom: 8px;
        }
        
        .login-card .form-control {
            border-radius: 10px;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
            font-size: 1rem;
        }
        
        .login-card .form-control:focus {
            border-color: #ffbe33;
            box-shadow: 0 0 0 4px rgba(255, 190, 51, 0.15);
            transform: translateY(-1px);
            outline: none;
        }
        
        .btn-feane {
            background: #ffbe33;
            border: none;
            color: #222831;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            width: 100%;
            text-align: center;
            cursor: pointer;
        }
        
        .btn-feane:hover {
            background: #ffa500;
            color: #222831;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 190, 51, 0.3);
        }
        
        .login-card .btn-outline-secondary {
            border: 2px solid #e0e0e0;
            color: #222831;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .login-card .btn-outline-secondary:hover {
            background: #f7f7f7;
            border-color: #ffbe33;
            color: #222831;
            transform: translateY(-2px);
        }
        
        .login-card .btn-outline-danger {
            border: 2px solid #dc3545;
            color: #dc3545;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .login-card .btn-outline-danger:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
        }
        
        .login-card .alert {
            border-radius: 10px;
            border: none;
        }
        
        @media (max-width: 768px) {
            .hero-login h1 {
                font-size: 2rem;
            }
            .login-card {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    {{-- Hero Section --}}
    <div class="hero-login">
        <div class="container">
            <h1>Admin Login</h1>
            <p>Masuk ke panel administrasi Ruang Rasa</p>
        </div>
    </div>

    <div class="login-wrapper">
        <div class="container">
            <div class="login-card">
                <h4 class="mb-4 text-center">
                    <i class="fas fa-user-shield me-2" style="color: #ffbe33;"></i>Admin Login
                </h4>

                @if(session('error'))
                    <div class="alert alert-danger rounded-3">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger rounded-3">
                        @if($errors->has('google'))
                            {!! $errors->first('google') !!}
                        @else
                            {{ $errors->first() }}
                        @endif
                    </div>
                @endif

                <form action="{{ url()->current() }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-bold" style="color: #222831;">
                            <i class="fas fa-user me-2" style="color: #ffbe33;"></i>Username
                        </label>
                        <input type="text" name="username" class="form-control form-control-lg" 
                               value="{{ old('username') }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold" style="color: #222831;">
                            <i class="fas fa-lock me-2" style="color: #ffbe33;"></i>Password
                        </label>
                        <input type="password" name="password" class="form-control form-control-lg" required>
                    </div>
                    
                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn-feane">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                    </div>
                    
                    <div class="text-center mb-3">
                        <a href="{{ route('pelanggan.daftar') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-user-circle me-2"></i>Login sebagai Pelanggan
                        </a>
                    </div>
                </form>

                <hr class="my-4">

                <div class="text-center">
                    <p class="text-muted mb-2">atau</p>
                    <a href="{{ route('admin.google') }}" class="btn btn-outline-danger w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="display: inline-block; vertical-align: middle; margin-right: 8px;">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        Login dengan Google (Superadmin)
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
