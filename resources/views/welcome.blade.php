@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container my-5">
            <div class="hero row align-items-center">
              <div class="col-lg-6 hero-text">
                <p class="text-uppercase fw-bold text-pink" style="color:#fff">Selamat Datang</p>
                <h1 class="display-5 mb-3">Sembuh dan Tumbuh Bersama Sastra</h1>
                <p>Media Literasi untuk Pemberdayaan dan Kesehatan Mental Warga Binaan Perempuan</p>
                <button class="btn btn-primary mt-3">Selengkapnya</button>
              </div>
              <div class="col-lg-6 hero-image mt-4 mt-lg-0 text-center">
                <img src="{{ asset('FE_JELITA/assets/img/book.png') }}" alt=" Art"> <!-- Ganti your-image.jpg dengan path gambar kamu -->
              </div>
            </div>
          </div>
    </section>

    <!-- Search Section -->
    <section class="search-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form action="{{ route('pojok-cerita.search') }}" method="GET" class="search-form">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <input type="text" name="title" class="form-control" placeholder="Tulis Judul Disini" value="{{ request('title') }}">
                            </div>
                            <div class="col-md-5">
                                <select name="category" class="form-select">
                                    <option value="">Semua Kategori</option>
                                    <option value="CERPEN" {{ request('category') == 'CERPEN' ? 'selected' : '' }}>Pentigraf</option>
                                    
                                    
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Cari Judul</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Sections -->
    <section class="featured-section py-5">
        <div class="container my-5">
            <div class="row g-4">
              <div class="col-md-6">
                <div class="book-card p-4 rounded-4 bg-light">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Baru Saja Terbit</h5>
                  </div>
                  <ul class="list-unstyled mb-0">
                    @foreach(($recentArticles ?? []) as $item)
                      <li class="mb-3 d-flex align-items-start">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="rounded me-3" style="width:60px;height:60px;object-fit:cover;">
                        <div>
                          <a href="{{ route('pojok-cerita.thumb', $item->id) }}" class="fw-semibold text-white text-decoration-none">{{ $item->title }}</a>
                                                          <div class="small text-white">@indonesianDateShort($item->created_at)</div>
                        </div>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="col-md-6">
                <div class="book-card p-4 rounded-4 bg-light">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Paling Banyak Dilihat</h5>
                  </div>
                  <ul class="list-unstyled mb-0">
                    @foreach(($popularArticles ?? []) as $item)
                      <li class="mb-3 d-flex align-items-start">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="rounded me-3" style="width:60px;height:60px;object-fit:cover;">
                        <div>
                          <a href="{{ route('pojok-cerita.thumb', $item->id) }}" class="fw-semibold text-white text-decoration-none">{{ $item->title }}</a>
                          <div class="small text-white">{{ number_format((int)($item->views ?? 0)) }} kali dibaca</div>
                        </div>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
    </section>

    <!-- Rekomendasi Section -->
    <section class="recommendation-section py-5">
        <div class="container">
            <div class="section-header d-flex justify-content-between align-items-center mb-5">
                <h2 class="section-title">Rekomendasi Setara</h2>
                <button class="btn btn-primary">Lihat Semua</button>
            </div>
            
            <!-- Main Article -->
            @if($mainArticle)
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="main-article">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $mainArticle->image) }}" 
                                    class="img-fluid rounded" 
                                    alt="{{ $mainArticle->title }}">
                            </div>
                            <div class="col-md-8">
                                <div class="article-content">
                                    <div class="article-meta">
                                        <span class="badge bg-secondary">{{ strtoupper($mainArticle->category) }}</span>
                                        <span class="text-muted ms-2">@indonesianDate($mainArticle->created_at)</span>
                                        <span class="text-muted ms-2">{{ number_format((int)($mainArticle->views ?? 0)) }} kali dibaca</span>
                                    </div>
                                    <h3 class="article-title">{{ $mainArticle->title }}</h3>
                                    <p class="article-excerpt">
                                        {{ Str::limit(strip_tags($mainArticle->body), 150, '...') }}
                                    </p>
                                    <a href="{{ route('pojok-cerita.thumb', $mainArticle->id) }}" class="text-primary text-decoration-none">Selengkapnya...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            

            <!-- Small Articles -->
            <div class="row g-4">
              @foreach($smallArticles as $article)
              <div class="col-lg-4 col-md-6">
                  <div class="article-card">
                      <img src="{{ asset('storage/' . $article->image) }}" 
                           class="card-img-top rounded-4" 
                           alt="{{ $article->title }}">
                      <div class="card-body px-0">
                          <div class="article-meta mb-2">
                              <br>
                              <span class="text-pink fw-bold">{{ ucfirst(strtolower($article->category)) }}</span>
                                                                  <span class="text-muted ms-2">@indonesianDateShort($article->created_at)</span>
                              <span class="text-muted ms-2">{{ number_format((int)($article->views ?? 0)) }} kali dibaca</span>
                          </div>
                          <h5 class="fw-bold text-dark">{{ $article->title }}</h5>
                          <p class="text-muted small">{{ Str::limit(strip_tags($article->body), 100, '...') }}</p>
                          <a href="{{ route('pojok-cerita.thumb', $article->id) }}" class="text-pink fw-bold text-decoration-none">Selengkapnya...</a>
                      </div>
                  </div>
              </div>
              @endforeach
          </div>
  
        </div>
    </section>

    <!-- News Section -->
    <section class="news-section py-5 bg-light">
        <div class="container">
            <div class="section-header d-flex justify-content-between align-items-center mb-5">
                <h2 class="section-title">Berita Terkini</h2>
                <a href="{{ route('news.index') }}" class="btn btn-primary">Lihat Semua</a>
            </div>
            
            @if($latestNews->count() > 0)
                <!-- Main News Article -->
                @if($latestNews->first())
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <div class="main-article">
                            <div class="row">
                                <div class="col-md-4">
                                  @if($latestNews->first()->image)
                                  <img src="{{ Storage::url($latestNews->first()->image) }}" 
                                       class="img-fluid rounded" 
                                       alt="{{ $latestNews->first()->title }}"
                                       style="height: 300px; object-fit: cover;">
                              @else
                                  <div class="bg-secondary d-flex align-items-center justify-content-center rounded" 
                                       style="height: 300px;">
                                      <i class="fas fa-newspaper fa-3x text-white"></i>
                                  </div>
                              @endif
                              
                                </div>
                                <div class="col-md-8">
                                    <div class="article-content">
                                        <div class="article-meta">
                                            <span class="badge bg-primary">Berita</span>
                                            <span class="text-muted ms-2">@indonesianDate($latestNews->first()->created_at)</span>
                                        </div>
                                        <h3 class="article-title">{{ $latestNews->first()->title }}</h3>
                                        <p class="article-excerpt">
                                            {{ Str::limit(strip_tags($latestNews->first()->content), 200) }}
                                        </p>
                                        <a href="{{ route('news.show', $latestNews->first()->slug) }}" 
                                           class="text-primary text-decoration-none">Baca Selengkapnya...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- News Articles Grid -->
                <div class="row g-4">
                    @foreach($latestNews->skip(1) as $news)
                    <div class="col-lg-4 col-md-6">
                        <div class="article-card">
                            @if($news->image)
                                <img src="{{ Storage::url($news->image) }}" 
                                     class="card-img-top rounded-4" alt="{{ $news->title }}"
                                     style="height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-secondary d-flex align-items-center justify-content-center rounded-4" 
                                     style="height: 200px;">
                                    <i class="fas fa-newspaper fa-2x text-white"></i>
                                </div>
                            @endif
                            <div class="card-body px-0">
                                <div class="article-meta mb-2">
                                    <span class="badge bg-primary">Berita</span>
                                    <span class="text-muted ms-2">@indonesianDateShort($news->created_at)</span>
                                </div>
                                <h5 class="fw-bold text-dark">{{ $news->title }}</h5>
                                <p class="text-muted small">{{ Str::limit(strip_tags($news->content), 120) }}</p>
                                <a href="{{ route('news.show', $news->slug) }}" class="text-primary fw-bold text-decoration-none">Baca Selengkapnya...</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">Belum ada berita.</p>
            @endif

        </div>
    </section>

    <!--Partner Section-->
    <section class="partner-section py-5 bg-light">
        <div class="container text-center">
          <h2 class="mb-4 fw-bold">Dipersembahkan Oleh</h2>
          <div class="row justify-content-center align-items-center g-4">
            <div class="col-6 col-md-3 col-lg-2">
              <img src="{{ asset('FE_JELITA/assets/img/tutwuri.png') }}" class="img-fluid partner-logo" alt="Partner 1">
            </div>
            <div class="col-6 col-md-3 col-lg-2">
              <img src="{{ asset('FE_JELITA/assets/img/bbpss.png') }}" class="img-fluid partner-logo" alt="Partner 1">
            </div>
            <div class="col-6 col-md-3 col-lg-2">
              <img src="{{ asset('FE_JELITA/assets/img/dubas.png') }}" class="img-fluid partner-logo" alt="Partner 2">
            </div>
            
           
          </div>
        </div>
      </section>
      
    <!-- Newsletter Section -->
    <section class="newsletter-section py-5">
        <div class="container text-center">
          <h2 class="text-white fw-bold display-5 mb-4">
            Setiap kisah adalah perjalanan jiwa
          </h2>
          
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif
          
          @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif
          
          <form action="{{ route('newsletter.subscribe') }}" method="POST" class="d-flex justify-content-center flex-wrap gap-2 mb-3">
            @csrf
            <input type="email" name="email" class="form-control form-control-lg email-input" placeholder="Pos el" required>
            <button type="submit" class="btn btn-light btn-lg fw-semibold">Berlangganan</button>
          </form>
      
          <p class="text-white-50">
            Jangan lewatkan cerita terbaru dari SETARA, langsung ke inbox Anda

          </p>
        </div>
      </section>
@endsection