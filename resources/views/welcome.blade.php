@extends('layouts.landing')

@section('title', 'Sistem Informasi Desa - Transparansi dan Pemberdayaan Masyarakat')


@section('content')
    <!-- [ Header ] start -->
    <header id="home" class="d-flex align-items-center"
        style="position: relative; min-height: 100dvh; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
        <!-- Animated Background -->
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; overflow: hidden; z-index: 1; pointer-events: none;">
            <div style="position: absolute; top: -50%; right: -10%; width: 600px; height: 600px; background: rgba(255,255,255,0.05); border-radius: 50%; animation: float 8s ease-in-out infinite;"></div>
            <div style="position: absolute; bottom: -30%; left: -5%; width: 400px; height: 400px; background: rgba(255,255,255,0.03); border-radius: 50%; animation: float 10s ease-in-out infinite reverse;"></div>
        </div>

        <div class="container mt-5 pt-5" style="position: relative; z-index: 10;">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8 text-center">
                    <h1 class="mt-sm-3 text-white mb-4 f-w-600 wow fadeInUp" data-wow-delay="0.2s" style="font-size: 3.5rem; font-weight: 800;">
                        Selamat Datang di
                        <br>
                        <span class="text-warning" style="background: linear-gradient(135deg, #ffd700, #ffed4e); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Sistem Informasi Desa Bibi</span>
                    </h1>
                    <h5 class="mb-4 text-white opacity-90 wow fadeInUp" data-wow-delay="0.4s" style="font-size: 1.25rem; font-weight: 300;">
                        Transparansi, Partisipasi, dan Pemberdayaan Masyarakat
                        <br class="d-none d-md-block">
                        Akses informasi desa, laporan keuangan, dan layanan publik dengan mudah dan transparan.
                    </h5>
                    <div class="my-5 wow fadeInUp" data-wow-delay="0.6s" style="position: relative; z-index: 10;">
                        <a href="{{ route('register') }}"
                            class="btn btn-warning btn-lg d-inline-flex align-items-center me-2" style="color: #1e3c72; font-weight: 600; cursor: pointer;">
                            Daftar Sebagai Warga <i class="ti ti-arrow-right ms-2"></i>
                        </a>
                        <a href="#alur" class="btn btn-outline-light btn-lg me-2" style="border-width: 2px; cursor: pointer;">Pelajari Sistem</a>
                    </div>
                </div>
            </div>
        </div>
        
        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(30px) rotate(180deg); }
            }
        </style>
    </header>
    <!-- [ Header ] End -->

    <!-- [ Fitur Unggulan ] start -->
    <section>
        <div class="container title">
            <div class="row justify-content-center text-center wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-md-10 col-xl-6">
                    <h5 class="text-primary mb-0">Transformasi Digital</h5>
                    <h2 class="my-3">Fitur Unggulan Sistem Informasi Desa</h2>
                    <p class="mb-0">Kami menyediakan platform terintegrasi untuk meningkatkan transparansi dan layanan publik
                        di tingkat desa dengan teknologi terkini.</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-6 col-lg-4">
                    <div class="card wow fadeInUp" data-wow-delay="0.4s">
                        <div class="card-body">
                            <i class="ti ti-lock-open f-36 text-primary" style="margin-bottom: 1rem;"></i>
                            <h5 class="my-3">Transparansi Data</h5>
                            <p class="mb-0 text-muted">Akses laporan keuangan, anggaran, dan penggunaan dana publik secara real-time
                                dengan format yang mudah dipahami.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card wow fadeInUp" data-wow-delay="0.6s">
                        <div class="card-body">
                            <i class="ti ti-users f-36 text-primary" style="margin-bottom: 1rem;"></i>
                            <h5 class="my-3">Layanan Administrasi</h5>
                            <p class="mb-0 text-muted">Ajukan surat pengantar, surat kelahiran, kematian, dan layanan administrasi
                                lainnya secara online dari rumah Anda.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card wow fadeInUp" data-wow-delay="0.8s">
                        <div class="card-body">
                            <i class="ti ti-bell f-36 text-primary" style="margin-bottom: 1rem;"></i>
                            <h5 class="my-3">Berita & Pengumuman</h5>
                            <p class="mb-0 text-muted">Dapatkan informasi terbaru tentang kegiatan desa, pengumuman penting,
                                dan undangan acara langsung ke dashboard Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Fitur Unggulan ] End -->

    <!-- [ Alur Penggunaan ] start -->
    <section class="pt-0" id="alur">
        <div class="container title">
            <div class="row justify-content-center text-center wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-md-10 col-xl-6">
                    <h5 class="text-primary mb-0">Mudah & Cepat</h5>
                    <h2 class="my-3">Langkah Menggunakan Sistem</h2>
                    <p class="mb-0">Ikuti 4 langkah sederhana untuk memulai menggunakan sistem informasi desa kami.
                    </p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-6 col-lg-3">
                    <div class="card wow fadeInUp" data-wow-delay="0.4s">
                        <div class="card-body text-center">
                            <i class="ti ti-user-plus f-36 text-primary"></i>
                            <h5 class="my-3">1. Daftar Akun</h5>
                            <p class="mb-0 text-muted">Buat akun warga dengan menggunakan NIK dan email aktif Anda
                                untuk mendapatkan akses penuh.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card wow fadeInUp" data-wow-delay="0.6s">
                        <div class="card-body text-center">
                            <i class="ti ti-shield-check f-36 text-primary"></i>
                            <h5 class="my-3">2. Verifikasi</h5>
                            <p class="mb-0 text-muted">Verifikasi email Anda dan lengkapi profil dengan data pribadi
                                yang akurat dan terpercaya.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card wow fadeInUp" data-wow-delay="0.8s">
                        <div class="card-body text-center">
                            <i class="ti ti-layout-grid f-36 text-primary"></i>
                            <h5 class="my-3">3. Jelajahi Fitur</h5>
                            <p class="mb-0 text-muted">Akses berbagai fitur seperti laporan desa, pengajuan layanan,
                                dan pengumuman terbaru.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card wow fadeInUp" data-wow-delay="1.0s">
                        <div class="card-body text-center">
                            <i class="ti ti-heart-handshake f-36 text-primary"></i>
                            <h5 class="my-3">4. Berpartisipasi</h5>
                            <p class="mb-0 text-muted">Ikut serta dalam keputusan desa dan berikan masukan untuk
                                kemajuan bersama.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Alur Penggunaan ] End -->

    <!-- [ CTA ] start -->
    <section class="cta-block"
        style="position: relative; padding: 120px 0; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); min-height: 400px; display: flex; align-items: center;">
        <!-- Animated Background -->
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; overflow: hidden; z-index: 1; pointer-events: none;">
            <div style="position: absolute; top: -50%; right: -10%; width: 500px; height: 500px; background: rgba(255,255,255,0.05); border-radius: 50%; animation: float 8s ease-in-out infinite;"></div>
            <div style="position: absolute; bottom: -20%; left: -5%; width: 400px; height: 400px; background: rgba(255,255,255,0.03); border-radius: 50%; animation: float 10s ease-in-out infinite reverse;"></div>
        </div>

        <div class="container" style="position: relative; z-index: 10;">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="text-white mb-4" style="font-size: 2.8rem; font-weight: 600;">Jadilah Bagian dari <span
                            style="background: linear-gradient(135deg, #ffd700, #ffed4e); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Gerakan Desa Digital</span></h2>
                    <p class="text-white opacity-90 mb-4 lead">Bergabunglah dengan ribuan warga desa dalam membangun transparansi, 
                        partisipasi aktif, dan pemberdayaan masyarakat. Bersama kita wujudkan desa yang lebih maju dan demokratis.
                    </p>
                    <a href="{{ route('register') }}" class="btn btn-warning btn-lg" style="color: #1e3c72; font-weight: 600; cursor: pointer;">Daftar Sebagai Warga <i
                            class="ti ti-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>

        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(30px) rotate(180deg); }
            }
        </style>
    </section>
    <!-- [ CTA ] End -->

    <!-- [ Statistik ] start -->
    <section class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="card border-0 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <h2 class="m-0 text-primary">3,500+</h2>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-2">Penduduk Desa</h4>
                                    <p class="mb-0">Komunitas aktif yang berkomitmen untuk kemajuan bersama dan transparansi desa.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card border-0 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <h2 class="m-0 text-primary">850+</h2>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-2">Keluarga Terdaftar</h4>
                                    <p class="mb-0">Kepala keluarga yang telah terdaftar dan terverifikasi dalam sistem.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card border-0 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <h2 class="m-0 text-primary">2,100+</h2>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-2">Berita & Laporan</h4>
                                    <p class="mb-0">Informasi transparan tentang perkembangan dan kebijakan desa.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Statistik ] End -->

    <!-- [ Testimoni ] start -->
    <section class="pt-0">
        <div class="container title">
            <div class="row justify-content-center text-center wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-md-10 col-xl-6">
                    <h5 class="text-primary mb-0">Testimoni</h5>
                    <h2 class="my-3">Apa Kata Mereka?</h2>
                    <p class="mb-0">Dengarkan pengalaman warga desa dan perangkat desa yang telah merasakan manfaat 
                        dari sistem informasi desa yang transparan dan mudah diakses.</p>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row cust-slider">
                <div class="col-md-6 col-lg-4">
                    <div class="card wow fadeInRight" data-wow-delay="0.2s">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('assets/images/user/avatar-1.jpg') }}"
                                        alt="Warga desa pria" class="img-fluid wid-40 rounded-circle">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1">Transparansi Sangat Terjaga</h5>
                                    <div class="star f-12 mb-3">
                                        <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i
                                            class="fas fa-star text-warning"></i><i
                                            class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i>
                                    </div>
                                    <p class="mb-2 text-muted">Dengan sistem ini, saya bisa memantau anggaran desa dan 
                                        laporan keuangan dengan jelas. Ini memberikan kepercayaan kepada warga seperti saya.</p>
                                    <h6 class="mb-0">Budi Santoso, Warga Desa</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card wow fadeInRight" data-wow-delay="0.4s">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('assets/images/user/avatar-2.jpg') }}"
                                        alt="Perangkat desa wanita"
                                        class="img-fluid wid-40 rounded-circle">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1">Pelayanan Lebih Efisien</h5>
                                    <div class="star f-12 mb-3">
                                        <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i
                                            class="fas fa-star text-warning"></i><i
                                            class="fas fa-star text-warning"></i><i
                                            class="fas fa-star-half-alt text-warning"></i>
                                    </div>
                                    <p class="mb-2 text-muted">Sebagai perangkat desa, sistem ini mempermudah pekerjaan kami 
                                        dalam mengelola surat-surat dan melayani warga dengan lebih cepat dan terorganisir.</p>
                                    <h6 class="mb-0">Rina Wulandari, Perangkat Desa</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card wow fadeInRight" data-wow-delay="0.6s">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('assets/images/user/avatar-3.jpg') }}"
                                        alt="Warga desa wanita berhijab"
                                        class="img-fluid wid-40 rounded-circle">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1">Partisipasi Lebih Mudah</h5>
                                    <div class="star f-12 mb-3">
                                        <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i
                                            class="fas fa-star text-warning"></i><i
                                            class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i>
                                    </div>
                                    <p class="mb-2 text-muted">Platform ini membuat saya lebih aktif berpartisipasi dalam 
                                        keputusan desa. Suara warga jadi lebih didengar dan dipertimbangkan dengan baik.</p>
                                    <h6 class="mb-0">Siti Aminah, Warga Desa</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Testimoni ] End -->
@endsection
