@extends('layouts.app')
    @section('content')

    <section class="wk-premium-section">
    <div class="wk-container">
        
        <div class="wk-text-content js-reveal">
            <div class="wk-badge">
                <i class="fas fa-award"></i>
                <span>Program Unggulan DMI</span>
            </div>
            
            <h2 class="wk-headline">Sertifikasi <br><span>Tanah Wakaf</span></h2>
            
            <p class="wk-description">
                Jangan biarkan aset umat tanpa kepastian hukum. DMI menyediakan layanan pendampingan penuh untuk pengurusan sertifikat tanah wakaf hingga tuntas ke BPN.
            </p>

            <div class="wk-features-mini">
                <div class="wk-f-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Proses Transparan</span>
                </div>
                <div class="wk-f-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Tanpa Biaya Admin</span>
                </div>
            </div>

            <!-- <div class="wk-action-group">
                <a href="#" class="wk-btn-primary">
                    <span>Mulai Konsultasi Sekarang</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
                <span class="wk-trust-info">
                    <i class="fas fa-shield-alt"></i> Didukung oleh Pimpinan Pusat DMI
                </span>
            </div> -->
        </div>

        <div class="wk-visual-content js-reveal">
            <div class="wk-image-wrapper">
                <div class="wk-main-card">
                    <img src="{{ asset('img/proker/sertifikat-tanah-wakaf/orang1.png') }}" alt="Sertifikat BPN">
                </div>
                
                <div class="wk-sub-card">
                    <img src="{{ asset('img/proker/sertifikat-tanah-wakaf/orang2.png') }}" alt="Pendampingan DMI">
                </div>

                <div class="wk-blob"></div>
            </div>
        </div>

    </div>
</section>


<script>
    window.addEventListener('scroll', () => {
  const reveals = document.querySelectorAll('.js-reveal');
  reveals.forEach(el => {
    const windowHeight = window.innerHeight;
    const revealTop = el.getBoundingClientRect().top;
    const revealPoint = 150;
    
    if (revealTop < windowHeight - revealPoint) {
      el.style.opacity = "1";
      el.style.transform = "translateY(0)";
    }
  });
});

// Initial Style for Reveal
document.querySelectorAll('.js-reveal').forEach(el => {
  el.style.opacity = "0";
  el.style.transform = "translateY(30px)";
  el.style.transition = "all 0.8s ease-out";
});
</script>

    @endsection