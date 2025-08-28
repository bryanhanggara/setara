@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container my-5">
        <div class="hero row align-items-center">
          <div class="col-lg-12 hero-text text-center">
            <h1 class="display-5 mb-3">Setiap kisah adalah suara hati <br> yang layak didengar</h1>
            <p>Tempat di mana kisah-kisah singkat perempuan hebat Indonesia dituangkan. <br> Setiap cerita ditulis dalam tiga paragraf yang mencerminkan pengalaman, perasaan, dan harapan.</p>
            <a href="#list" class="btn btn-pink mt-3">Baca Cerita</a>
          </div>
        </div>
      </div>
</section>

<!--Form Section-->
<section id="list" class="py-1">
    <div class="container">
      <ul class="nav nav-tabs border-0 mb-4">
        <li class="nav-item">
          <a class="nav-link fw-bold {{ empty($activeCategory) ? 'active' : '' }}" href="{{ route('pojok-cerita.index') }}">Semua</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($activeCategory ?? '') === 'CERPEN' ? 'active' : '' }}" href="{{ route('pojok-cerita.index', ['category' => 'cerpen']) }}">Cerpen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($activeCategory ?? '') === 'PUISI' ? 'active' : '' }}" href="{{ route('pojok-cerita.index', ['category' => 'puisi']) }}">Puisi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($activeCategory ?? '') === 'KARYA PEGAWAI' ? 'active' : '' }}" href="{{ route('pojok-cerita.index', ['category' => 'karya-pegawai']) }}">Karya Pegawai</a>
        </li>
        <li class="nav-item ms-auto d-flex align-items-center">
          <a class="nav-link text-muted" href="{{ route('pojok-cerita.index') }}">See All</a>
        </li>
        @auth
        <li class="nav-item ms-2">
          <a class="btn btn-primary btn-sm" href="{{ route('pojok-cerita.submit.create') }}">Tulis Karya</a>
        </li>
        <li class="nav-item ms-2">
          <a class="btn btn-outline-secondary btn-sm" href="{{ route('pojok-cerita.my-works') }}">Karya Saya</a>
        </li>
        @endauth
      </ul>
  
      <div class="row g-4">
        @forelse(($posts ?? []) as $post)
          <div class="col-lg-4 col-md-6">
            <div class="article-card">
              <img src="{{ $post->image ? asset('storage/'.$post->image) : 'https://via.placeholder.com/400x200?text=No+Image' }}" 
                   class="card-img-top rounded-4" alt="{{ $post->title }}">
              <div class="card-body px-0">
                <div class="article-meta mb-2">
                  <br>
                  <span class="text-pink fw-bold">{{ $post->category }}</span>
                  <span class="text-muted ms-2">{{ optional($post->created_at)->format('d M Y') }}</span>
                </div>
                <h5 class="fw-bold text-dark">{{ $post->title }}</h5>
                <p class="text-muted small">{!! \Illuminate\Support\Str::limit(strip_tags($post->body), 140) !!}</p>
                <a href="{{ route('pojok-cerita.thumb', $post->id) }}" class="text-pink fw-bold text-decoration-none">Selengkapnya...</a>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <div class="alert alert-light text-center">Belum ada cerita untuk kategori ini.</div>
          </div>
        @endforelse
      </div>

      @if(($posts ?? null) && method_exists($posts, 'hasPages') && $posts->hasPages())
        <div class="mt-4">
          {{ $posts->links() }}
        </div>
      @endif
    </div>
  </section>
  
  <!-- CSS tambahan -->
  <style>
    .dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      display: inline-block;
    }
  </style>
@endsection