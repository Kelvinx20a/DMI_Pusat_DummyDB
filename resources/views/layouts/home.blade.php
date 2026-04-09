<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- panggil file master, dan panggil navbar -->
  @extends('layouts.app')
    @section('content')
    
  <!-- Hero Section -->
    <section class="hero-premium">
    <div class="hero-bg-wrapper">
        <img src="../img/home/hero-banner.jpg" alt="DMI Background" class="hero-zoom-bg">
        <div class="hero-overlay-gradient"></div>
    </div>
    
    <div class="container-custom hero-inner js-reveal">
        <div class="hero-tag">Official Website</div>
        <h1 class="hero-title">Dewan Masjid <span class="text-gradient">Indonesia</span></h1>
        <p class="hero-subtitle">Menyatukan Masjid, Menguatkan Umat. Membangun peradaban yang berlandaskan iman dan kebersamaan di seluruh penjuru negeri.</p>
        <div class="hero-actions">
            <a href="#carousel" class="btn-glow">Jelajahi Program <i class="fas fa-arrow-right"></i></a>
            
            <!-- button play -->
            <!-- <a href="/Redaksi/Berita" style="text-decoration: none;"><button class="btn-play-circle" id="openVideo"><i class="fas fa-play"></i></button></a> -->
        </div>
    </div>
    
    <div class="hero-scroll-indicator">
        <div class="mouse"></div>
    </div>
</section>
  <!-- End Hero Section -->


  <!-- Carousel -->
<section id="carousel" class="news-section">
    <div class="news-container">
        <div class="news-left js-reveal">
            <div class="carousel-wrapper">
                <div class="carousel-main">
                    <div class="carousel-slides">
                        <div class="slide active">
                            <img src="../img/home/c2.jpg"  alt="Program Akustik">
                            <div class="slide-info">
                                <span class="badge">PROGRAM UNGGULAN</span>
                                <h2>Penataan Akustik Masjid: Menjamin Kekhusyukan Ibadah di Seluruh Indonesia</h2>
                                <p class="meta">Manajemen Masjid | 5 jam yang lalu</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="../img/home/c1.jpg" alt="Ekonomi Umat">
                            <div class="slide-info">
                                <span class="badge">PEMBERDAYAAN</span>
                                <h2>Optimalisasi Fungsi Masjid sebagai Pusat Pengembangan Ekonomi Syariah</h2>
                                <p class="meta">Ekonomi Umat | 1 hari yang lalu</p>
                            </div>
                        </div>
                    </div>

                    <button class="nav-arrow prev" id="prevBtn">&#10094;</button>
                    <button class="nav-arrow next" id="nextBtn">&#10095;</button>
                </div>

                <div class="carousel-footer">
                    <div class="footer-label">
                        <span>WARTA MASJID</span>
                        <div class="line"></div>
                    </div>
                    <div class="footer-grid">
                        <div class="footer-item" data-index="0">
                            <h4>Pelatihan Teknisi Akustik Masjid Regional Sumatera</h4>
                            <p>Program Kerja | 8 jam yang lalu</p>
                        </div>
                        <div class="footer-item" data-index="1">
                            <h4>Sosialisasi Sertifikasi Tanah Wakaf bersama ATR/BPN</h4>
                            <p>Legalitas | 12 jam yang lalu</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="news-right js-reveal">
            <h3 class="sidebar-title">AGENDA POPULER</h3>
            <div class="popular-list">

                <div class="popular-card">
                    <span class="rank">1</span>
                    <div class="popular-content">
                        <h4>Panduan Standarisasi Manajemen Masjid Modern 2026</h4>
                        <span class="cat">Manajemen</span>
                    </div>
                </div>

                  <div class="popular-card">
                    <span class="rank">1</span>
                    <div class="popular-content">
                        <h4>Panduan Standarisasi Manajemen Masjid Modern 2026</h4>
                        <span class="cat">Manajemen</span>
                    </div>
                </div>

                <div class="popular-card">
                    <span class="rank">1</span>
                    <div class="popular-content">
                        <h4>Panduan Standarisasi Manajemen Masjid Modern 2026</h4>
                        <span class="cat">Manajemen</span>
                    </div>
                </div>


                <div class="popular-card">
                    <span class="rank">1</span>
                    <div class="popular-content">
                        <h4>Panduan Standarisasi Manajemen Masjid Modern 2026</h4>
                        <span class="cat">Manajemen</span>
                    </div>
                </div>

                <div class="popular-card">
                    <span class="rank">1</span>
                    <div class="popular-content">
                        <h4>Panduan Standarisasi Manajemen Masjid Modern 2026</h4>
                        <span class="cat">Manajemen</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Preview Embed Video YT -->
<section class="video-preview-section">
    <div class="video-card js-reveal">
        <div class="video-box">
            <iframe 
                src="https://www.youtube.com/embed/eRo5KTO8_dM?rel=0" 
                title="DMI dan Trisakti Beri Beasiswa Gratis untuk Anak Marbot" 
                allowfullscreen>
            </iframe>
        </div>
    </div>
</section>

<!-- Contact Us Section -->
    <section class="contact-premium-v4">
    <div class="container-wide">
        <div class="header-content js-reveal">
            <span class="accent-tag">Hubungi Kami</span>
            <h2 class="title-modern">Layanan Komunikasi <span class="text-dmi">Pusat DMI</span></h2>
        </div>

        <div class="bento-layout">
            <div class="bento-item map-wrapper js-reveal" id="mapBox">
                <div class="map-placeholder" id="mapPlaceholder">
                    <div class="map-overlay-content">
                        <div class="pulse-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <p>Klik untuk memuat peta interaktif</p>
                        <button class="btn-load-map">Aktifkan Peta</button>
                    </div>
                </div>
                <div id="mapIframeContainer" class="map-iframe-hidden"></div>
            </div>

            <div class="info-grid">
                <a href="https://wa.me/628111057102" class="premium-card js-reveal">
                    <div class="card-glass-effect"></div>
                    <div class="card-icon-wrap">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    
                    <div class="card-details">
                        <span class="card-label">Hotline 24/7</span>
                        <h3>+62 811 1057 102</h3>
                    </div>
                    <div class="card-action-icon"><i class="fas fa-arrow-right"></i></div>
                </a>

                <div class="grid-sub-row">
                    <a href="mailto:hello@dmi.tv" class="premium-card js-reveal">
                        <div class="card-icon-wrap sm"><i class="far fa-envelope"></i></div>
                        <div class="card-details">
                            <span class="card-label">Email</span>
                            <h4>hello@dmi.tv</h4>
                        </div>
                    </a>
                    <a href="https://www.instagram.com/dmitvofficial_" class="premium-card js-reveal">
                        <div class="card-icon-wrap sm"><i class="fab fa-instagram"></i></div>
                        <div class="card-details">
                            <span class="card-label">Instagram</span>
                            <h4>@dmitvofficial_</h4>
                        </div>
                    </a>
                </div>

                <a href="https://www.tiktok.com/@dmitvofficial" class="premium-card js-reveal">
                    <div class="card-icon-wrap sm"><i class="fab fa-tiktok"></i></div>
                    <div class="card-details">
                        <span class="card-label">TikTok Official</span>
                        <h4>@dmitvofficial</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- footer -->

    @endsection
    <!-- penutup footer -->