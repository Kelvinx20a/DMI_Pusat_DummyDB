 <link rel="stylesheet" href="{{ asset('css/redaksi.css') }}">

  @extends('layouts.app')
    @section('content')

        <section class="news-detail-section">
    <div class="reading-progress-container">
        <div class="progress-bar" id="readingBar"></div>
    </div>

    <div class="container">
        <div class="news-grid">
            
            <article class="news-main-content">
                <header class="news-header js-reveal">
                    <nav class="breadcrumb">Berita &bull; {{ $post->frontend_category }}</nav>
                    <h1 class="news-title">{{ $post->post_title }}</h1>
                    <div class="editorial-meta js-reveal">
                        <div class="author-info">
                        <img src="{{ asset('../img/components/user.png') }}" alt="Muhammad Ibrahim" class="author-img">
                    <div class="author-text js-reveal">
                        <span class="name">{{ $post->frontend_author }}</span>
                        <span class="date">{{ \Carbon\Carbon::parse($post->post_date)->translatedFormat('d F Y') }} • {{ $post->frontend_reading_time }} mnt baca</span>
                    </div>
                </div>
                <div class="editorial-actions js-reveal">
                    <button class="btn-icon-circle"><i class="far fa-bookmark"></i></button>
                    <button class="btn-icon-circle"><i class="fas fa-share-alt"></i></button>
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
    // 1. Progress Bar Logic
window.onscroll = function() { updateReadingProgress() };

function updateReadingProgress() {
    let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    let scrolled = (winScroll / height) * 100;
    document.getElementById("readingBar").style.width = scrolled + "%";
}

// 2. Smooth Scroll Reveal (Jika Anda sudah punya sistem js-reveal)
const observerOptions = { threshold: 0.1 };
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('reveal-active');
        }
    });
}, observerOptions);

document.querySelectorAll('.js-reveal').forEach(el => observer.observe(el));
</script>
    @endsection
