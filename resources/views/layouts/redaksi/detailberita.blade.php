@extends('layouts.app')

@section('title', ($post->post_title ?? 'Berita') . ' - ' . ($settings['site.name'] ?? 'DMI'))
@section('description', $post->frontend_excerpt ?? 'Berita terbaru dari Dewan Masjid Indonesia.')
@section('canonical', $post->frontend_url ?? url()->current())

@push('meta')
<meta property="og:title" content="{{ $post->post_title }} - DMI">
<meta property="og:description" content="{{ $post->frontend_excerpt }}">
<meta property="og:url" content="{{ $post->frontend_url }}">
<meta property="og:type" content="article">
<meta property="og:site_name" content="{{ $settings['site.name'] ?? 'DMI - Dewan Masjid Indonesia' }}">
<meta property="og:image" content="{{ $post->frontend_image }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $post->post_title }} - DMI">
<meta name="twitter:description" content="{{ $post->frontend_excerpt }}">
<meta name="twitter:image" content="{{ $post->frontend_image }}">
@php
    $ldJson = [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $post->post_title,
        'description' => $post->frontend_excerpt,
        'image' => $post->frontend_image,
        'author' => [
            '@type' => 'Person',
            'name' => $post->frontend_author,
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => $settings['site.name'] ?? 'Dewan Masjid Indonesia',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset($settings['site.logo'] ?? 'admin-assets/img/logo dmi.png'),
            ],
        ],
        'datePublished' => $post->post_date,
        'dateModified' => $post->post_modified ?? $post->post_date,
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => $post->frontend_url,
        ],
    ];
