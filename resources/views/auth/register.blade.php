<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Jelita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #000;
            --secondary-color: #D31611;
            --secondary-light: #fce7f3;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --gray-color: #64748b;
            --white-color: #ffffff;
        }

        body {
            font-family: 'Raleway', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            min-height: 100vh;
        }

        .register-left {
            background-image: url('{{ asset("FE_JELITA/assets/img/header.jpeg") }}');
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            padding: 60px 40px;
            min-height: 100vh;
        }

        .register-left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            z-index: 1;
        }

        .register-left-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .register-left h2 {
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .register-left p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .register-right {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .register-header h3 {
            color: var(--dark-color);
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .register-header p {
            color: var(--gray-color);
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            color: var(--dark-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(211, 22, 17, 0.25);
        }

        .btn-register {
            background-color: var(--secondary-color);
            border: none;
            color: white;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-register:hover {
            background-color: #DE9034;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(211, 22, 17, 0.3);
        }

        .divider {
            text-align: center;
            margin: 2rem 0;
            position: relative;
        }

        .divider::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            background: white;
            padding: 0 1rem;
            color: var(--gray-color);
            font-size: 0.9rem;
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .login-link a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            color: #DE9034;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .success-message {
            color: #198754;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        @media (max-width: 768px) {
            .register-left {
                display: none;
            }
            
            .register-right {
                padding: 40px 30px;
            }
            
            .register-container {
                max-width: 100%;
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="row g-0">
            <!-- Left Side - Background Image -->
            <div class="col-lg-6">
                <div class="register-left">
                    <div class="register-left-content">
                        <h2>Bergabung Bersama</h2>
                        <p>Jadilah bagian dari komunitas sastra Jelita</p>
                        <div class="mt-4">
                            <i class="fas fa-users fa-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Register Form -->
            <div class="col-lg-6">
                <div class="register-right">
                    <div class="register-header">
                        <h3>Daftar Akun Baru</h3>
                        <p>Buat akun untuk mulai berbagi karya sastra</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="fas fa-user me-2"></i>Nama Lengkap
                            </label>
                            <input id="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   type="text" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autofocus 
                                   autocomplete="name"
                                   placeholder="Masukkan nama lengkap Anda">
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2"></i>Email
                            </label>
                            <input id="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   type="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autocomplete="username"
                                   placeholder="Masukkan email Anda">
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            <input id="password" 
                                   class="form-control @error('password') is-invalid @enderror"
                                   type="password"
                                   name="password"
                                   required 
                                   autocomplete="new-password"
                                   placeholder="Masukkan password Anda">
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">
                                <i class="fas fa-lock me-2"></i>Konfirmasi Password
                            </label>
                            <input id="password_confirmation" 
                                   class="form-control"
                                   type="password"
                                   name="password_confirmation" 
                                   required 
                                   autocomplete="new-password"
                                   placeholder="Konfirmasi password Anda">
                        </div>

                        <!-- Register Button -->
                        <button type="submit" class="btn btn-register">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </button>

                        <!-- Divider -->
                        <div class="divider">
                            <span>atau</span>
                        </div>

                        <!-- Login Link -->
                        <div class="login-link">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}">Masuk sekarang</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
