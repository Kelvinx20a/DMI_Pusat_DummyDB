@extends('layouts.app')

@section('title', 'Berita - DMI - Dewan Masjid Indonesia')
@section('description', 'Portal berita resmi Dewan Masjid Indonesia — informasi terkini seputar kegiatan, program kerja, dan pengembangan masjid di seluruh Indonesia.')

@push('meta')
<meta property="og:title" content="Berita - DMI - Dewan Masjid Indonesia">
<meta property="og:description" content="Portal berita resmi Dewan Masjid Indonesia — informasi terkini seputar kegiatan, program kerja, dan pengembangan masjid di seluruh Indonesia.">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="DMI - Dewan Masjid Indonesia">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Berita - DMI - Dewan Masjid Indonesia">
<meta name="twitter:description" content="Portal berita resmi Dewan Masjid Indonesia — informasi terkini seputar kegiatan, program kerja, dan pengembangan masjid di seluruh Indonesia.">
@endpush

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
                    @forelse($headlinePosts as $post)
                        <div class="swiper-slide">
                            <a href="{{ $post->frontend_url }}" class="slide-card">
                                <img src="{{ $post->frontend_image }}" alt="{{ $post->post_title }}">
                                <div class="slide-overlay">
                                    <div class="slide-overlay-inner">
                                        <span class="tag-slider">{{ $loop->first ? 'Headline' : $post->frontend_category }}</span>
                                        <h2>{{ $post->post_title }}</h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="slide-card">
                                <img src="{{ asset('admin-assets/img/logo dmi.png') }}" alt="Belum ada berita">
                                <div class="slide-overlay">
                                    <div class="slide-overlay-inner">
                                        <span class="tag-slider">Berita</span>
                                        <h2>Belum ada berita yang dipublikasikan.</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="news-grid js-reveal">
                @foreach($gridPosts as $post)
                    <a href="{{ $post->frontend_url }}" class="news-card js-reveal">
                        <div class="news-img">
                            <img src="{{ $post->frontend_image }}" alt="{{ $post->post_title }}">
                        </div>
                        <div class="news-info">
                            <span class="category">{{ $post->frontend_category }}</span>
                            <h3>{{ $post->post_title }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </main>

        <aside class="sidebar js-reveal">
            <div class="sidebar-header js-reveal">
                <h2>Terpopuler</h2>
            </div>
            
            <div class="trending-container js-reveal">
                @foreach($popularPosts as $post)
                    <a href="{{ $post->frontend_url }}" class="trending-item js-reveal">
                        <div class="rank">{{ $loop->iteration }}</div>
                        <div class="trend-content">
                            <h4>{{ $post->post_title }}</h4>
                            <span class="category">{{ $post->frontend_category }}</span>
                        </div>
                    </a>
                @endforeach
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
            @foreach($latestPosts as $index => $post)
            @php
                $bentoClass = '';
                if($index == 0) $bentoClass = 'main-feature';
                elseif($index == 1) $bentoClass = 'medium-feature';
                else $bentoClass = 'small-feature';
            @endphp

            <article class="news-card-refined {{ $bentoClass }}">
                <a href="{{ $post->frontend_url }}" class="card-anchor-wrapper">
                    <div class="card-thumb">
                        <img src="{{ $post->frontend_image }}" alt="{{ $post->post_title }}" loading="lazy">
                        <span class="category-tag">{{ $post->frontend_category }}</span>
                    </div>
                    <div class="card-content">
                        <span class="date-meta"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($post->post_date)->translatedFormat('d M Y') }}</span>
                        <h3 class="title-refined">{{ $post->post_title }}</h3>
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
                @foreach($archivePosts as $archive)
                <a href="{{ $archive->frontend_url }}" class="archive-item-link">
                    <div class="archive-item-card">
                        <div class="item-thumb-mini">
                            <img src="{{ $archive->frontend_image }}" alt="{{ $archive->post_title }}">
                        </div>
                        <div class="item-details">
                            <div class="item-meta-row">
                                <span class="item-category">{{ $archive->frontend_category }}</span>
                                <span class="item-dot">•</span>
                                <span class="item-date">{{ \Carbon\Carbon::parse($archive->post_date)->translatedFormat('d M Y') }}</span>
                            </div>
                            <h4 class="item-title-bold">{{ $archive->post_title }}</h4>
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
