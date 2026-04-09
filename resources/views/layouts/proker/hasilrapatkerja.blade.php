      <!-- Navbar -->
  @extends('layouts.app')
    @section('content')

  <!-- breadcrumbs -->


<!-- end bread-crumbs -->

<!-- Preview PDF -->
<section class="program-detail-section">
    <div class="container-custom">
        <div class="main-layout-wrapper">
            
            <div class="content-main">
                <div class="master-card">
                    
                    <div class="master-card__header js-reveal">
                        <span class="category-tag">DOKUMEN RESMI</span>
                        <h2 class="section-title-main">Hasil Rapat Kerja Nasional 2025</h2>
                        <div class="title-divider"></div>
                    </div>

                    <center>
                    <div class="preview-area js-reveal">
                        <div id="pdf-loader" class="pdf-loader">
                            <div class="spinner"></div>
                            <p>Memuat Dokumen...</p>
                        </div>
    
                        <iframe 
                            src="https://drive.google.com/file/d/1Szgy7iCbkstsFj0uPHhPOEPW-G0Ju2mg/preview" 
                            id="pdf-iframe"
                            frameborder="0">
                        </iframe>
                    </div>
                    </center>
                    
                    <div class="download-info js-reveal">
                        hasil rapat kerja yang dilaksankan pada tanggal 17 dan 18 mei 2025. 
                            <br>
                        klik di bawah untuk mengunduh
                    </div>
                    <div class="action-footer">
                        <a href="{{ asset('asset/pdf/Program-Kerja-DMI-2024-2029.pdf') }}" class="btn-main-download" download>
                            <i class="fas fa-cloud-download-alt"></i> Unduh Dokumen Lengkap (PDF)
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<script>
    
document.getElementById('pdf-iframe').onload = function() {
    document.getElementById('pdf-loader').style.display = 'none';
};
    function hideLoader() {
        document.getElementById('pdf-loader').style.opacity = '0';
        setTimeout(() => {
            document.getElementById('pdf-loader').style.display = 'none';
        }, 500);
    }
</script>

@endsection