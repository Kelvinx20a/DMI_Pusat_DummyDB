
    
  <!-- Navbar -->
  @extends('layouts.app')
    @section('content')

<center>
<section class="dmi-work-section">
    <div class="container">
        
        <div class="program-wrapper js-reveal">
            <h2 class="dmi-title-center">Program Unggul DMI</h2>
            <div class="divider-title">-</div>
            
            <div class="dmi-main-grid">
                <div class="dmi-grid-item">
                    <div class="leaf-icon"><i class="fas fa-users-cog"></i></div>
                    <span>Penataan Organisasi Dengan Digitalisasi</span>
                </div>
                <div class="dmi-grid-item">
                    <div class="leaf-icon"><i class="fas fa-volume-up"></i></div>
                    <span>Akustik Masjid</span>
                </div>
                <div class="dmi-grid-item">
                    <div class="leaf-icon"><i class="fas fa-chart-line"></i></div>
                    <span>Pengembangan Ekonomi Dan Sosial</span>
                </div>
                <div class="dmi-grid-item">
                    <div class="leaf-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <span>Pelatihan Fungsi-Fungsi Kemasjidan</span>
                </div>
                <div class="dmi-grid-item">
                    <div class="leaf-icon"><i class="fas fa-leaf"></i></div>
                    <span>Lingkungan Hijau</span>
                </div>
                <div class="dmi-grid-item">
                    <div class="leaf-icon"><i class="fas fa-hand-holding-heart"></i></div>
                    <span>Masjid Ramah Jamaah</span>
                </div>
                <div class="dmi-grid-item">
                    <div class="leaf-icon"><i class="fas fa-broom"></i></div>
                    <span>Masjid Bersih Dan Sehat</span>
                </div>
                <div class="dmi-grid-item">
                    <div class="leaf-icon"><i class="fas fa-certificate"></i></div>
                    <span>Sertifikasi Tanah Wakaf</span>
                </div>
                <div class="dmi-grid-item">
                    <div class="leaf-icon"><i class="fas fa-book-open"></i></div>
                    <span>Pendidikan Dan Dakwah</span>
                </div>
                <div class="dmi-grid-item">
                    <div class="leaf-icon"><i class="fas fa-mosque"></i></div>
                    <span>Arsitektur Masjid</span>
                </div>
                <div class="dmi-grid-item">
                    <div class="leaf-icon"><i class="fas fa-map-marked-alt"></i></div>
                    <span>Wisata Religi</span>
                </div>
            </div>
        </div>
</section>
</center>

<br>
<br>

<section class="dmi-proses-section py-5 js-reveal">
    <div class="container">
        <h2 class="dmi-title-center2 fw-bold mb-5">Proses Penyusunan Program Kerja</h2>
        
        <center>
            <div class="divider-title"></div>
        </center>
        
        <div class="workflow-wrapper">
            <div class="wf-row row-top">
                <div class="wf-item">
                    <div class="wf-card">
                        <div class="wf-icon-circle"><i class="fas fa-file-alt"></i></div>
                        <p>Program Kerja Lama</p>
                    </div>
                </div>
                <div class="wf-arrow"></div>
                <div class="wf-item">
                    <div class="wf-card">
                        <div class="wf-icon-circle"><i class="fas fa-lightbulb"></i></div>
                        <p>Ide Dari Bidang & Departemen</p>
                    </div>
                </div>
                <div class="wf-arrow"></div>
                <div class="wf-item">
                    <div class="wf-card">
                        <div class="wf-icon-circle"><i class="fas fa-edit"></i></div>
                        <p>Draft Program Kerja 2024-2029</p>
                    </div>
                </div>
            </div>

            <div class="wf-vertical-line"></div>

            <div class="wf-row row-bottom">
                <div class="wf-item">
                    <div class="wf-card green-active">
                        <div class="wf-icon-circle"><i class="fas fa-check-double"></i></div>
                        <p>Sebelas Program Unggul</p>
                    </div>
                </div>
                <div class="wf-arrow arrow-left"></div>
                <div class="wf-meeting-badge">
                    <span>6,5 Bulan Dan Puluhan Meeting</span>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <p class="text-muted small">Unduh file untuk lihat lebih lengkap program kerja DMI</p>
            <a href="{{ asset('asset/pdf/Program-Kerja-DMI-2024-2029.pdf') }}" class="btn-dmi-primary" download>
                <i class="fas fa-cloud-download-alt"></i> Unduh Dokumen Lengkap (PDF)
            </a>
        </div>
    </div>
</section>























<!-- Preview PDF -->
<!-- <section class="program-detail-section">
    <div class="container-custom">
        <div class="main-layout-wrapper">
            
            <div class="content-main">
                <div class="master-card">
                    
                    <div class="master-card__header">
                        <span class="category-tag">DOKUMEN RESMI</span>
                        <h2 class="section-title-main">Program Kerja Dewan Masjid Indonesia</h2>
                        <div class="title-divider"></div>
                    </div>

                    <div class="preview-area">
                        <div id="pdf-loader" class="pdf-loader">
                            <div class="spinner"></div>
                            <p>Memuat Dokumen...</p>
                        </div>
                        
                        <iframe 
                            id="pdf-iframe"
                            src="{{ asset('vendor/pdfjs/web/viewer.html') }}?file={{ asset('asset/pdf/Program-Kerja-DMI-2024-2029.pdf') }}" 
                            width="100%" 
                            height="100%" 
                            style="border: none;"
                            onload="hideLoader()">
                        </iframe>
                    </div>

                    <div class="file-info-grid">
                        <div class="info-item">
                            <div class="info-label"><i class="fas fa-file-download"></i> Total Download</div>
                            <div class="info-value">4 Kali</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label"><i class="fas fa-weight-hanging"></i> Ukuran File</div>
                            <div class="info-value">1.64 MB</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label"><i class="fas fa-calendar-alt"></i> Tanggal Rilis</div>
                            <div class="info-value">15 Agustus 2025</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label"><i class="fas fa-sync-alt"></i> Pembaruan</div>
                            <div class="info-value">15 Agustus 2025</div>
                        </div>
                    </div>

                    <div class="action-footer">
                        <a href="{{ asset('asset/pdf/Program-Kerja-DMI-2024-2029.pdf') }}" class="btn-main-download" download>
                            <i class="fas fa-cloud-download-alt"></i> Unduh Dokumen Lengkap (PDF)
                        </a>
                    </div>
                </div>
            </div>

            <div class="content-sidebar">
                <div class="sidebar-widget">
                    <div class="widget-header">
                        <h3>Berita Terbaru</h3>
                        <div class="line-accent"></div>
                    </div>
                    <div class="news-feed">
                        @for ($i = 0; $i < 7; $i++)
                        <a href="#" class="news-card-mini">
                            <div class="news-thumb"></div>
                            <div class="news-brief">
                                <div class="news-line long"></div>
                                <div class="news-line short"></div>
                            </div>
                        </a>
                        @endfor
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    function hideLoader() {
        document.getElementById('pdf-loader').style.opacity = '0';
        setTimeout(() => {
            document.getElementById('pdf-loader').style.display = 'none';
        }, 500);
    }
</script> -->

@endsection