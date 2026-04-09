@extends('layouts.app')
    @section('content')

<section class="mrj-bento">
    <div class="mrj-container">
        
        <div class="mrj-header js-reveal">
            <span class="mrj-tag">Program Strategis DMI</span>
            <h2 class="mrj-title">Masjid Ramah <span>Jamaah</span></h2>
            <center>
            <div class="title-divider" style="margin-left: 0;"></div>
            </center>
        </div>

        <div class="mrj-grid">
            
            <div class="mrj-card card-featured js-reveal">
                <img src="../img/proker/orang-banyak.png" alt="Wakaf Kursi Sholat">
                <div class="mrj-overlay">
                    <div class="mrj-content">
                        <span class="mrj-badge">Prioritas Utama</span>
                        <h3>Wakaf Kursi Sholat</h3>
                        <p>Fasilitas kursi sholat khusus untuk memastikan jamaah lansia dan difabel tetap nyaman beribadah.</p>
                        <small>No. SK BWI: 3.300428</small>
                    </div>
                </div>
            </div>

            <div class="mrj-card js-reveal">
                <img src="../img/proker/sertifikat-tanah-wakaf/orang1.png" alt="Sertifikat Tanah">
                <div class="mrj-overlay">
                    <div class="mrj-content">
                        <h3>Legalitas Aset</h3>
                        <p>Sertifikasi tanah wakaf masjid.</p>
                    </div>
                </div>
            </div>

            <div class="mrj-card js-reveal">
                <img src="../img/proker/sertifikat-tanah-wakaf/orang2.png" alt="Pelatihan Keuangan">
                <div class="mrj-overlay">
                    <div class="mrj-content">
                        <h3>Manajemen Kas</h3>
                        <p>Tata kelola keuangan transparan.</p>
                    </div>
                </div>
            </div>

            <div class="mrj-card card-solid js-reveal">
                <div class="mrj-content">
                    <i class="fas fa-universal-access"></i>
                    <h3>Akses Inklusif</h3>
                    <p>Pembangunan Ramp & Guiding Block.</p>
                </div>
            </div>

            <div class="mrj-card card-solid dark last-card js-reveal">
                <div class="mrj-content">
                    <i class="fas fa-child"></i>
                    <h3>Ramah Keluarga</h3>
                    <p>Ruang laktasi & Playzone anak aman.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">

<script>
document.addEventListener("DOMContentLoaded", function() {
    const observerOptions = { threshold: 0.1 };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.js-reveal').forEach(el => observer.observe(el));
});
</script>

    @endsection