@endphp
<script type="application/ld+json">@json($ldJson, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
@endpush

@section('content')
<link rel="stylesheet" href="{{ asset('css/redaksi.css') }}">

        <section class="news-detail-section">
    <div class="reading-progress-container">
        <div class="progress-bar" id="readingBar"></div>
    </div>

    <div class="container">
        <div class="news-grid">
            
            <article class="news-main-content">
                <header class="news-header js-reveal">
                    <nav class="breadcrumb">{{ $post->frontend_category }}</nav>
                    <h1 class="news-title">{{ $post->post_title }}</h1>
                    <div class="editorial-meta js-reveal">
                        <div class="author-info">
                        <img src="{{ asset('../img/components/user.png') }}" alt="{{ $post->frontend_author }}" class="author-img">
                    <div class="author-text js-reveal">
                        <span class="name">{{ $post->frontend_author }}</span>
                        <span class="date">{{ $post->frontend_reading_time }} mnt baca</span>
                    </div>
                </div>
                <div class="editorial-actions js-reveal">
                    <button class="btn-icon-circle" id="btnBookmark" title="Simpan ke Bookmark"><i class="far fa-bookmark"></i></button>
                    <button class="btn-icon-circle" id="btnShare" title="Bagikan"><i class="fas fa-share-alt"></i></button>
                </div>
            </div>
                </header>

                <div class="news-featured-image js-reveal">
                    <img src="{{ $post->frontend_image }}" alt="{{ $post->post_title }}">
                    @if($post->post_excerpt)
                        <p class="caption">{{ $post->post_excerpt }}</p>
                    @endif
                </div>

                <div class="news-body-text js-reveal">
                    {!! $post->post_content !!}
                </div>

                <footer class="news-tags js-reveal">
                    @foreach($post->frontend_tags as $tag)
                        <a href="{{ route('redaksi.berita.semua', ['search' => $tag]) }}" class="tag">{{ $tag }}</a>
                    @endforeach
                </footer>
            </article>

    <aside class="news-sidebar js-reveal">
        <div class="sticky-sidebar">
            
            <div class="sidebar-section">
                <h3 class="section-heading">Berita Terpopuler</h3>
                <div class="popular-cards">
                    @foreach($popularPosts->take(3) as $popular)
                        <a href="{{ $popular->frontend_url }}" class="pop-card">
                            <div class="pop-card-img">
                                <img src="{{ $popular->frontend_image }}" alt="{{ $popular->post_title }}">
                            </div>
                            <div class="pop-card-content">
                                <span class="category">{{ $popular->frontend_category }}</span>
                                <h4>{{ $popular->post_title }}</h4>
                                <span class="date">{{ \Carbon\Carbon::parse($popular->post_date)->translatedFormat('d F Y') }}</span>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </aside>

        </div>
    </div>

</section>
<script>








// Progress Bar
window.onscroll = function() {
    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    document.getElementById("readingBar").style.width = (winScroll / height) * 100 + "%";
};

// Toast
function showToast(msg, icon) {
    var t = document.getElementById('dmi-toast');
    if (!t) {
        t = document.createElement('div');
        t.id = 'dmi-toast';
        t.style.cssText = 'position:fixed;bottom:30px;left:50%;transform:translateX(-50%) translateY(20px);background:#1e293b;color:#fff;padding:14px 28px;border-radius:12px;font-size:14px;font-weight:600;z-index:10001;opacity:0;transition:all 0.3s ease;box-shadow:0 10px 30px rgba(0,0,0,0.2);display:flex;align-items:center;gap:10px;';
        document.body.appendChild(t);
    }
    t.innerHTML = (icon ? '<i class="'+icon+'" style="color:#4ade80;"></i> ' : '') + msg;
    t.style.opacity = '1';
    t.style.transform = 'translateX(-50%) translateY(0)';
    clearTimeout(t._timer);
    t._timer = setTimeout(function() { t.style.opacity = '0'; t.style.transform = 'translateX(-50%) translateY(20px)'; }, 2500);
}

// Bookmark - simpan ke bookmark browser via keyboard shortcut
document.getElementById('btnBookmark').addEventListener('click', function() {
    var btn = this;
    // Trigger browser bookmark dialog
    if (window.sidebar && window.sidebar.addPanel) {
        window.sidebar.addPanel(document.title, window.location.href, '');
        showToast('Berhasil disimpan ke bookmark!', 'fas fa-check-circle');
    } else if (window.external && ('AddFavorite' in window.external)) {
        window.external.AddFavorite(window.location.href, document.title);
        showToast('Berhasil disimpan ke bookmark!', 'fas fa-check-circle');
    } else {
        // Modern browsers: trigger Ctrl+D
        var isMac = navigator.userAgent.toLowerCase().indexOf('mac') !== -1;
        try {
            var evt = new KeyboardEvent('keydown', { key: 'd', code: 'KeyD', ctrlKey: !isMac, metaKey: isMac, bubbles: true });
            document.dispatchEvent(evt);
        } catch(e) {}
        showToast('Berhasil disimpan ke bookmark!', 'fas fa-check-circle');
    }
    // Visual feedback on button
    btn.innerHTML = '<i class="fas fa-bookmark"></i>';
    btn.style.background = '#2E7D32';
    btn.style.color = '#fff';
    btn.style.borderColor = '#2E7D32';
});

// Scroll Reveal
var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) { if (entry.isIntersecting) entry.target.classList.add('reveal-active'); });
}, { threshold: 0.1 });
document.querySelectorAll('.js-reveal').forEach(function(el) { observer.observe(el); });
</script>




{{-- =============================================
     SHARE MODAL — Tambahkan sebelum @endsection
     ============================================= --}}

