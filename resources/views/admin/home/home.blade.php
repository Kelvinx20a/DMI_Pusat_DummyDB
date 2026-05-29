@extends('admin.layout.layout_admin')

@push('after-style')
<link rel="stylesheet" href="{{ asset('admin/css/home.css') }}">
@endpush

@section('content')
<div class="home-container">

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon stat-icon-green"><i class='bx bx-news'></i></div>
            <p class="stat-label">Total Post</p>
            <p class="stat-val">{{ number_format($totalBerita) }}</p>
            <p class="stat-sub stat-sub-up"><i class='bx bx-up-arrow-alt'></i> postingan aktif</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-purple"><i class='bx bx-calendar-event'></i></div>
            <p class="stat-label">Total Event</p>
            <p class="stat-val">{{ number_format($totalEvent) }}</p>
            <p class="stat-sub stat-sub-up"><i class='bx bx-up-arrow-alt'></i> {{ $eventBerlangsung }} berlangsung</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-blue"><i class='bx bx-group'></i></div>
            <p class="stat-label">Total User</p>
            <p class="stat-val">{{ number_format($totalUser) }}</p>
            <p class="stat-sub stat-sub-up"><i class='bx bx-up-arrow-alt'></i> pengguna aktif</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-amber"><i class='bx bx-bar-chart-alt-2'></i></div>
            <p class="stat-label">Total Visitor</p>
            <p class="stat-val">{{ $totalViews >= 1000 ? number_format($totalViews / 1000, 1) . 'K' : number_format($totalViews) }}</p>
            <p class="stat-sub stat-sub-up"><i class='bx bx-up-arrow-alt'></i> semua postingan</p>
        </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- MAIN CONTENT: BERITA + PANEL KANAN     --}}
    {{-- ═══════════════════════════════════════ --}}
    <div class="home-main-grid">

        {{-- Kolom Kiri --}}
        <div class="home-left">

            {{-- Berita Terbaru --}}
            <div class="dash-card" style="margin-bottom: 20px;">
                <div class="dash-card-header">
                    <p class="dash-card-title">Berita Terbaru</p>
                    <a href="{{ route('posts.index') }}" class="dash-see-all">Lihat semua →</a>
                </div>

                {{-- Featured Post --}}
                @if($featuredPost)
                <div class="featured-post">
                    <div class="featured-post-img">
                        <img src="{{ $featuredPost->getImageUrl() ?? asset('admin-assets/img/placeholder.png') }}"
                             alt="{{ $featuredPost->post_title }}">
                        <span class="featured-badge">FEATURED</span>
                    </div>
                    <div class="featured-post-body">
                        <h3 class="featured-post-title">
                            {{ Str::limit($featuredPost->post_title, 100) }}
                        </h3>
                        <div class="featured-post-meta">
                            <span><i class='bx bx-calendar'></i> {{ \Carbon\Carbon::parse($featuredPost->post_date)->format('d M Y') }}</span>
                            <span><i class='bx bx-user'></i> Admin</span>
                            @php
                                $fViews = DB::connection('wordpress')
                                    ->table('ism13qf_postmeta')
                                    ->where('post_id', $featuredPost->ID)
                                    ->where('meta_key', 'trx_addons_post_views_count')
                                    ->value('meta_value');
                            @endphp
                            <span><i class='bx bx-show'></i> {{ number_format($fViews ?? 0) }}</span>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Grid 4 berita terbaru --}}
                <div class="recent-posts-grid">
                    @foreach($recentPosts as $post)
                    <div class="recent-post-card">
                        <div class="recent-post-img">
                            <img src="{{ $post->getImageUrl() ?? asset('admin-assets/img/placeholder.png') }}"
                                 alt="{{ $post->post_title }}">
                        </div>
                        <div class="recent-post-body">
                            <p class="recent-post-title">{{ Str::limit($post->post_title, 55) }}</p>
                            <span class="recent-post-date">{{ \Carbon\Carbon::parse($post->post_date)->format('d M Y') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Event Mendatang --}}
            <div class="dash-card">
                <div class="dash-card-header">
                    <p class="dash-card-title">Event Mendatang</p>
                    <a href="{{ route('events.index') }}" class="dash-see-all">Lihat semua →</a>
                </div>
                <div class="event-cards-grid">
                    @forelse($upcomingEvents as $event)
                    @php
                        $now   = now();
                        $start = \Carbon\Carbon::parse($event->start_date);
                        $end   = \Carbon\Carbon::parse($event->end_date);
                        $isNow = $now->between($start, $end);
                    @endphp
                    <div class="event-card-item">
                        <div class="event-card-date">
                            <span class="event-card-month">{{ strtoupper($start->format('M')) }}</span>
                            <span class="event-card-day">{{ $start->format('d') }}</span>
                        </div>
                        <div class="event-card-info">
                            <p class="event-card-title">{{ Str::limit($event->post->post_title ?? 'Untitled', 35) }}</p>
                            <p class="event-card-loc">
                                <i class='bx bx-map-pin'></i>
                                {{ $event->post->getMeta('_event_venue') ?? 'Lokasi belum diatur' }}
                            </p>
                            <p class="event-card-time">
                                <i class='bx bx-time'></i>
                                {{ $start->format('H:i') }} - {{ $end->format('H:i') }} WIB
                            </p>
                        </div>
                        <span class="ev-badge {{ $isNow ? 'ev-badge-amber' : 'ev-badge-green' }}">
                            {{ $isNow ? 'Berlangsung' : 'Akan Datang' }}
                        </span>
                    </div>
                    @empty
                    <p style="font-size:13px;color:#999;">Tidak ada event mendatang.</p>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- Kolom Kanan --}}
        <div class="home-right">

            {{-- Post Terbaru --}}
            <div class="dash-card" style="margin-bottom: 20px;">
                <div class="dash-card-header">
                    <p class="dash-card-title">Post Terbaru</p>
                    <a href="{{ route('posts.index') }}" class="dash-see-all">Lihat semua →</a>
                </div>
                @foreach($latestPosts as $post)
                <div class="side-post-item">
                    <div class="side-post-img">
                        <img src="{{ $post->getImageUrl() ?? asset('admin-assets/img/placeholder.png') }}"
                             alt="{{ $post->post_title }}">
                    </div>
                    <div class="side-post-info">
                        <p class="side-post-title">{{ Str::limit($post->post_title, 50) }}</p>
                        <span class="side-post-meta">
                            {{ \Carbon\Carbon::parse($post->post_date)->format('M d, Y') }}
                            &bull; 10 min
                        </span>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Aktivitas Terbaru --}}
            <div class="dash-card">
                <div class="dash-card-header">
                    <p class="dash-card-title">Aktivitas Terbaru</p>
                </div>
                @forelse($recentActivities as $activity)
                <div class="activity-item">
                    <div class="activity-icon">
                        @if($activity->type === 'post_auto_published')
                            <i class='bx bx-plus-circle' style="color:#2e7d32"></i>
                        @elseif($activity->type === 'comment')
                            <i class='bx bx-comment' style="color:#1565c0"></i>
                        @else
                            <i class='bx bx-bell' style="color:#f57f17"></i>
                        @endif
                    </div>
                    <div class="activity-info">
                        <p class="activity-text">{{ $activity->message }}</p>
                        <span class="activity-time">
                            {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}
                        </span>
                    </div>
                </div>
                @empty
                <p style="font-size:13px;color:#999;padding:8px 0;">Belum ada aktivitas.</p>
                @endforelse
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- SECTION STATISTIK (tetap ada)          --}}
    {{-- ═══════════════════════════════════════ --}}
    <hr class="home-divider" style="margin-top: 28px;">

    <div class="dash-two-col">
        {{-- Berita Terpopuler --}}
        <div class="dash-card">
            <p class="dash-card-title">Berita terpopuler</p>
            @foreach($popularPosts as $i => $post)
            <div class="pop-row">
                <span class="pop-rank">{{ $i + 1 }}</span>
                <div class="pop-info">
                    <p class="pop-title">{{ Str::limit($post->post_title, 45) }}</p>
                    <p class="pop-meta">{{ \Carbon\Carbon::parse($post->post_date)->format('M d') }}</p>
                </div>
                <span class="pop-views">{{ number_format($post->view_count) }}</span>
            </div>
            @endforeach
        </div>

        {{-- Status Postingan --}}
        <div class="dash-card">
            <p class="dash-card-title">Status postingan</p>
            <div class="status-row">
                <div class="status-icon status-icon-green"><i class='bx bx-check-circle'></i></div>
                <div class="status-info">
                    <p class="status-name">Publish</p>
                    <p class="status-desc">Tayang di website</p>
                </div>
                <span class="status-count status-count-green">{{ number_format($postPublish) }}</span>
            </div>
            <div class="status-row">
                <div class="status-icon status-icon-blue"><i class='bx bx-calendar-check'></i></div>
                <div class="status-info">
                    <p class="status-name">Terjadwal</p>
                    <p class="status-desc">Akan tayang otomatis</p>
                </div>
                <span class="status-count status-count-blue">{{ number_format($postTerjadwal) }}</span>
            </div>
            <div class="status-bar">
                <div class="status-bar-fill status-bar-green" style="width: {{ $pctPublish }}%"></div>
                <div class="status-bar-fill status-bar-blue" style="width: {{ $pctTerjadwal }}%"></div>
            </div>
            <div class="status-legend">
                <div class="legend-item"><div class="legend-dot legend-dot-green"></div><span>Publish ({{ $pctPublish }}%)</span></div>
                <div class="legend-item"><div class="legend-dot legend-dot-blue"></div><span>Terjadwal ({{ $pctTerjadwal }}%)</span></div>
            </div>
        </div>
    </div>

</div>
@endsection