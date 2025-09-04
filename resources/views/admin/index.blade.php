@extends('layouts.app-admin')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            
            <!-- Main Statistics Row -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total User</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalUsers }}
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">+{{ $newUsersThisMonth }} bulan ini</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Cerpen</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCerpen }}
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('sastra.index') }}" class="text-decoration-none">
                                <small>Kelola Sastra <i class="fas fa-arrow-right"></i></small>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Berita</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalBerita }}
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.news.index') }}" class="text-decoration-none">
                                <small>Kelola Berita <i class="fas fa-arrow-right"></i></small>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Newsletter Subscribers</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalPembaca }}
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">+{{ $newSubscribersThisMonth }} bulan ini</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Statistics Row -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Sastra</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalSastra }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Published</h4>
                            </div>
                            <div class="card-body">
                                {{ $publishedSastra }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pending Review</h4>
                            </div>
                            <div class="card-body">
                                {{ $pendingSastra }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-purple">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Views</h4>
                            </div>
                            <div class="card-body">
                                {{ number_format($totalViews) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Breakdown and Recent Activities -->
            <div class="row">
                <!-- Category Breakdown -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Kategori Sastra</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="text-center">
                                        <div class="font-weight-bold text-primary">{{ $cerpenCount }}</div>
                                        <small class="text-muted">Cerpen</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-center">
                                        <div class="font-weight-bold text-success">{{ $puisiCount }}</div>
                                        <small class="text-muted">Puisi</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-center">
                                        <div class="font-weight-bold text-warning">{{ $karyaPegawaiCount }}</div>
                                        <small class="text-muted">Karya Pegawai</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Aktivitas Bulan Ini</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-center">
                                        <div class="font-weight-bold text-primary">{{ $newSastraThisMonth }}</div>
                                        <small class="text-muted">Sastra Baru</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <div class="font-weight-bold text-success">{{ $newNewsThisMonth }}</div>
                                        <small class="text-muted">Berita Baru</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Most Viewed Articles and Recent Comments -->
            <div class="row">
                <!-- Most Viewed Articles -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Artikel Terpopuler</h4>
                        </div>
                        <div class="card-body">
                            @forelse($mostViewedArticles as $article)
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <div class="bg-light rounded p-2 text-center" style="width: 40px; height: 40px;">
                                        <small class="font-weight-bold">{{ $loop->iteration }}</small>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ml-3">
                                    <h6 class="mb-0">{{ Str::limit($article->title, 40) }}</h6>
                                    <small class="text-muted">{{ number_format($article->views) }} views</small>
                                </div>
                            </div>
                            @empty
                            <p class="text-muted text-center">Belum ada artikel</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Comments -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Komentar Terbaru</h4>
                        </div>
                        <div class="card-body">
                            @forelse($recentComments as $comment)
                            <div class="d-flex align-items-start mb-3">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary rounded-circle p-2 text-white text-center" style="width: 35px; height: 35px;">
                                        <small>{{ substr($comment->user->name, 0, 1) }}</small>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ml-3">
                                    <h6 class="mb-0">{{ $comment->user->name }}</h6>
                                    <small class="text-muted">{{ Str::limit($comment->body, 50) }}</small>
                                    <br>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            @empty
                            <p class="text-muted text-center">Belum ada komentar</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush