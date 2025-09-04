@extends('layouts.app-admin')

@section('title', 'Edit Sastra Tulis')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Sastra Tulis</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('sastra.index') }}">Sastra Tulis</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Edit Data Sastra Tulis</h2>

            <div class="card">
                <form action="{{ route('sastra.update', $sastraTuli->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                         {{-- Title --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $sastraTuli->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Penulis --}}
                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" name="penulis" id="penulis" class="form-control @error('penulis') is-invalid @enderror" value="{{ old('penulis', $sastraTuli->penulis) }}" required>
                            @error('penulis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Image --}}
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            @if($sastraTuli->image && Storage::disk('public')->exists($sastraTuli->image))
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'.$sastraTuli->image) }}" alt="{{ $sastraTuli->title }}" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                    <p class="text-muted">Gambar saat ini</p>
                                </div>
                            @endif
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar. Format: JPEG, PNG, JPG. Maksimal 2MB.</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="CERPEN" {{ old('category', $sastraTuli->category) === 'CERPEN' ? 'selected' : '' }}>Cerpen</option>
                                <option value="PUISI" {{ old('category', $sastraTuli->category) === 'PUISI' ? 'selected' : '' }}>Puisi</option>
                                <option value="KARYA PEGAWAI" {{ old('category', $sastraTuli->category) === 'KARYA PEGAWAI' ? 'selected' : '' }}>Karya Pegawai</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="PENDING" {{ old('status', $sastraTuli->status) === 'PENDING' ? 'selected' : '' }}>Pending</option>
                                <option value="PUBLISHED" {{ old('status', $sastraTuli->status) === 'PUBLISHED' ? 'selected' : '' }}>Published</option>
                                <option value="REJECTED" {{ old('status', $sastraTuli->status) === 'REJECTED' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Body --}}
                        <div class="form-group">
                            <label>Deskripsi/Konten</label>
                            <textarea name="body" id="body" class="tinymce" rows="10">{{ old('body', $sastraTuli->body) }}</textarea>
                            @error('body')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="card-footer text-right">
                        <a href="{{ route('sastra.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.0/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
          selector: 'textarea',
          entity_encoding: 'raw',
          plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
          toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
          
        });
      </script>
@endpush
