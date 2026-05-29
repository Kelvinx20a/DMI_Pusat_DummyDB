<link rel="stylesheet" href="{{ asset('css/kegiatan.css') }}">
<link rel="stylesheet" href="{{ asset('css/berita.css') }}">

@extends('layouts.app')

@section('content')
<section class="ev-full-viewport">
    <div class="ev-container">
        <div class="news-page-header">
            <div class="header-left">
                <h1 class="main-title" style="margin-bottom: 10px;">Event Bulan <span>Ini</span></h1>
            </div>

            <div class="header-right">
                <form class="search-box" method="GET" action="{{ url('/kegiatan/event-bulan-ini') }}">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari event..." aria-label="Search">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        <hr class="divider">

        <main class="ev-main-grid">
            @forelse($events as $event)
                @php
                    $imageUrl = $event->getImageUrl();
                    $title = $event->post->post_title ?? 'Untitled Event';
                    $description = strip_tags($event->post->post_content ?? '');
                    $venue = $event->post->getMeta('_event_venue') ?: 'Lokasi menyusul';
                @endphp
                <article class="ev-card js-reveal">
                    <div class="ev-img-box js-reveal">
                        <img src="{{ $imageUrl ?? asset('admin-assets/img/logo dmi.png') }}" alt="{{ $title }}">
                        <div class="ev-date-tag">{{ \Carbon\Carbon::parse($event->start_date)->format('d M') }}</div>
                    </div>
                    <div class="ev-card-body js-reveal">
                        <h3 class="ev-item-title js-reveal">{{ $title }}</h3>
                        <p class="ev-item-text js-reveal">{{ \Illuminate\Support\Str::limit($description, 120) }}</p>
                        <div class="ev-item-meta js-reveal">
                            <span><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($event->start_date)->format('H:i') }} WIB</span>
                            <span><i class="fas fa-map-marker-alt"></i> {{ \Illuminate\Support\Str::limit($venue, 30) }}</span>
                        </div>
                        <a href="{{ $event->getDetailUrl() }}">
                            <button class="ev-btn-primary js-reveal">Lihat Detail</button>
                        </a>
                    </div>
                </article>
            @empty
                <div class="ev-empty-state js-reveal">
                    <h3>Belum ada event diterbitkan.</h3>
                    <p>Event yang sudah dipublish akan tampil di halaman ini.</p>
                </div>
            @endforelse
        </main>
    </div>
</section>

@if($events->hasPages())
    <section class="dmi-pagination-area">
        <div class="dmi-pagination-container js-reveal">
            {{ $events->withQueryString()->links('pagination::bootstrap-4') }}
        </div>
    </section>
@endif
@endsection
