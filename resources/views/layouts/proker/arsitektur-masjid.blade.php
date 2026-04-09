@extends('layouts.app')
    @section('content')

    <section class="dmi-arch-section">
    <div class="arch-container">
        
        <header class="arch-main-header">
            <div class="arch-tag">LAPORAN DIVISI PEMBANGUNAN</div>
            <h1 class="arch-title">Arsitektur <span class="arch-highlight">Masjid DMI</span></h1>
            <div class="arch-divider"></div>
        </header>

        <article class="arch-project-card">
            <div class="arch-visual">
                <img src="../img/proker/arsitektur-masjid/2.png" alt="Visual Arsitektur Masjid Modern" class="arch-img">
                <div class="arch-label">Visi Desain</div>
            </div>
            <div class="arch-info">
                <h2 class="arch-sub-title">Visi Rancang Bangun</h2>
                <p class="arch-desc">
                    Pengembangan desain masjid dengan pendekatan arsitektur kontemporer yang mengedepankan estetika geometris, sirkulasi udara alami, dan sistem pencahayaan efisien demi menciptakan kenyamanan ibadah yang maksimal bagi umat.
                </p>
                <div class="arch-spec">
                    <div class="arch-spec-item">
                        <strong>Tipe Desain</strong>
                        <span>Kontemporer Minimalis</span>
                    </div>
                    <div class="arch-spec-item">
                        <strong>Fokus Utama</strong>
                        <span>Efisiensi Energi</span>
                    </div>
                </div>
            </div>
        </article>

        <article class="arch-project-card arch-reverse">
            <div class="arch-visual">
                <img src="../img/proker/arsitektur-masjid/1.png" alt="Pembangunan Masjid DMI di Gaza" class="arch-img">
                <div class="arch-label">Kemanusiaan</div>
            </div>
            <div class="arch-info">
                <h2 class="arch-sub-title">Masjid Semi Permanen Gaza</h2>
                <p class="arch-desc">
                    Dewan Masjid Indonesia (DMI) secara konsisten menjalankan misi kemanusiaan melalui penyelesaian pembangunan masjid semi permanen kedua di Jalur Gaza. Fasilitas ini hadir sebagai simbol solidaritas sekaligus pusat ibadah bagi warga di wilayah terdampak konflik.
                </p>
                <div class="arch-spec">
                    <div class="arch-spec-item">
                        <strong>Lokasi</strong>
                        <span>Jalur Gaza, Palestina</span>
                    </div>
                    <div class="arch-spec-item">
                        <strong>Status</strong>
                        <span>Unit Kedua Selesai</span>
                    </div>
                </div>
            </div>
        </article>

    </div>
</section>

    @endsection