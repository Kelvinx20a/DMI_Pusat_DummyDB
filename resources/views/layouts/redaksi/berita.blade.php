@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<link rel="stylesheet" href="{{ asset('css/berita.css') }}">

<div class="container">
    <div class="main-wrapper">
        
        <main class="main-content">
            
            <div class="swiper headline-slider js-reveal">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="/redaksi/berita/detail-berita" class="slide-card">
                            <img src="https://picsum.photos/id/26/1000/600" alt="News 1">
                            <div class="slide-overlay">
                                <div class="slide-overlay-inner">
                                    <span class="tag-slider">Headline</span>
                                    <h2>Jusuf Kalla Tak Komunikasi dengan Jokowi soal Laporkan Rismon</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="/redaksi/berita/detail-berita" class="slide-card">
                            <img src="https://picsum.photos/id/43/1000/600" alt="News 2">
                            <div class="slide-overlay">
                                <div class="slide-overlay-inner">
                                    <span class="tag-slider">Nasional</span>
                                    <h2>Pemerintah Siapkan Skema Baru Subsidi Energi 2026</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="/redaksi/berita/detail-berita" class="slide-card">
                            <img src="https://picsum.photos/id/50/1000/600" alt="News 3">
                            <div class="slide-overlay">
                                <div class="slide-overlay-inner">
                                    <span class="tag-slider">Internasional</span>
                                    <h2>Gencatan Senjata Global: Dampak Positif Bagi Ekonomi Dunia</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="news-grid js-reveal">
                <a href="/redaksi/berita/detail-berita" class="news-card js-reveal">
                    <div class="news-img">
                        <img src="https://picsum.photos/id/10/400/250" alt="News">
                    </div>
                    <div class="news-info">
                        <span class="category">Nasional</span>
                        <h3>Kepala BGN Sebut Motor Listrik SPPG Di Bawah Harga Pasar</h3>
                    </div>
                </a>

                <a href="/redaksi/berita/detail-berita" class="news-card js-reveal">
                    <div class="news-img">
                        <img src="https://picsum.photos/id/20/400/250" alt="News">
                    </div>
                    <div class="news-info">
                        <span class="category">Regional</span>
                        <h3>Replika Rumah Jokowi Muncul di Roblox, Ditanggapi Santai</h3>
                    </div>
                </a>

                <a href="/redaksi/berita/detail-berita" class="news-card js-reveal">
                    <div class="news-img">
                        <img src="https://picsum.photos/id/30/400/250" alt="News">
                    </div>
                    <div class="news-info">
                        <span class="category">News</span>
                        <h3>Taklimat Prabowo: Kita Telah Mencapai Tonggak Prestasi Nyata</h3>
                    </div>
                </a>

                <a href="/redaksi/berita/detail-berita" class="news-card js-reveal">
                    <div class="news-img">
                        <img src="https://picsum.photos/id/40/400/250" alt="News">
                    </div>
                    <div class="news-info">
                        <span class="category">Properti</span>
                        <h3>Rest Area KM 57 Tol Japek Dirombak Total Tahun Ini</h3>
                    </div>
                </a>

                <a href="/redaksi/berita/detail-berita" class="news-card js-reveal">
                    <div class="news-img">
                        <img src="https://picsum.photos/id/50/400/250" alt="News">
                    </div>
                    <div class="news-info">
                        <span class="category">Internasional</span>
                        <h3>Tembakan Tank Israel Tewaskan Prajurit TNI di Perbatasan</h3>
                    </div>
                </a>

                <a href="/redaksi/berita/detail-berita" class="news-card js-reveal">
                    <div class="news-img">
                        <img src="https://picsum.photos/id/60/400/250" alt="News">
                    </div>
                    <div class="news-info">
                        <span class="category">Ekonomi</span>
                        <h3>Purbaya Respons Rupiah Menguat Usai Gencatan Senjata</h3>
                    </div>
                </a>
            </div>
        </main>

        <aside class="sidebar js-reveal">
            <div class="sidebar-header js-reveal">
                <h2>Terpopuler</h2>
            </div>
            
            <div class="trending-container js-reveal">
                <a href="/redaksi/berita/detail-berita" class="trending-item js-reveal">
                    <div class="rank">1</div>
                    <div class="trend-content">
                        <h4>Dedi Mulyadi Nonaktifkan Kepala Samsat Soekarno-Hatta</h4>
                        <span class="category">Regional</span>
                    </div>
                </a>
                
                <a href="/redaksi/berita/detail-berita" class="trending-item js-reveal">
                    <div class="rank">2</div>
                    <div class="trend-content">
                        <h4>BREAKING NEWS: Trump Umumkan Gencatan Senjata Global</h4>
                        <span class="category">Global</span>
                    </div>
                </a>

                <a href="redaksi/berita/detail-berita" class="trending-item js-reveal">
                    <div class="rank">3</div>
                    <div class="trend-content">
                        <h4>Iran Ungkap 10 Syarat Damai dengan AS-Israel</h4>
                        <span class="category">Global</span>
                    </div>
                </a>

                <a href="/redaksi/berita/detail-berita" class="trending-item js-reveal">
                    <div class="rank">4</div>
                    <div class="trend-content">
                        <h4>Harga Emas Antam Anjlok Tajam Hari Ini, Waktunya Beli?</h4>
                        <span class="category">Ekonomi</span>
                    </div>
                </a>

                <a href="/redaksi/berita/detail-berita" class="trending-item js-reveal">
                    <div class="rank">5</div>
                    <div class="trend-content">
                        <h4>Persib Bandung Amankan Posisi Puncak Klasemen Sementara</h4>
                        <span class="category">Olahraga</span>
                    </div>
                </a>

                <a href="/redaksi/berita/detail-berita" class="trending-item js-reveal">
                    <div class="rank">6</div>
                    <div class="trend-content">
                        <h4>Viral! Teknologi AI Kini Bisa Deteksi Penyakit Tanaman Padi</h4>
                        <span class="category">Teknologi</span>
                    </div>
                </a>

                <a href="/redaksi/berita/detail-berita" class="trending-item js-reveal">
                    <div class="rank">7</div>
                    <div class="trend-content">
                        <h4>Menhub Cek Kesiapan Jalur Mudik Lebaran 2026</h4>
                        <span class="category">Nasional</span>
                    </div>
                </a>

                <a href="/redaksi/berita/detail-berita" class="trending-item js-reveal">
                    <div class="rank">8</div>
                    <div class="trend-content">
                        <h4>Resep Takjil Sehat dan Murah untuk Berbuka Puasa</h4>
                        <span class="category">Gaya Hidup</span>
                    </div>
                </a>
            </div>
        </aside>
    </div>
