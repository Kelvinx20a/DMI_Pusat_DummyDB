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
     * LOGIKA BREADCRUMB - DMI MASTER
     * ---------------------------------------------------------
     * Mode Glass: Transparan, cocok untuk halaman index/kategori dengan Hero Banner.
     * Mode Solid: Putih pekat, untuk halaman detail atau halaman tanpa banner.
     */
    
    $isGlassPage = false; 
    $segments = request()->segments();
    $segmentCount = count($segments);

    if(!Request::is('/')) {
        // 1. DAFTAR PARENT: Route utama yang diizinkan menggunakan Mode Glass
        // Tambahkan 'redaksi' agar /redaksi/berita bisa jadi glass
        $glassRoutes = ['tentang-kami' ]; 
        
        $firstSegment = request()->segment(1);

        // Cek apakah segmen pertama ada di daftar glassRoutes
        if (in_array($firstSegment, $glassRoutes)) {
            // Default awal kita set Glass
            $isGlassPage = true;

            // 2. DAFTAR PENGECUALIAN: Kata kunci yang HARUS Solid (Misal halaman baca)
            $excludeToSolid = ['detail-berita', 'pengurus', 'artikel', 'lihat']; 

            // Cek jika ada kata kunci pengecualian di URL
            $hasExcludeKeyword = count(array_intersect($segments, $excludeToSolid)) > 0;
            
            /**
             * LOGIKA PENYARINGAN AKHIR:
             * Jika ada kata kunci pengecualian ATAU level URL terlalu dalam (> 2)
             * Contoh: 
             * /berita (1 segmen) -> GLASS
             * /redaksi/berita (2 segmen) -> GLASS
             * /redaksi/berita/judul-post (3 segmen) -> SOLID (Otomatis)
             */
            if ($hasExcludeKeyword || $segmentCount > 2) {
                $isGlassPage = false;
            }
        }
    }

    // Segmen yang labelnya tidak bisa diklik (hanya teks)
    $disabledSegments = ['program-kerja', 'tentang-kami', 'kegiatan', 'redaksi']; 
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
                    
                    // Cek apakah segmen ini masuk daftar disabled (tidak bisa diklik)
                    $isDisabled = in_array($segmentLower, $disabledSegments);
                    
                    // Format teks (slug-name jadi Slug Name)
                    $label = ucwords(str_replace(['-', '_'], ' ', $segment));
                    
                    // Logika khusus Detail Event (Session Based)
                    $isDetailEvent = ($segment == 'detail-event');
                    $origin = session('event_origin');
                @endphp

                <li class="bread-sep">/</li>

                @if($isDetailEvent && $origin)
                    <li class="bread-item">
                        <a href="{{ $origin['url'] }}" class="bread-link">{{ $origin['label'] }}</a>
                    </li>
                    <li class="bread-sep">/</li>
                @endif

                <li class="bread-item {{ $loop->last ? 'active-page' : '' }}">
                    @if($loop->last)
                        {{-- Label Halaman Aktif --}}
                        <span class="current-label">{{ $label }}</span>
                    @elseif($isDisabled)
                        {{-- Label yang tidak bisa diklik --}}
                        <span class="disabled-label">{{ $label }}</span>
                    @else
                        {{-- Link Biasa --}}
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