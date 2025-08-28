<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setara - </title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('FE_JELITA/styles.css') }}">
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <div class="logo">
                    <img src="{{ url('FE_JELITA/assets/img/logo.png') }}" alt="Jelita Logo" width="50">
                    <span class="fw-bold text-primary">Setara</span>
                </div>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ url('/tentang-jelita') }}">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('news.index') }}">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ url('/pojok-cerita') }}">Pojok Cerita</a>
                    </li>
                   
                  
                </ul>
                
                <div class="d-flex align-items-center">
                    <button class="btn btn-link text-primary me-3">
                        <i class="fas fa-search"></i>
                    </button>
                    @guest
                    <a  href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
                    @endguest
                    @auth
                    <a  href="{{ route('logout') }}" class="btn btn-primary">Keluar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @yield('content')
 
    <!-- Footer -->
    <footer class="footer-section text-center py-5">
        <div class="container">
          <img src="{{ url('FE_JELITA/assets/img/logo.png') }}" alt="Jelita Logo" width="100" class="mb-2"> <!-- Ganti sesuai logo kamu -->
          <h4 class="fw-bold mb-4">Setara</h4>
      
          <ul class="nav justify-content-center mb-4">
            <li class="nav-item"><a href="#" class="nav-link px-3 text-dark">Beranda</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-3 text-dark">Pojok Cerita</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-3 text-dark">Tentang</a></li>
          </ul>
      
          <div class="social-icons d-flex justify-content-center gap-3 mb-4">
            <a href="#" class="circle-icon"><i class="bi bi-instagram"></i></a>
            <a href="#" class="circle-icon"><i class="bi bi-youtube"></i></a>
          </div>
      
          <hr style="border-color: #f47ce0; width: 90%; margin: 0 auto;">
      
          <p class="mt-3 text-dark">
            Hak Cipta SETARA Duta Bahasa Sumatra Selatan 2025. Semua Hak Dilindungi Undang-Undang
          </p>
        </div>
      </footer>
      

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <!-- <script src="script.js"></script> -->
</body>
</html> 