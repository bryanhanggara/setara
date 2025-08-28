@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Kirim Karya Sastra</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pojok-cerita.submit.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input type="file" name="image" id="image" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="CERPEN" {{ old('category')==='CERPEN' ? 'selected' : '' }}>Cerpen</option>
                        <option value="PUISI" {{ old('category')==='PUISI' ? 'selected' : '' }}>Puisi</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Isi</label>
                    <textarea name="body" id="body" class="tinymce" rows="10">{{ old('body') }}</textarea>
                </div>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <strong>Catatan:</strong> Karya yang Anda kirim akan direview oleh admin terlebih dahulu sebelum dipublikasikan.
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.0/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
      selector: 'textarea',
      entity_encoding: 'raw',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
      
    });
  </script>
@endsection
