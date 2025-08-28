@extends('layouts.app')

@section('content')
<div class="container"><!-- Hero Section -->
    <section class="hero-section">
        <div class="container my-5">
            <div class="hero row align-items-center">
              <div class="col-lg-12 hero-text text-center">
                <h1 class="display-5 mb-3">Berkenalan Dengan Kami                </h1>
                <p>Dari Duta Bahasa dan Balai Bahasa Provinsi Sumatra Selatan, untuk harapan di balik jeruji
                </p>
                <a href="#view" class="btn btn-pink mt-3">Lihat Selengkapnya</a>
              </div>
            </div>
          </div>
    </section>

    <!--Detail Donasi-->
    <section class="text-dark py-5" id="view">
        <div class="container">
          <div class="mb-5">
            <h6 class="text-uppercase text-secondary fw-bold">SETARA</h6>
            <h2 class="fw-bold display-5">Sembuh dan Tumbuh Bersama Sastra</h2>
            <p class="text-muted mt-3">
              Sebuah inisiatif literasi yang digagas oleh Duta Bahasa Sumatra Selatan bersama Balai Bahasa Provinsi Sumatra Selatan.
            </p>
          </div>
      
          <div class="row g-4">
            <!-- Step 1 -->
            <div class="col-md-6">
              <div class="text-white rounded-4 p-4 h-100" style="background-color: #D31611;">
                <div class="fs-1 fw-bold">01</div>
                <h4 class="fw-semibold mt-3">Tujuannya sederhana namun bermakna</h4>
                <p class="small mt-2">
                  menghadirkan sastra sebagai media penyembuhan hati dan pikiran bagi warga binaan perempuan di Lapas Perempuan Kelas II A Palembang.
                </p>
  
              </div>
            </div>
      
            <!-- Step 2 -->
            <div class="col-md-6">
              <div class="rounded-4 p-4 h-100 border border-secondary">
                <div class="fs-1 fw-bold text-secondary">02</div>
                <h4 class="fw-semibold mt-3 text-pink" style="color: #D31611;">Di balik jeruji</h4>
                <p class="small mt-2 text-muted">
                  mereka tetap manusia yang merindukan kesempatan untuk kembali. Melalui tulisan, mereka belajar menerima, memaafkan diri, dan menumbuhkan harapan. SETARA hadir untuk mempublikasikan karya-karya ini agar dunia tahu bahwa penjara bukan akhir dari segalanya, melainkan ruang refleksi untuk tumbuh lebih baik.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      
    <!-- Inisiator SETARA -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-uppercase text-secondary fw-bold">Inisiator</h6>
                <h2 class="fw-bold display-6">Inisiator SETARA</h2>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="rounded-top" style="position: relative; width: 100%; padding-top: 75%; overflow: hidden;">
                            <img src="{{ asset('FE_JELITA/assets/img/doni.JPG') }}" alt="Rahmadoni Saputra" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="mb-1">Rahmadoni Saputra</h5>
                            <p class="text-muted small mb-0">Terbaik I Putra Duta Bahasa Sumatra Selatan 2025</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-5">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="rounded-top" style="position: relative; width: 100%; padding-top: 75%; overflow: hidden;">
                            <img src="{{ asset('FE_JELITA/assets/img/shopi.JPG') }}" alt="Shopi Attika Putri" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="mb-1">Shopi Attika Putri</h5>
                            <p class="text-muted small mb-0">Terbaik I Putri Duta Bahasa Sumatra Selatan 2025</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <p class="lead mb-0">Kami percaya, setiap kata adalah jalan menuju pemulihan. Dari Sumatra Selatan, untuk Indonesia</p>
            </div>
        </div>
    </section>
    
@endsection