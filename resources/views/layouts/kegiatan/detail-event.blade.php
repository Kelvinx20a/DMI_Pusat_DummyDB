    <link rel="stylesheet" href="{{ asset('css/kegiatan.css') }}">
 
 
 @extends('layouts.app')
    @section('content')
    

<section class="single-event-page">
    <div class="det-ev-main-wrapper">
        
        <header class="ev-header-area">
            <div class="ev-meta-top">
                <span class="ev-category">International Gathering</span>
                <span class="ev-dot"></span>
                <span class="ev-status-text"><i class="fas fa-circle" style="font-size: 8px;"></i> Akan Datang</span>
            </div>
            <h1 class="ev-main-headline">Grand Islamic Gathering with Chicago Imams: Strengthening the Global Ummah</h1>
        </header>

        <div class="ev-content-grid">
            
            <div class="ev-visual-narasi">
                <div class="ev-featured-image">
                    <img src="https://picsum.photos/id/1018/1200/600" alt="Event Banner">
                </div>

                <div class="ev-description">
                    <h3 class="ev-sub-title">Tentang Kegiatan</h3>
                    <p class="ev-paragraph-lead">
                        Acara ini dirancang untuk mempererat ukhuwah islamiyah global dengan menghadirkan perspektif dakwah dari para Imam di Amerika Serikat.
                    </p>
                    <p>
                        Etiam Vitae Leo Et Diam Pellentesque Porta. Sed Eleifend Ultricies Risus, Vel Rutrum Erat Commodo Ut. Praesent Finibus Congue Euismod. Nullam Scelerisque Massa Vel Augue Placerat, A Tempor Sem Egestas. Curabitur Placerat Finibus Lacus. Quisque At Vehicula Magna, Quis Fringilla Sapien.
                    </p>
                    <p>
                        Sed Sollicitudin Justo Ut Libero Viverra, Sed Efficitur Erat Finibus. Mauris Nunc Neque, Elementum Id Dignissim Ut, Posuere Sit Amet Dolor. Aliquam Turpis Neque, Mollis Eu Pharetra Et, Placerat Et Arcu.
                    </p>
                </div>
            </div>

            <aside class="ev-info-sidebar">
                <div class="ev-sticky-card">
                    <div class="ev-card-header">
                        <h4>Detail Informasi</h4>
                        <div class="header-line"></div>
                    </div>
                    
                    <div class="ev-detail-list">
                        <div class="ev-detail-item">
                            <div class="ev-icon"><i class="far fa-calendar-check"></i></div>
                            <div class="ev-text-group">
                                <label>Waktu Pelaksanaan</label>
                                <span class="primary-info">Senin, 07 Jan 2026</span>
                                <span class="secondary-info">11:59 — 15:30 WIB</span>
                            </div>
                        </div>

                        <div class="ev-detail-item">
                            <div class="ev-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="ev-text-group">
                                <label>Lokasi / Tempat</label>
                                <span class="primary-info">Masjid Agung Al-Matraman</span>
                                <p class="address-info">Jl. Matraman Raya No.39-41, Jakarta Timur, DKI Jakarta</p>
                            </div>
                        </div>

                        <div class="ev-detail-item">
                            <div class="ev-icon"><i class="fas fa-id-badge"></i></div>
                            <div class="ev-text-group">
                                <label>Penyelenggara</label>
                                <span class="primary-info">Adiba Beyse</span>
                                <span class="secondary-info">Panitia DMI Pusat</span>
                            </div>
                        </div>

                        <div class="ev-detail-item">
                            <div class="ev-icon"><i class="fas fa-headset"></i></div>
                            <div class="ev-text-group">
                                <label>Kontak Informasi</label>
                                <span class="primary-info">+62 800 1234 567</span>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</section>
    


    @endsection