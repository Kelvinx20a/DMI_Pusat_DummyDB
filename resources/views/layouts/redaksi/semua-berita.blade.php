@extends('layouts.app')

@section('title', 'Semua Berita - DMI - Dewan Masjid Indonesia')
@section('description', 'Jelajahi seluruh artikel, berita, dan informasi terbaru dari Dewan Masjid Indonesia. Temukan berita menarik sesuai topik yang Anda cari.')

@push('meta')
<meta property="og:title" content="Semua Berita - DMI - Dewan Masjid Indonesia">
<meta property="og:description" content="Jelajahi seluruh artikel, berita, dan informasi terbaru dari Dewan Masjid Indonesia.">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="DMI - Dewan Masjid Indonesia">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Semua Berita - DMI - Dewan Masjid Indonesia">
<meta name="twitter:description" content="Jelajahi seluruh artikel, berita, dan informasi terbaru dari Dewan Masjid Indonesia.">
@endpush

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/berita.css') }}">

<section class="all-news-section">
    <div class="container">
        <div class="news-page-header js-reveal">
            <div class="header-left js-reveal">
                <h1 class="main-title" style="margin-bottom: 10px;">Eksplorasi <span>Berita</span></h1>
            </div>
            
            <div class="header-right js-reveal">
                <form class="search-box js-reveal" action="{{ route('redaksi.berita.semua') }}" method="GET">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari topik berita..." aria-label="Search">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        <hr class="divider js-reveal">

        <div class="all-news-grid">
            @forelse($posts as $post)
                <article class="compact-card js-reveal">
                    <a href="{{ $post->frontend_url }}" class="card-link js-reveal">
                        <div class="card-img js-reveal">
                            <img src="{{ $post->frontend_image }}" alt="{{ $post->post_title }}">
                            <span class="card-tag">{{ $post->frontend_category }}</span>
                        </div>
                        <div class="card-body js-reveal">
                            <div class="meta-info">
                                <span><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($post->post_date)->translatedFormat('d M Y') }}</span>
                                <span><i class="far fa-clock"></i> {{ $post->frontend_reading_time }} mnt</span>
                            </div>
                            <h3>{{ $post->post_title }}</h3>
                            <p>{{ $post->frontend_excerpt }}</p>
                            <span class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </article>
            @empty
                <p>Belum ada berita yang dipublikasikan.</p>
            @endforelse

        </div>

            <nav class="pagination-wrapper js-reveal">
                {{ $posts->links('pagination::bootstrap-4') }}
            </nav>
    </div>
</section>
@endsection
