@extends('layouts.app')

@section('content')


<section class="dmi-training-section">
    <div class="container-custom">
        <div class="training-header js-reveal">
            <div class="badge-accent">Pusat Pendidikan & Pelatihan</div>
            <h2 class="section-title-main">Program Pelatihan <span class="text-success">Fungsi Kemasjidan</span></h2>
            <div class="title-divider" style="margin-left: 0;"></div>
        </div>

        <div class="training-grid-wrapper">
            <div class="training-visual js-reveal">
                <div class="main-training-card">
                    <img src="../img/proker/kemasjidan/1.png" alt="Pelatihan Manajemen Masjid">
                    <div class="training-overlay-info">
                        <h3>Pelatihan Manajemen Strategis Masjid</h3>
                        <p><i class="fas fa-map-marker-alt"></i> Pusat Pendidikan DMI, Jakarta</p>
                    </div>
                </div>
            </div>

            <div class="training-list">
                <div class="program-card js-reveal">
                    <div class="program-num">01</div>
                    <div class="program-desc">
                        <h4>Manajemen Idarah</h4>
                        <p>Penataan administrasi, organisasi, dan legalitas kepengurusan masjid yang akuntabel.</p>
                    </div>
            
                </div>

                <div class="program-card js-reveal">
                    <div class="program-num">02</div>
                    <div class="program-desc">
                        <h4>Manajemen Imarah</h4>
                        <p>Optimalisasi fungsi peribadatan, dakwah, dan kegiatan sosial kemasyarakatan.</p>
                    </div>
            
                </div>

                <div class="program-card js-reveal">
                    <div class="program-num">03</div>
                    <div class="program-desc">
                        <h4>Manajemen Riayah</h4>
                        <p>Pemeliharaan fisik, arsitektur, dan kebersihan lingkungan masjid yang berkelanjutan.</p>
                    </div>
            
                </div>
                
                <!-- <div class="training-cta-box js-reveal">
                    <button class="btn-main-download" style="width: 100%; border: none;">
                        Daftar Pelatihan Sekarang <i class="fas fa-paper-plane" style="margin-left:10px;"></i>
                    </button>
                </div> -->
            </div>
        </div>
    </div>
</section>

    <script src="{{ asset('js/proker.js') }}"></script>


@endsection