</div>


<!-- Script Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- ========================== -->
    <!--        Section Baru        -->

<section class="latest-news-section">
    <div class="container-fluid-custom">
        
        <div class="warta-header-wrapper">
            <div class="header-content-left">
                <div class="badge-accent js-reveal">Portal Informasi</div>
                <h2 class="section-main-title js-reveal">Berita <span class="text-gradient">Terkini</span></h2>
            </div>
        </div>

        <div class="news-bento-grid js-reveal">
            @php
                // Data simulasi (Pastikan variabel $articles dikirim dari Controller)
                // Jika ingin menggunakan data asli, hapus array ini.
                $articles = [
                    ['tag' => 'Manajemen', 'date' => '03 Mar 2026', 'title' => 'Standarisasi Akustik Masjid untuk Kenyamanan Ibadah Jemaah', 'img_id' => '10'],
                    ['tag' => 'Ekonomi', 'date' => '02 Mar 2026', 'title' => 'Pemberdayaan UMKM Berbasis Masjid: Strategi Mandiri', 'img_id' => '20'],
                    ['tag' => 'Pendidikan', 'date' => '01 Mar 2026', 'title' => 'Kurikulum Remaja Masjid: Karakter Qurani Era Digital', 'img_id' => '30'],
                    ['tag' => 'Digitalisasi', 'date' => '28 Feb 2026', 'title' => 'Implementasi QRIS Infaq: Transparansi Keuangan Masjid', 'img_id' => '40'],
                    ['tag' => 'Eco-Masjid', 'date' => '27 Feb 2026', 'title' => 'Gerakan Masjid Hijau: Pengelolaan Air Wudhu Mandiri', 'img_id' => '50'],
                    ['tag' => 'Kesehatan', 'date' => '26 Feb 2026', 'title' => 'Layanan Klinik Masjid: Sinergi Dakwah dan Medis', 'img_id' => '60'],
                    ['tag' => 'Sosial', 'date' => '25 Feb 2026', 'title' => 'Dapur Umum Masjid: Solusi Pangan Jemaah Kurang Mampu', 'img_id' => '70'],
                ];
            @endphp

            @foreach(array_slice($articles, 0, 4) as $index => $item)
            @php
                // Menentukan class bento berdasarkan urutan
                $bentoClass = '';
                if($index == 0) $bentoClass = 'main-feature';
                elseif($index == 1) $bentoClass = 'medium-feature';
                else $bentoClass = 'small-feature';
            @endphp

            <article class="news-card-refined {{ $bentoClass }}">
                <a href="/redaksi/berita/detail-berita" class="card-anchor-wrapper">
                    <div class="card-thumb">
                        <img src="https://picsum.photos/id/{{ $item['img_id'] }}/800/600" alt="News Image" loading="lazy">
                        <span class="category-tag">{{ $item['tag'] }}</span>
                    </div>
                    <div class="card-content">
                        <span class="date-meta"><i class="far fa-calendar-alt"></i> {{ $item['date'] }}</span>
                        <h3 class="title-refined">{{ $item['title'] }}</h3>
                        <div class="btn-read-more-minimal">
                            <span>Baca Selengkapnya</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
        </div>

        <hr class="section-divider">

        <div class="news-archive-list js-reveal">
            <div class="archive-header">
                <h4 class="archive-title">Eksplorasi Berita Lainnya</h4>
                <a href="/redaksi/berita/semua-berita" class="view-all-link">
                    Lihat Semua <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="list-wrapper-modern">
                @foreach(array_slice($articles, 4, 3) as $archive)
                <a href="/redaksi/berita/detail-berita" class="archive-item-link">
                    <div class="archive-item-card">
                        <div class="item-thumb-mini">
                            <img src="https://picsum.photos/id/{{ $archive['img_id'] }}/200/200" alt="Thumbnail">
                        </div>
                        <div class="item-details">
                            <div class="item-meta-row">
                                <span class="item-category">{{ $archive['tag'] }}</span>
                                <span class="item-dot">•</span>
                                <span class="item-date">{{ $archive['date'] }}</span>
                            </div>
                            <h4 class="item-title-bold">{{ $archive['title'] }}</h4>
                            <span class="item-read-link">
                                Baca Artikel <i class="fas fa-chevron-right"></i>
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('js/berita.js') }}"></script>
@endsection