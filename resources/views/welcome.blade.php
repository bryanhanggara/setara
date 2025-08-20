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
                <button class="btn btn-primary mt-3">Read more</button>
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
                    <div class="search-form">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <input type="text" class="form-control" placeholder="Tulis Judul Disini">
                            </div>
                            <div class="col-md-5">
                                <select class="form-select">
                                    <option selected>Genre</option>
                                    <option>Romance</option>
                                    <option>Mystery</option>
                                    <option>Fantasy</option>
                                    <option>Drama</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100">Cari Judul</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Sections -->
    <section class="featured-section py-5">
        <div class="container my-5">
            <div class="row g-4">
              <div class="col-md-6">
                <div class="book-card">
                  <div class="card-overlay">
                    <h5 class="fw-bold">Baru Saja Terbit</h5>
                    <button class="btn btn-primary mt-2">Buka</button>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="book-card">
                  <div class="card-overlay">
                    <h5 class="fw-bold">Terpopuler</h5>
                    <button class="btn btn-primary mt-2">Buka</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </section>

    <!-- Rekomendasi Section -->
    <section class="recommendation-section py-5">
        <div class="container">
            <div class="section-header d-flex justify-content-between align-items-center mb-5">
                <h2 class="section-title">Rekomendasi Jelita</h2>
                <button class="btn btn-primary">View All</button>
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
                                        <span class="text-muted ms-2">{{ $mainArticle->created_at->format('d F Y') }}</span>
                                    </div>
                                    <h3 class="article-title">{{ $mainArticle->title }}</h3>
                                    <p class="article-excerpt">
                                        {{ Str::limit(strip_tags($mainArticle->body), 150, '...') }}
                                    </p>
                                    <a href="{{ route('pojok-cerita.thumb', $mainArticle->id) }}" class="text-primary text-decoration-none">Read More...</a>
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
                              <span class="text-muted ms-2">{{ $article->created_at->format('d F Y') }}</span>
                          </div>
                          <h5 class="fw-bold text-dark">{{ $article->title }}</h5>
                          <p class="text-muted small">{{ Str::limit(strip_tags($article->body), 100, '...') }}</p>
                          <a href="{{ route('spojok-cerita.thumb', $article->id) }}" class="text-pink fw-bold text-decoration-none">Read More...</a>
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
                                        <img src="{{ asset('storage/news/' . $latestNews->first()->image) }}" 
                                             class="img-fluid rounded" alt="{{ $latestNews->first()->title }}"
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
                                            <span class="text-muted ms-2">{{ $latestNews->first()->created_at->format('d M Y') }}</span>
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
                                <img src="{{ asset('storage/news/' . $news->image) }}" 
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
                                    <span class="text-pink fw-bold">Berita</span>
                                    <span class="text-muted ms-2">{{ $news->created_at->format('d M Y') }}</span>
                                </div>
                                <h5 class="fw-bold text-dark">{{ Str::limit($news->title, 60) }}</h5>
                                <p class="text-muted small">{{ Str::limit(strip_tags($news->content), 100) }}</p>
                                <a href="{{ route('news.show', $news->slug) }}" 
                                   class="text-pink fw-bold text-decoration-none">Baca Selengkapnya...</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <!-- No News Available -->
                <div class="row">
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada berita</h4>
                            <p class="text-muted">Berita akan segera hadir di sini</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!--Partner Section-->
    <section class="partner-section py-5 bg-light">
        <div class="container text-center">
          <h2 class="mb-4 fw-bold">Our Partners</h2>
          <div class="row justify-content-center align-items-center g-4">
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
          
          <form class="d-flex justify-content-center flex-wrap gap-2 mb-3">
            <input type="email" class="form-control form-control-lg email-input" placeholder="Your Email">
            <button type="submit" class="btn btn-light btn-lg fw-semibold">Get started</button>
          </form>
      
          <p class="text-white-50">
            Jangan lewatkan cerita terbaru dari SETARA, langsung ke inbox Anda

          </p>
        </div>
      </section>
@endsection