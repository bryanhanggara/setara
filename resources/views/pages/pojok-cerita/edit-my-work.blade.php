@extends('layouts.app')

@section('title', 'Edit Karya - Pojok Cerita')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Edit Karya Sastra</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pojok-cerita.my-works.update', $sastraTuli->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           class="form-control @error('title') is-invalid @enderror" 
                           value="{{ old('title', $sastraTuli->title) }}" 
                           required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Gambar --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    @if($sastraTuli->image && Storage::disk('public')->exists($sastraTuli->image))
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$sastraTuli->image) }}" 
                                 alt="{{ $sastraTuli->title }}" 
                                 class="img-thumbnail" 
                                 style="max-width: 200px; max-height: 200px;">
                            <p class="text-muted">Gambar saat ini</p>
                        </div>
                    @endif
                    <input type="file" 
                           name="image" 
                           id="image" 
                           class="form-control @error('image') is-invalid @enderror" 
                           accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kategori --}}
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

                {{-- Konten --}}
                <div class="mb-3">
                    <label for="body" class="form-label">Isi</label>
                    <textarea name="body" id="body" class="tinymce form-control @error('body') is-invalid @enderror" rows="10" required>{{ old('body', strip_tags($sastraTuli->body)) }}</textarea>
                    @error('body')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Info --}}
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <strong>Catatan:</strong> Setelah mengedit karya, status akan kembali menjadi <strong>Menunggu Review</strong>.
                </div>

                {{-- Tombol --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('pojok-cerita.my-works') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- TinyMCE --}}
<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.0/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        entity_encoding: 'raw',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 400
    });
</script>
@endsection