{{-- Modal HTML --}}
<div class="share-overlay" id="shareOverlay" role="dialog" aria-modal="true" aria-label="Bagikan Artikel">
    <div class="share-modal">

        <div class="share-modal__header">
            <div>
                <span class="share-modal__subtitle">Bagikan Artikel</span>
                <p class="share-modal__title">{{ $post->post_title }}</p>
            </div>
            <button class="share-modal__close" id="shareClose" aria-label="Tutup">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="share-modal__divider"></div>

        <div class="share-platforms">

            {{-- WhatsApp --}}
            <a href="#" class="share-btn share-btn--wa" id="shareWa" target="_blank" rel="noopener">
                <div class="share-btn__icon">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <span class="share-btn__label">WhatsApp</span>
            </a>

            {{-- Facebook --}}
            <a href="#" class="share-btn share-btn--fb" id="shareFb" target="_blank" rel="noopener">
                <div class="share-btn__icon">
                    <i class="fab fa-facebook-f"></i>
                </div>
                <span class="share-btn__label">Facebook</span>
            </a>

            {{-- X / Twitter --}}
            <a href="#" class="share-btn share-btn--tw" id="shareTw" target="_blank" rel="noopener">
                <div class="share-btn__icon">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </div>
                <span class="share-btn__label">X (Twitter)</span>
            </a>

            {{-- Instagram --}}
            <a href="#" class="share-btn share-btn--ig" id="shareIg" target="_blank" rel="noopener">
                <div class="share-btn__icon">
                    <i class="fab fa-instagram"></i>
                </div>
                <span class="share-btn__label">Instagram</span>
            </a>

            {{-- LinkedIn --}}
            <a href="#" class="share-btn share-btn--li" id="shareLi" target="_blank" rel="noopener">
                <div class="share-btn__icon">
                    <i class="fab fa-linkedin-in"></i>
                </div>
                <span class="share-btn__label">LinkedIn</span>
            </a>

            {{-- Telegram --}}
            <a href="#" class="share-btn share-btn--tele" id="shareTele" target="_blank" rel="noopener">
                <div class="share-btn__icon">
                    <i class="fab fa-telegram-plane"></i>
                </div>
                <span class="share-btn__label">Telegram</span>
            </a>

            {{-- Line --}}
            <a href="#" class="share-btn share-btn--line" id="shareLine" target="_blank" rel="noopener">
                <div class="share-btn__icon">
                    <i class="fab fa-line"></i>
                </div>
                <span class="share-btn__label">Line</span>
            </a>

            {{-- Copy Link --}}
            <button class="share-btn share-btn--copy" id="shareCopyBtn">
                <div class="share-btn__icon">
                    <i class="fas fa-link"></i>
                </div>
                <span class="share-btn__label">Salin Link</span>
            </button>

        </div>

        {{-- URL Input + Copy --}}
        <div class="share-url-box">
            <input type="text" id="shareUrlInput" readonly>
            <button class="share-url-copy" id="shareUrlCopyBtn">Salin</button>
        </div>

        <div class="share-toast" id="shareToast">✓ Link berhasil disalin!</div>
    </div>
</div>

{{-- Script --}}
<script>
(function () {
    var overlay   = document.getElementById('shareOverlay');
    var closeBtn  = document.getElementById('shareClose');
    var urlInput  = document.getElementById('shareUrlInput');
    var urlCopy   = document.getElementById('shareUrlCopyBtn');
    var copyBtn   = document.getElementById('shareCopyBtn');
    var toast     = document.getElementById('shareToast');
    var pageUrl   = window.location.href;
    var pageTitle = document.title;

    // Isi input URL
    urlInput.value = pageUrl;

    // ---- Fungsi Buka / Tutup ----
    function openShare() {
        overlay.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function closeShare() {
        overlay.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    // Tombol Share di artikel
    var btnShare = document.getElementById('btnShare');
    if (btnShare) btnShare.addEventListener('click', openShare);

    closeBtn.addEventListener('click', closeShare);

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeShare();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeShare();
    });

    // ---- Set URL platform setelah modal terbuka ----
    function buildLinks() {
        var enc = encodeURIComponent(pageUrl);
        var encTitle = encodeURIComponent(pageTitle);

        document.getElementById('shareWa').href    = 'https://wa.me/?text=' + encTitle + '%20' + enc;
        document.getElementById('shareFb').href    = 'https://www.facebook.com/sharer/sharer.php?u=' + enc;
        document.getElementById('shareTw').href    = 'https://twitter.com/intent/tweet?url=' + enc + '&text=' + encTitle;
        document.getElementById('shareLi').href    = 'https://www.linkedin.com/shareArticle?mini=true&url=' + enc + '&title=' + encTitle;
        document.getElementById('shareTele').href  = 'https://t.me/share/url?url=' + enc + '&text=' + encTitle;
        document.getElementById('shareLine').href  = 'https://social-plugins.line.me/lineit/share?url=' + enc;
        // Instagram tidak punya share link langsung; buka profil atau stories
        document.getElementById('shareIg').href    = 'https://www.instagram.com/';
    }
    buildLinks();

    // ---- Copy Link ----
    function doCopy() {
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(pageUrl).then(showCopied);
        } else {
            urlInput.select();
            document.execCommand('copy');
            showCopied();
        }
    }

    function showCopied() {
        urlCopy.textContent = '✓ Tersalin';
        urlCopy.classList.add('copied');
        toast.classList.add('show');
        setTimeout(function () {
            urlCopy.textContent = 'Salin';
            urlCopy.classList.remove('copied');
            toast.classList.remove('show');
        }, 2200);
    }

    urlCopy.addEventListener('click', doCopy);
    copyBtn.addEventListener('click', doCopy);
})();
</script>

    @endsection
