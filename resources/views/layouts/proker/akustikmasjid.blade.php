      <!-- Navbar -->
  @extends('layouts.app')
    @section('content')

<!-- hero section akustik masjid -->
@section('content')

<section class="editorial-detail-section">
    <div class="container-custom">
        <header class="editorial-header js-reveal">
            <div class="category-pill">WARTA MASJID</div>
            <h1 class="editorial-title">DMI Akan Tata Sistem Audio Masjid: Menuju Harmoni Suara Ibadah</h1>
            
            <div class="editorial-meta js-reveal">
                <div class="author-info">
                    <img src="{{ asset('../img/components/user.png') }}" alt="Muhammad Ibrahim" class="author-img">
                    <div class="author-text">
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

        <div class="editorial-grid">
            <div class="editorial-main-content">
                <div class="featured-image-wrapper js-reveal">
                    <img src="{{ asset('img/home/c2.jpg') }}" alt="Akustik Masjid" class="editorial-featured-img">
                </div>

                <div class="editorial-article-body">
                    <p class="lead-text js-reveal">
                        Pimpinan Pusat (PP) Dewan Masjid Indonesia (DMI) bekerja sama dengan Kementerian Agama RI akan menyelenggarakan Edukasi Singkat Penataan Akustik dan Sistem Audio Masjid pada Rabu mendatang.
                    </p>

                    <p>Kegiatan ini diselenggarakan oleh Departemen Kominfo PP DMI sebagai bagian dari Agenda <strong>Pra Muktamar VIII DMI</strong>. Acara ini akan berlangsung di Gedung DMI Pusat dan diikuti oleh 50 peserta Takmir Masjid wilayah Jabodetabek.</p>

                    <div class="editorial-quote js-reveal">
                        <p>"Penataan akustik masjid adalah kunci kenyamanan ibadah umat. DMI berkomitmen menghadirkan suara yang jernih di setiap masjid Indonesia."</p>
                    </div>

                    <h3>Fokus Pengembangan & Diskusi</h3>
                    <p>Sejumlah Diskusi Panel akan digelar dengan tema menarik, di antaranya:</p>
                    
                    <ul class="custom-list js-reveal">
                        <li><i class="fas fa-check-circle"></i> Penataan Akustik Masjid dan Penguatan Harmoni Umat.</li>
                        <li><i class="fas fa-check-circle"></i> Dasar-Dasar Sound System Masjid Modern.</li>
                        <li><i class="fas fa-check-circle"></i> Pengukuran Gaung dan Tingkat Kekerasan Suara.</li>
                        <li><i class="fas fa-check-circle"></i> Praktikum Merangkai Sound System (Hands-on).</li>
                    </ul>

                    <p>Acara akan dibuka oleh Sekretaris Jenderal PP DMI, Dr. H. Imam Addaruqutni, M.Ag., didampingi oleh Direktur Urais Kemenag RI.</p>
                </div>
            </div>

            <aside class="editorial-sidebar">
                <div class="sticky-sidebar">
                    <div class="sidebar-info-box js-reveal">
                        <h4 class="sidebar-title-small">Info Kegiatan</h4>
                        <div class="info-row">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Gedung DMI Pusat, Jakarta</span>
                        </div>
                        <div class="info-row">
                            <i class="fas fa-users"></i>
                            <span>50 Peserta Terpilih</span>
                        </div>
                        <div class="info-row">
                            <i class="fas fa-building"></i>
                            <span>Kerjasama Kemenag RI</span>
                        </div>
                    </div>

                    <div class="sidebar-next-article js-reveal">
                        <!-- <span class="label">Agenda Selanjutnya</span>
                        <a href="#" class="next-link">
                            Muktamar VIII DMI 2024 <i class="fas fa-arrow-right"></i>
                        </a> -->
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>




<!-- Preview PDF -->


@endsection