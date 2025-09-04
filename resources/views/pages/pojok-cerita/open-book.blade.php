@extends('layouts.app')

@section('content')
 <!-- Hero Section -->
 <section class="hero-section">
        
 </section>

 <!-- Detail Buku -->
 <section class="container my-5">
     <!-- Judul dan Konten -->
     <div class="mb-4">
       <h2 class="fw-bold text-primary">{{ $post->title }}</h2>
       <p class="text-muted mb-3"><strong>Penulis:</strong> {{ $post->penulis ?? $post->user->name }}</p>
       <div class="text-muted">
        {!! $post->body !!}
    </div>
       <!-- Duplikasi <p> ini untuk menambahkan paragraf lain -->
     </div>
   
     <!-- Pagination -->
     @php
       $current = $currentPage ?? 1;
       $total = $totalPages ?? 1;
       $baseUrl = route('pojok-cerita.open-book', $post->id);
     @endphp
     @if(($wordCount ?? 0) > 500)
     <nav aria-label="Pagination">
         <ul class="pagination justify-content-center mt-4">
           <li class="page-item {{ $current <= 1 ? 'disabled' : '' }}">
             <a class="page-link rounded-circle m-2" href="{{ $current > 1 ? ($baseUrl.'?page='.($current-1)) : '#' }}" tabindex="-1">&lt;</a>
           </li>
           @for($i = 1; $i <= $total; $i++)
             <li class="page-item {{ $i === $current ? 'active' : '' }}">
               <a class="page-link rounded-circle {{ $i === $current ? 'bg-dark text-white border-dark' : 'text-dark' }} m-1" href="{{ $baseUrl.'?page='.$i }}">{{ $i }}</a>
             </li>
           @endfor
           <li class="page-item {{ $current >= $total ? 'disabled' : '' }}">
             <a class="page-link rounded-circle m-2" href="{{ $current < $total ? ($baseUrl.'?page='.($current+1)) : '#' }}">&gt;</a>
           </li>
         </ul>
     </nav>
     @endif
   
     <!-- Komentar -->
     <div class="bg-light p-4 rounded shadow-sm">
       <h5 class="fw-bold mb-3">Komentar</h5>
       @auth
       <form method="POST" action="{{ route('pojok-cerita.comments.store', $post->id) }}" class="d-flex align-items-center mb-3">
         @csrf
         <input type="hidden" name="page" value="{{ $current ?? 1 }}">
         <input name="body" type="text" class="form-control me-2" placeholder="Tulis Komentar Disini..." required minlength="3" maxlength="2000" />
         <button class="btn btn-primary" type="submit">
           <i class="bi bi-send"></i>
         </button>
       </form>
       @else
         <div class="alert alert-warning">Silakan <a href="{{ route('login') }}">login</a> untuk menulis komentar.</div>
       @endauth

       @if(session('success'))
         <div class="alert alert-success">{{ session('success') }}</div>
       @endif
       @error('body')
         <div class="alert alert-danger">{{ $message }}</div>
       @enderror

       @forelse(($comments ?? []) as $comment)
         <div class="bg-white p-3 rounded border mb-2">
           <div class="d-flex justify-content-between align-items-start">
             <div class="flex-grow-1">
               <p class="fw-semibold mb-1">{{ $comment->user->name ?? 'Pengguna' }}</p>
               <p class="mb-2">{{ $comment->body }}</p>
               <div class="text-muted small">@timeAgo($comment->created_at)</div>
             </div>
             @auth
               @if(auth()->id() === $comment->user_id || auth()->user()->role === 'ADMIN')
                 <form action="{{ route('pojok-cerita.comments.delete', ['id' => $post->id, 'commentId' => $comment->id]) }}" 
                       method="POST" 
                       class="ms-2"
                       onsubmit="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">
                   @csrf
                   @method('DELETE')
                   <input type="hidden" name="page" value="{{ $current ?? 1 }}">
                   <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Komentar">
                     <i class="fas fa-trash"></i>
                   </button>
                 </form>
               @endif
             @endauth
           </div>
         </div>
       @empty
         <div class="bg-white p-3 rounded border">Belum ada komentar.</div>
       @endforelse
     </div>
 </section>
        
@endsection