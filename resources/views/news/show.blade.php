@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <!-- Main Content -->
            <article class="mb-5">
                <header class="mb-4">
                    <h1 class="display-4 font-weight-bold text-primary mb-3">{{ $news->title }}</h1>
                    <div class="d-flex align-items-center text-muted mb-3">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span>{{ $news->created_at->format('d M Y, H:i') }}</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-user mr-2"></i>
                        <span>Admin</span>
                    </div>
                </header>

                @if($news->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/news/' . $news->image) }}" 
                         class="img-fluid rounded shadow" 
                         alt="{{ $news->title }}">
                </div>
                @endif

                <div class="content">
                    {!! nl2br(e($news->content)) !!}
                </div>
            </article>

            <!-- Share Buttons -->
            <div class="mb-5">
                <h5 class="mb-3">Bagikan Berita:</h5>
                <div class="d-flex gap-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                       target="_blank" 
                       class="btn btn-outline-primary">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" 
                       target="_blank" 
                       class="btn btn-outline-info">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . request()->url()) }}" 
                       target="_blank" 
                       class="btn btn-outline-success">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Sidebar -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Berita Terbaru</h5>
                </div>
                <div class="card-body">
                    @forelse($latestNews as $item)
                    <div class="media mb-3">
                        @if($item->image)
                            <img src="{{ asset('storage/news/' . $item->image) }}" 
                                 class="mr-3 rounded" 
                                 alt="{{ $item->title }}"
                                 style="width: 64px; height: 64px; object-fit: cover;">
                        @else
                            <div class="mr-3 bg-light rounded d-flex align-items-center justify-content-center" 
                                 style="width: 64px; height: 64px;">
                                <i class="fas fa-newspaper text-muted"></i>
                            </div>
                        @endif
                        
                        <div class="media-body">
                            <h6 class="mt-0">
                                <a href="{{ route('news.show', $item->slug) }}" 
                                   class="text-decoration-none">
                                    {{ Str::limit($item->title, 50) }}
                                </a>
                            </h6>
                            <small class="text-muted">
                                {{ $item->created_at->format('d M Y') }}
                            </small>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted">Belum ada berita lain</p>
                    @endforelse
                </div>
            </div>

            <!-- Back to News List -->
            <div class="mt-3">
                <a href="{{ route('news.index') }}" class="btn btn-outline-primary btn-block">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Daftar Berita
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 