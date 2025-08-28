@extends('layouts.app-admin')

@section('title','Sastra Tulis')
@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        text: '{{ session('success') }}'
    });
</script>
@endif

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Sastra Tulis</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Sastra Tulis</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
                        <div class="card-header">
                            <a href="{{ route('sastra.create') }}" class="btn btn-primary">
                                Tambah Sastra Tulis
                            </a>
                        </div>
                        
                        <div class="card-body">
                            {{-- Search --}}
                            <input class="form-control"
                                   name="search"
                                   type="search"
                                   placeholder="Cari judul..."
                                   aria-label="Search"
                                   data-width="250">
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Gambar</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                            <th>Isi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $index => $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($item->image && Storage::disk('public')->exists($item->image))
                                                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" width="80">
                                                @else
                                                    <span class="text-muted">Tidak ada</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ ucfirst(strtolower($item->category)) }}</td>
                                            <td>
                                                <span class="badge {{ $item->status === 'PUBLISHED' ? 'badge-success' : ($item->status === 'PENDING' ? 'badge-warning' : 'badge-danger') }}">
                                                    {{ ucfirst(strtolower($item->status)) }}
                                                </span>
                                            </td>
                                            <td>{{ Str::limit(strip_tags($item->body), 50, '...') }}</td>
                                            <td>
                                                @if($item->status === 'PENDING')
                                                <form action="{{ route('sastra.approve', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Publish karya ini?');">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        Publish
                                                    </button>
                                                </form>
                                                @endif
                                                <a href="{{ route('sastra.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                                <form action="{{ route('sastra.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Data Sastra Tulis Kosong</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                {{-- Pagination --}}
                                {{-- <div class="d-flex justify-content-center">
                                    {{ $sastraTulis->links('vendor.pagination.bootstrap-5') }}
                                </div> --}}
                            </div>
                        
                        </div>
                    </div>
                </div>
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

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
