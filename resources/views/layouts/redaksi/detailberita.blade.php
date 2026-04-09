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
                    <nav class="breadcrumb">Berita &bull; Program Masjid</nav>
                    <h1 class="news-title">Program Penataan Akustik Masjid: Meningkatkan Kualitas Ibadah Melalui Suara</h1>
                    <div class="editorial-meta js-reveal">
                        <div class="author-info">
                        <img src="{{ asset('../img/components/user.png') }}" alt="Muhammad Ibrahim" class="author-img">
                    <div class="author-text js-reveal">
                        <span class="name">Muhammad Ibrahim Hamdani</span>
                        <span class="date">21 Februari 2024 • 5 mnt baca</span>
                    </div>
                </div>
                <div class="editorial-actions js-reveal">
                    <button class="btn-icon-circle"><i class="far fa-bookmark"></i></button>
                    <button class="btn-icon-circle"><i class="fas fa-share-alt"></i></button>
                </div>
            </div>
                </header>

                <div class="news-featured-image js-reveal">
                    <img src="https://picsum.photos/id/1018/1200/800" alt="Penataan Akustik Masjid">
                    <p class="caption">Dokumentasi kegiatan edukasi singkat penataan akustik di Gedung DMI Pusat.</p>
                </div>

                <div class="news-body-text js-reveal">
                    <p><strong>JAKARTA</strong> - Pimpinan Pusat (PP) Dewan Masjid Indonesia (DMI) bekerja sama dengan Direktorat Urusan Agama Islam dan Pembinaan Syariah Kementerian Agama menggelar program edukasi penataan akustik.</p>
                    
                    <p>Kegiatan ini merupakan bagian dari agenda pra-Muktamar VIII DMI. Fokus utama adalah memberikan pelatihan bagi 50 peserta takmir masjid dari wilayah Jabodetabek agar sistem audio masjid menjadi lebih jernih dan informatif.</p>
                    
                    <blockquote>
                        "Penataan akustik bukan sekadar teknis, tapi tentang kenyamanan jamaah dalam menyerap pesan-pesan kebaikan."
                    </blockquote>

                    <p>Acara ini resmi dibuka oleh Sekretaris Jenderal PP DMI, Dr. H. Imam Addaruqutni, M.Ag. Beliau menekankan pentingnya infrastruktur audio dalam mendukung syiar Islam di era modern.</p>
                </div>

                <footer class="news-tags js-reveal">
                    <a href="#" class="tag">DMI</a>
                    <a href="#" class="tag">Masjid</a>
                    <a href="#" class="tag">Akustik</a>
                    <a href="#" class="tag">Edukasi</a>
                </footer>
            </article>

    <aside class="news-sidebar js-reveal">
        <div class="sticky-sidebar">
            
            <div class="sidebar-section">
                <h3 class="section-heading">Berita Terpopuler</h3>
                <div class="popular-cards">
                    
                    <a href="#" class="pop-card">
                        <div class="pop-card-img">
                            <img src="https://picsum.photos/id/1015/200/200" alt="News">
                        </div>
                        <div class="pop-card-content">
                            <span class="category">Infrastruktur</span>
                            <h4>Edukasi Singkat Penataan Akustik Masjid Jabodetabek</h4>
                            <span class="date">11 Maret 2026</span>
                        </div>
                    </a>

                    <a href="#" class="pop-card">
                        <div class="pop-card-img">
                            <img src="https://picsum.photos/id/1016/200/200" alt="News">
                        </div>
                        <div class="pop-card-content">
                            <span class="category">Keuangan</span>
                            <h4>Optimalisasi Zakat Digital untuk Kemakmuran Jamaah</h4>
                            <span class="date">09 Maret 2026</span>
                        </div>
                    </a>

                    <a href="#" class="pop-card">
                        <div class="pop-card-img">
                            <img src="https://picsum.photos/id/1019/200/200" alt="News">
                        </div>
                        <div class="pop-card-content">
                            <span class="category">Sosial</span>
                            <h4>Penyaluran Bantuan Air Bersih melalui Jaringan DMI</h4>
                            <span class="date">08 Maret 2026</span>
                        </div>
                    </a>

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