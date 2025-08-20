@extends('layouts.app')

@section('content')
<section class="hero-section">
    <div class="container my-5">
        <div class="hero row align-items-center">
          <div class="col-lg-12 hero-text text-center">
            <h1 class="display-5 mb-3">Berita Terkini</h1>
            <p>Dapatkan informasi terbaru seputar dunia sastra dan budaya</p>
            <a href="#list" class="btn btn-pink mt-3">Baca Cerita</a>
          </div>
        </div>
      </div>
</section>

<div class="container">
    <div class="row">
        @forelse($news as $item)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                @if($item->image)
                    <img src="{{ asset('storage/news/' . $item->image) }}" 
                         class="card-img-top" 
                         alt="{{ $item->title }}"
                         style="height: 200px; object-fit: cover;">
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                         style="height: 200px;">
                        <i class="fas fa-newspaper fa-3x text-muted"></i>
                    </div>
                @endif
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <p class="card-text text-muted">
                        {{ Str::limit(strip_tags($item->content), 100) }}
                    </p>
                    <div class="mt-auto">
                        <small class="text-muted">
                            <i class="fas fa-calendar-alt"></i> 
                            {{ $item->created_at->format('d M Y') }}
                        </small>
                    </div>
                </div>
                
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ route('news.show', $item->slug) }}" 
                       class="btn btn-primary btn-block">
                        Baca Selengkapnya
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada berita</h4>
                <p class="text-muted">Berita akan segera hadir di sini</p>
            </div>
        </div>
        @endforelse
    </div>

    @if($news->hasPages())
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $news->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection 