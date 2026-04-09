@extends('layouts.app')
    @section('content')


    <section class="dmi-modern-org">
    <div class="container-custom">
        <div class="org-intro js-reveal">
            <div class="badge-accent">Penataan Organisasi</div>
            <h2 class="section-title-main">Transformasi Tata Kelola <span class="text-success">DMI</span></h2>
            
            <center>
                <div class="title-divider"></div>
            </center>
        </div>

        <div class="org-bento-grid">
            <div class="bento-item main-feat js-reveal">
                <img src="../img/proker/organisasi/1.png" alt="Ketua Umum DMI">
                <div class="bento-caption">
                    <span class="tag">Kepemimpinan</span>
                    <h4>H. Muhammad Jusuf Kalla</h4>
                    <p>Mengarahkan visi masjid sebagai pusat peradaban.</p>
                </div>
            </div>

            <div class="bento-item wide-feat js-reveal">
                <img src="../img/proker/organisasi/2.png" alt="Muktamar DMI">
                <div class="bento-caption">
                    <span class="tag">Muktamar VIII</span>
                    <h4>Konsolidasi Nasional</h4>
                </div>
            </div>

            <div class="bento-item tall-feat js-reveal">
                <img src="../img/proker/organisasi/3.png" alt="Digitalisasi">
                <div class="bento-caption">
                    <span class="tag">Inovasi</span>
                    <h4>Digitalisasi Budaya</h4>
                </div>
            </div>
        </div>

        <div class="org-features-row">
            <div class="feat-card js-reveal">
                <div class="feat-icon"><i class="fas fa-microchip"></i></div>
                <h3>Sistem Terintegrasi</h3>
                <p>Manajemen masjid berbasis IT untuk transparansi umat.</p>
            </div>
            <div class="feat-card js-reveal">
                <div class="feat-icon"><i class="fas fa-hand-holding-heart"></i></div>
                <h3>Kemandirian Ekonomi</h3>
                <p>Pemberdayaan berbasis jamaah di seluruh ranting.</p>
            </div>
            
            <div class="feat-card js-reveal card-akhir">
                <div class="feat-icon"><i class="fas fa-shield-alt"></i></div>
                <h3>Keamanan Siber</h3>
                <p>Proteksi data organisasi dalam transformasi digital.</p>
            </div>
        </div>
    </div>
</section>


    <script src="{{ asset('js/proker.js') }}"></script>


    @endsection