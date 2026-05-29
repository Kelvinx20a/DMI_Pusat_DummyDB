<link rel="stylesheet" href="{{ asset('css/kegiatan.css') }}">

@extends('layouts.app')

@section('content')
@php
    $title = $event->post->post_title ?? 'Untitled Event';
    $description = $event->post->post_content ?? '';
    $imageUrl = $event->getImageUrl();
    $venue = $event->post->getMeta('_event_venue') ?: 'Lokasi menyusul';
    $organizer = $event->post->getMeta('_event_organizer') ?: 'DMI Pusat';
    $start = \Carbon\Carbon::parse($event->start_date);
    $end = \Carbon\Carbon::parse($event->end_date);
    $status = now()->between($start, $end) ? 'Berlangsung' : (now()->lt($start) ? 'Akan Datang' : 'Selesai');
@endphp

<section class="single-event-page">
    <div class="det-ev-main-wrapper">
        <header class="ev-header-area">
            <div class="ev-meta-top">
                <span class="ev-category">{{ $organizer }}</span>
                <span class="ev-dot"></span>
                <span class="ev-status-text"><i class="fas fa-circle" style="font-size: 8px;"></i> {{ $status }}</span>
            </div>
            <h1 class="ev-main-headline">{{ $title }}</h1>
        </header>

        <div class="ev-content-grid">
            <div class="ev-visual-narasi">
                <div class="ev-featured-image">
                    <img src="{{ $imageUrl ?? asset('admin-assets/img/logo dmi.png') }}" alt="{{ $title }}">
                </div>

                <div class="ev-description">
                    <h3 class="ev-sub-title">Tentang Kegiatan</h3>
                    @if(trim(strip_tags($description)) !== '')
                        {!! $description !!}
                    @else
                        <p>Detail kegiatan belum tersedia.</p>
                    @endif
                </div>
            </div>

            <aside class="ev-info-sidebar">
                <div class="ev-sticky-card">
                    <div class="ev-card-header">
                        <h4>Detail Informasi</h4>
                        <div class="header-line"></div>
                    </div>

                    <div class="ev-detail-list">
                        <div class="ev-detail-item">
                            <div class="ev-icon"><i class="far fa-calendar-check"></i></div>
                            <div class="ev-text-group">
                                <label>Waktu Pelaksanaan</label>
                                <span class="primary-info">{{ $start->translatedFormat('l, d M Y') }}</span>
                                <span class="secondary-info">{{ $start->format('H:i') }} - {{ $end->format('H:i') }} WIB</span>
                            </div>
                        </div>

                        <div class="ev-detail-item">
                            <div class="ev-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="ev-text-group">
                                <label>Lokasi / Tempat</label>
                                <span class="primary-info">{{ $venue }}</span>
                            </div>
                        </div>

                        <div class="ev-detail-item">
                            <div class="ev-icon"><i class="fas fa-id-badge"></i></div>
                            <div class="ev-text-group">
                                <label>Penyelenggara</label>
                                <span class="primary-info">{{ $organizer }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
