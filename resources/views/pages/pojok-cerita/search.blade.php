@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container my-5">
        <div class="hero row align-items-center">
          <div class="col-lg-12 hero-text text-center">
            <h1 class="display-5 mb-3">Hasil Pencarian</h1>
            <p>Menampilkan hasil pencarian untuk sastra tulis</p>
            <a href="{{ route('pojok-cerita.index') }}" class="btn btn-pink mt-3">Kembali ke Pojok Cerita</a>
          </div>
        </div>
      </div>
</section>

<!-- Search Results Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Hasil Pencarian</h2>
                    <span class="text-muted">{{ $results->total() }} hasil ditemukan</span>
                </div>
                
                @if($results->count() > 0)
                    <div class="row g-4">
                        @foreach($results as $post)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('storage/' . $post->image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $post->title }}"
                                     style="height: 200px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <div class="mb-2">
                                        <span class="badge bg-primary">{{ strtoupper($post->category) }}</span>
                                        <small class="text-muted ms-2">{{ $post->created_at->format('d M Y') }}</small>
                                    </div>
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text text-muted flex-grow-1">
                                        {{ Str::limit(strip_tags($post->body), 100) }}
                                    </p>
                                    <div class="mt-auto">
                                        <small class="text-muted">
                                            <i class="fas fa-eye"></i> {{ number_format($post->views ?? 0) }} kali dibaca
                                        </small>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-0">
                                    <a href="{{ route('pojok-cerita.thumb', $post->id) }}" 
                                       class="btn btn-outline-primary btn-sm w-100">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-5">
                        {{ $results->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">Tidak ada hasil ditemukan</h4>
                        <p class="text-muted">Coba ubah kata kunci pencarian atau filter kategori</p>
                        <a href="{{ route('pojok-cerita.index') }}" class="btn btn-primary">Lihat Semua Cerita</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection 