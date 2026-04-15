<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/proker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <title>DMI - Dewan Masjid Indonesia</title>
    <script src="{{ asset('js/script.js') }}"></script>
</head>
<body>

    @include('partials.navbar')

   @php 
    /**
     * LOGIKA BREADCRUMB - DMI MASTER (DYNAMIC ORIGIN)
     * ---------------------------------------------------------
     * Mode Glass: Transparan untuk halaman dengan Hero Banner.
     * Mode Solid: Putih pekat untuk halaman detail/artikel.
     */
    
    $isGlassPage = false; 
    $segments = request()->segments();
    $segmentCount = count($segments);
    $firstSegment = request()->segment(1);

    // 1. PENENTUAN MODE (GLASS VS SOLID)
    if(!Request::is('/')) {
        $glassRoutes = ['tentang-kami', 'profil']; 
        
        if (in_array($firstSegment, $glassRoutes)) {
            $isGlassPage = true;

            // Pengecualian: Halaman yang harus selalu SOLID
            $excludeToSolid = ['detail-berita', 'pengurus', 'artikel', 'lihat']; 
            $hasExcludeKeyword = count(array_intersect($segments, $excludeToSolid)) > 0;
            
            // Jika masuk ke detail atau level URL terlalu dalam, paksa Solid
            if ($hasExcludeKeyword || $segmentCount > 3) {
                $isGlassPage = false;
            }
        }
    }

    // 2. KONFIGURASI SEGMEN
    // Segmen yang labelnya tidak bisa diklik (hanya teks)
    $disabledSegments = ['program-kerja', 'tentang-kami', 'kegiatan', 'redaksi']; 
    
    // Deteksi asal user (Origin) melalui Query String '?from='
    $originSource = request()->query('from');
@endphp

@if(!Request::is('/'))
<nav class="dmi-breadcrumb-master {{ $isGlassPage ? 'mode-glass' : 'mode-solid' }}">
    <div class="bread-fluid-container">
        <ol class="bread-list-flex">
            
            <li class="bread-item">
                <a href="/" class="bread-link home-link">
                    <i class="fas fa-home"></i>
                    <span class="home-text">Beranda</span>
                </a>
            </li>

            @php $link = ""; @endphp

            @foreach($segments as $segment)
                @php 
                    $link .= "/" . $segment; 
                    $segmentLower = strtolower($segment);
                    $isDisabled = in_array($segmentLower, $disabledSegments);
                    
                    // Format Label: slug-name -> Slug Name
                    $label = ucwords(str_replace(['-', '_'], ' ', $segment));
                @endphp

                <li class="bread-sep">/</li>

                {{-- --- LOGIKA INJEKSI DINAMIS --- --}}

                {{-- BERITA: Jika user membuka detail-berita DAN berasal dari 'semua-berita' --}}
                @if($segment == 'detail-berita' && $originSource == 'semua-berita')
                    <li class="bread-item">
                        <a href="{{ url('/redaksi/berita/semua-berita') }}" class="bread-link">Semua Berita</a>
                    </li>
                    <li class="bread-sep">/</li>
                @endif

                {{-- EVENT: Jika user membuka detail-event DAN berasal dari halaman 'event-bulan-ini' --}}
                @if($segment == 'detail-event' && $originSource == 'event-bulan-ini')
                    <li class="bread-item">
                        <a href="{{ url('/kegiatan/event-bulan-ini') }}" class="bread-link">Event Bulan Ini</a>
                    </li>
                    <li class="bread-sep">/</li>

                {{-- EVENT: Jika user membuka detail-event DAN berasal dari halaman 'kalender-event' --}}
                @elseif($segment == 'detail-event' && $originSource == 'kalender-event')
                    <li class="bread-item">
                        <a href="{{ url('/kegiatan/kalender-event') }}" class="bread-link">Kalender Event</a>
                    </li>
                    <li class="bread-sep">/</li>
                @endif

                {{-- -------------------------------- --}}

                <li class="bread-item {{ $loop->last ? 'active-page' : '' }}">
                    @if($loop->last)
                        {{-- Halaman Aktif (Teks Saja) --}}
                        <span class="current-label">{{ $label }}</span>
                    @elseif($isDisabled)
                        {{-- Segmen Parent yang di-disable --}}
                        <span class="disabled-label">{{ $label }}</span>
                    @else
                        {{-- Link Normal --}}
                        <a href="{{ url($link) }}" class="bread-link">{{ $label }}</a>
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
</nav>
@endif    




    <main>
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>