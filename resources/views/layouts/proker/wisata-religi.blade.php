@extends('layouts.app')
    @section('content')

    <section class="religi-section">
    <div class="religi-container">
        <header class="religi-header">
            <span class="religi-tag">EKSPLORASI BUDAYA</span>
            <h1 class="religi-title">Wisata <span class="religi-gold">Religi</span></h1>
            <p class="religi-subtitle">Menelusuri jejak sejarah dan keagungan arsitektur Islam di nusantara.</p>
            <div class="religi-line"></div>
        </header>

        <div class="religi-grid">
            <article class="religi-card">
                <div class="religi-thumb">
                    <img src="../img/proker/wisata-religi/1.png" alt="Masjid Raya Baiturrahman Aceh" class="religi-img">
                    <div class="religi-meta">ACEH</div>
                </div>
                <div class="religi-content">
                    <h3 class="religi-name">Masjid Raya Baiturrahman</h3>
                    <p class="religi-text">Ikon kebanggaan Serambi Mekkah yang memadukan gaya arsitektur Mughal dengan kubah hitam megah, menjadi simbol keteguhan dan sejarah panjang Kesultanan Aceh.</p>
                    <div class="religi-specs">
                        <span><i class="fas fa-history"></i> Abad ke-19</span>
                        <span><i class="fas fa-map-marker-alt"></i> Banda Aceh</span>
                    </div>
                </div>
            </article>

            <article class="religi-card">
                <div class="religi-thumb">
                    <img src="../img/proker/wisata-religi/2.png" alt="Masjid Menara Kudus" class="religi-img">
                    <div class="religi-meta">JAWA TENGAH</div>
                </div>
                <div class="religi-content">
                    <h3 class="religi-name">Masjid Menara Kudus</h3>
                    <p class="religi-text">Sebuah mahakarya akulturasi budaya yang unik, menampilkan menara serupa candi Hindu yang melambangkan keharmonisan penyebaran Islam oleh Sunan Kudus.</p>
                    <div class="religi-specs">
                        <span><i class="fas fa-history"></i> Tahun 1549</span>
                        <span><i class="fas fa-map-marker-alt"></i> Kota Kudus</span>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

    @endsection