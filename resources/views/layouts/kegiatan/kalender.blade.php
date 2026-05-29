<link rel="stylesheet" href="{{ asset('css/kegiatan.css') }}">

@extends('layouts.app')

@section('content')
@php
    $prevMonth = $currentMonth->copy()->subMonth()->format('Y-m');
    $nextMonth = $currentMonth->copy()->addMonth()->format('Y-m');
@endphp

<section class="cal-section">
    <div class="cal-container">
        <header class="cal-header">
            <div class="cal-title-wrap">
                <span class="cal-label js-reveal">Jadwal Kegiatan</span>
                <h2 class="cal-main-title js-reveal">Kalender Event</h2>
            </div>

            <div class="cal-controls js-reveal">
                <div class="cal-month-selector">
                    <a class="cal-nav-btn" id="prevMonth" href="{{ url('/kegiatan/kalender-event?month=' . $prevMonth) }}">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <div class="cal-month-display">
                        <i class="far fa-calendar-alt"></i>
                        <span class="cal-current-month" id="monthDisplay">{{ $currentMonth->translatedFormat('F Y') }}</span>
                    </div>
                    <a class="cal-nav-btn" id="nextMonth" href="{{ url('/kegiatan/kalender-event?month=' . $nextMonth) }}">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </header>

        <div class="cal-layout-grid js-reveal">
            <div class="cal-main-card">
                <div class="cal-days-header">
                    <span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span>
                    <span>Jum</span><span>Sab</span><span>Min</span>
                </div>
                <div class="cal-date-grid" id="calendarGrid" data-server-calendar="true">
                    @foreach($calendarDays as $day)
                        @php
                            $dateKey = $day->format('Y-m-d');
                            $dayEvents = $eventsByDate->get($dateKey, collect());
                            $firstEvent = $dayEvents->first();
                            $isMuted = !$day->isSameMonth($currentMonth);
                            $isToday = $day->isToday();
                            $isActive = $selectedEvent && $firstEvent && $firstEvent->event_id === $selectedEvent->event_id;
                        @endphp
                        <div class="cal-day {{ $isMuted ? 'muted' : '' }} {{ $isToday ? 'today' : '' }} {{ $dayEvents->isNotEmpty() ? 'has-event' : '' }} {{ $isActive ? 'active' : '' }}"
                            @if($firstEvent)
                                data-title="{{ e($firstEvent->post->post_title ?? 'Untitled Event') }}"
                                data-tag="{{ now()->between($firstEvent->start_date, $firstEvent->end_date) ? 'Sedang Berjalan' : (now()->lt($firstEvent->start_date) ? 'Mendatang' : 'Selesai') }}"
                                data-date="{{ \Carbon\Carbon::parse($firstEvent->start_date)->translatedFormat('d F Y') }}"
                                data-time="{{ \Carbon\Carbon::parse($firstEvent->start_date)->format('H:i') }} - {{ \Carbon\Carbon::parse($firstEvent->end_date)->format('H:i') }} WIB"
                                data-location="{{ e($firstEvent->post->getMeta('_event_venue') ?: 'Lokasi menyusul') }}"
                                data-url="{{ $firstEvent->getDetailUrl() }}"
                            @endif
                        >
                            {{ $day->day }}
                            @if($dayEvents->isNotEmpty())
                                @if($dayEvents->count() > 1)
                                    <span class="event-count-badge">{{ $dayEvents->count() }}</span>
                                @else
                                    <span class="event-dot"></span>
                                @endif
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <aside class="cal-event-sidebar js-reveal">
                <div class="sidebar-sticky">
                    <h3 class="sidebar-title">Kegiatan Terpilih</h3>
                    <div class="selected-event-card" id="event-display-card">
                        @if($selectedEvent)
                            @php
                                $selectedStart = \Carbon\Carbon::parse($selectedEvent->start_date);
                                $selectedEnd = \Carbon\Carbon::parse($selectedEvent->end_date);
                                $selectedStatus = now()->between($selectedStart, $selectedEnd) ? 'Sedang Berjalan' : (now()->lt($selectedStart) ? 'Mendatang' : 'Selesai');
                            @endphp
                            <div class="sel-tag" id="event-tag">{{ $selectedStatus }}</div>
                            <div class="sel-date" id="event-date">{{ $selectedStart->translatedFormat('d F Y') }}</div>
                            <div class="sel-info">
                                <h4 id="event-title">{{ $selectedEvent->post->post_title ?? 'Untitled Event' }}</h4>
                                <div class="sel-meta">
                                    <p><i class="far fa-clock"></i> <span id="event-time">{{ $selectedStart->format('H:i') }} - {{ $selectedEnd->format('H:i') }} WIB</span></p>
                                    <p><i class="fas fa-map-marker-alt"></i> <span id="event-location">{{ $selectedEvent->post->getMeta('_event_venue') ?: 'Lokasi menyusul' }}</span></p>
                                </div>
                                <a href="{{ $selectedEvent->getDetailUrl() }}" id="event-detail-link"><button class="btn-sel-detail">Lihat Detail Agenda</button></a>
                            </div>
                        @else
                            <div class="sel-tag" id="event-tag">Kosong</div>
                            <div class="sel-date" id="event-date">{{ $currentMonth->translatedFormat('F Y') }}</div>
                            <div class="sel-info">
                                <h4 id="event-title">Belum Ada Kegiatan</h4>
                                <div class="sel-meta">
                                    <p><i class="far fa-clock"></i> <span id="event-time">-</span></p>
                                    <p><i class="fas fa-map-marker-alt"></i> <span id="event-location">-</span></p>
                                </div>
                                <a href="#" id="event-detail-link" style="display:none;"><button class="btn-sel-detail">Lihat Detail Agenda</button></a>
                            </div>
                        @endif
                    </div>

                </div>
            </aside>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const dayCells = document.querySelectorAll('.cal-day');
    const eventCard = document.getElementById('event-display-card');
    const detailLink = document.getElementById('event-detail-link');

    dayCells.forEach(cell => {
        cell.addEventListener('click', () => {
            dayCells.forEach(day => day.classList.remove('active'));
            cell.classList.add('active');

            if (cell.dataset.title) {
                document.getElementById('event-title').innerText = cell.dataset.title;
                document.getElementById('event-tag').innerText = cell.dataset.tag;
                document.getElementById('event-date').innerText = cell.dataset.date;
                document.getElementById('event-time').innerText = cell.dataset.time;
                document.getElementById('event-location').innerText = cell.dataset.location;
                detailLink.href = cell.dataset.url;
                detailLink.style.display = '';
                eventCard.style.opacity = '1';
                eventCard.style.transform = 'translateY(0)';
                return;
            }

            document.getElementById('event-title').innerText = 'Tidak Ada Kegiatan';
            document.getElementById('event-tag').innerText = 'Kosong';
            document.getElementById('event-date').innerText = cell.innerText.trim();
            document.getElementById('event-time').innerText = '-';
            document.getElementById('event-location').innerText = '-';
            detailLink.style.display = 'none';
            eventCard.style.opacity = '0.7';
        });
    });
});
</script>
@endsection
