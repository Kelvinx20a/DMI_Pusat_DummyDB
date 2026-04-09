@extends('layouts.app')
    @section('content')

    <section class="dmi-eco-social">
    <div class="container-custom">
        <div class="eco-layout-wrapper">
            
            <div class="eco-content js-reveal">
                <div class="badge-accent">Pilar Kesejahteraan</div>
                <h2 class="section-title-main">Pengembangan <span class="text-success">Ekonomi & Sosial</span></h2>
                <p class="eco-lead">Membangun kemandirian umat melalui pemberdayaan ekonomi berbasis masjid dan penguatan jaring pengaman sosial yang inklusif.</p>
                
                <div class="eco-features-list">
                    <div class="eco-item">
                        <div class="eco-dot"></div>
                        <div>
                            <h4>Pemberdayaan UMKM Masjid</h4>
                            <p>Pelatihan manajemen bisnis dan akses permodalan bagi jamaah melalui koperasi masjid.</p>
                        </div>
                    </div>
                    <div class="eco-item">
                        <div class="eco-dot"></div>
                        <div>
                            <h4>Ziswaf Terpadu</h4>
                            <p>Digitalisasi pengelolaan Zakat, Infaq, Shadaqah, dan Wakaf untuk distribusi yang lebih tepat sasaran.</p>
                        </div>
                    </div>
                </div>

                <div class="eco-stats">
                    <div class="stat-box">
                        <span class="stat-num">10K+</span>
                        <span class="stat-label">Masjid Mandiri</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-num">50%</span>
                        <span class="stat-label">Pertumbuhan UMKM</span>
                    </div>
                </div>
            </div>

            <div class="eco-visual-composition js-reveal">
                <div class="img-frame frame-top">
                    <img src="../img/proker/ekonomi/2.png" alt="Kegiatan Sosial Masjid">
                    <div class="frame-label">Program Takjil & Berbagi</div>
                </div>
                
                <div class="img-frame frame-bottom">
                    <img src="../img/proker/ekonomi/1.png" alt="Pendidikan Anak">
                    <div class="frame-label">Generasi Qurani</div>
                </div>

                <div class="eco-blob"></div>
            </div>

        </div>
    </div>
</section>

    <script src="{{ asset('js/proker.js') }}"></script>


    @endsection