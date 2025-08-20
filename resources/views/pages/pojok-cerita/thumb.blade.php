@extends('layouts.app')

@section('content')
 <!-- Hero Section -->
 <section class="hero-section">
        
 </section>

 <!--Detail Donasi-->
 <section class="container my-5">
     <div class="row align-items-center bg-white shadow rounded-4 p-4 position-relative overflow-hidden">
       <div class="col-md-5">
         <img src="{{ Storage::url($post->image) }}" alt="Kancil" class="img-fluid rounded-3">
       </div>
       <div class="col-md-7 ps-md-5 pt-4 pt-md-0 position-relative z-1">
         <h2 class="fw-bold text-primary mb-3">{{ $post->title }}</h2>
         <div class="text-secondary mb-4">
            {!! Str::limit(strip_tags($post->body), 150, '...') !!}
        </div>
         <div class="mb-3">
           <i class="bi bi-star-fill text-warning fs-5"></i>
           <i class="bi bi-star-fill text-warning fs-5"></i>
           <i class="bi bi-star-fill text-warning fs-5"></i>
           <i class="bi bi-star-fill text-warning fs-5"></i>
           <i class="bi bi-star-half text-warning fs-5"></i>
         </div>
         <a href="{{ route('pojok-cerita.open-book', $post->id) }}" class="btn px-4 py-2 fw-bold text-white rounded-pill" style="background-color:#D31611;">Baca Cerita</a>
       </div>
     </div>
   </section>
   
@endsection