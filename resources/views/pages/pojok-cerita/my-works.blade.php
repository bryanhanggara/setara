@extends('layouts.app')

@section('title', 'Karya Saya - Pojok Cerita')

@section('content')
<section class="hero-section">
    <div class="container my-5">
        <div class="hero row align-items-center">
          <div class="col-lg-12 hero-text text-center">
            <h1 class="display-5 mb-3">Halo, Penulis Hebat!</h1>
            <p>Kisahmu adalah cerminan kekuatan dan keberanian. <br> Terima kasih sudah berbagi suaramu di sini. 
            Setiap kata yang kamu tulis mungkin menjadi inspirasi bagi banyak orang.</p>
            <a href="{{ route('pojok-cerita.submit.create') }}" class="btn btn-pink mt-3">Buat Karya Baru</a>
          </div>
        </div>
      </div>
</section>
<div class="container main-content">
    <section class="section">

        <div class="section-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="p-3">Daftar Karya Saya</h4>
                        </div>
                        
                        <div class="card-body">
                            @if($myWorks->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Gambar</th>
                                                <th>Judul</th>
                                                <th>Kategori</th>
                                                <th>Status</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Views</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($myWorks as $index => $work)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if($work->image && Storage::disk('public')->exists($work->image))
                                                        <img src="{{ asset('storage/'.$work->image) }}" 
                                                             alt="{{ $work->title }}" 
                                                             class="img-thumbnail" 
                                                             style="width: 60px; height: 60px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                                             style="width: 60px; height: 60px;">
                                                            <i class="fas fa-image"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $work->title }}</strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        {{ Str::limit(strip_tags($work->body), 50, '...') }}
                                                    </small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info text-dark">{{ ucfirst(strtolower($work->category)) }}</span>
                                                </td>
                                                <td>
                                                    @if($work->status === 'PUBLISHED')
                                                        <span class="badge bg-success">Dipublikasi</span>
                                                    @elseif($work->status === 'PENDING')
                                                        <span class="badge bg-warning text-dark">Menunggu Review</span>
                                                    @else
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $work->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <span class="badge badge-secondary">{{ $work->views }}</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                
                                    
                                                        <a href="{{ route('pojok-cerita.my-works.edit', $work->id) }}" 
                                                           class="btn btn-sm btn-info" 
                                                           title="Edit">
                                                            <i class="fas fa-edit text-white"></i>
                                                        </a>
                                                        
                                                        <form action="{{ route('pojok-cerita.my-works.delete', $work->id) }}" 
                                                              method="POST" 
                                                              class="d-inline"
                                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus karya ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    {{ $myWorks->links() }}
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Belum ada karya</h5>
                                    <p class="text-muted">Mulai menulis karya pertama Anda sekarang!</p>
                                    <a href="{{ route('pojok-cerita.submit.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Tulis Karya Pertama
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection 