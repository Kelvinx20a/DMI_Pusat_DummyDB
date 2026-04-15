
    <link rel="stylesheet" href="{{ asset('css/tentang-kami.css') }}">
  <!-- Navbar -->
  @extends('layouts.app')
    @section('content')
<section class="dmi-hero-center">
    <div class="dmi-overlay-green">
        <div class="container">
            <div class="dmi-hero-content">
                <p class="dmi-pre-title js-reveal">Profil Dewan Masjid Indonesia</p>
                <h1 class="dmi-main-title js-reveal">TENTANG DEWAN<br>MASJID INDONESIA</h1>
                <center>
                <p class="dmi-tagline js-reveal"><i>
                    Dewan Masjid Indonesia (DMI) merupakan salah satu organisasi keagamaan terbesar di Indonesia yang berperan penting dalam memajukan fungsi masjid sebagai pusat peribadatan dan pemberdayaan umat.
                </i></p>
                </center>
            </div>
        </div>
    </div>
</section>

<section class="dmi-history-section">
    <div class="dmi-container">
        <header class="main-header js-reveal">
            <h1>Jejak Langkah <span>Dewan Masjid Indonesia</span></h1>
            <div class="underline"></div>
        </header>

        <div class="grid-layout">
            <div class="history-card js-reveal">
                <div class="card-content">
                    <div class="card-header">
                        <div class="icon-wrapper">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h2>Awal Mula Gagasan</h2>
                    </div>
                    <p>Pada akhir 1960-an, peran masjid sebagai pusat kehidupan umat Islam mulai disadari oleh berbagai kalangan. Awal terbentuknya DMI adalah ketika beberapa tokoh Islam berkumpul untuk membahas pengelolaan masjid secara terpusat. Pertemuan ini menjadi titik awal terbentuknya Dewan Kemakmuran Masjid Seluruh Indonesia (DKMSI) yang memicu lahirnya DMI pada 16 Juni 1970.</p>
                </div>
            </div>

            <div class="history-card js-reveal">
                <div class="card-content">
                    <div class="card-header">
                        <div class="icon-wrapper">
                            <i class="fas fa-mosque"></i>
                        </div>
                        <h2>Lahirnya DMI</h2>
                    </div>
                    <p>Pada 22 Juni 1972, rapat tim formatur secara resmi mendirikan Dewan Masjid Indonesia. Momen ini menjadi tonggak sejarah sebagai wadah koordinasi kemakmuran masjid di seluruh Indonesia. Kini DMI telah berkembang pesat dengan kepengurusan di setiap provinsi sebagai pusat pemberdayaan umat.</p>
                </div>
            </div>

            <div class="history-card js-reveal">
                <div class="card-content">
                    <div class="card-header">
                        <div class="icon-wrapper">
                            <i class="fas fa-users"></i>
                        </div>
                        <h2>Kepemimpinan DMI</h2>
                    </div>
                    <p>Setiap lima tahun, DMI mengadakan muktamar nasional. Salah satu tokoh sentralnya adalah Jusuf Kalla, Ketua Umum periode 2012-2022. Di bawah kepemimpinannya, DMI memperkuat peran strategis masjid dalam bidang sosial dan ekonomi serta menggerakkan masjid sebagai pusat aktivitas umat.</p>
                </div>
            </div>

            <div class="history-card js-reveal">
                <div class="card-content">
                    <div class="card-header">
                        <div class="icon-wrapper">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h2>Kantor Pusat</h2>
                    </div>
                    <p>Kantor pusat DMI berlokasi di Jl. Matraman Raya No.39-41, Jakarta Timur. Tempat ini menjadi pusat administrasi dan koordinasi utama bagi seluruh program kemakmuran masjid yang dijalankan di berbagai wilayah Indonesia.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="dmi-impact-section">
    <div class="dmi-container">
        <div class="impact-wrapper">
            <div class="impact-content js-reveal">
                <span class="sub-badge">Visi Masa Depan</span>
                <h2 class="impact-title">DMI Sebagai <span>Penggerak Perubahan</span></h2>
                <p class="impact-desc">
                    Hingga saat ini, Dewan Masjid Indonesia terus berupaya memaksimalkan peran masjid dalam kehidupan masyarakat. Melalui sejarah panjang, DMI telah menunjukkan peran signifikan dalam menjaga keberlanjutan peran masjid sebagai pusat peradaban Islam di Indonesia.
                </p>
            </div>

            <div class="impact-features">
                <div class="feature-item js-reveal">
                    <div class="feature-icon"><i class="fas fa-hands-helping"></i></div>
                    <div>
                        <h3>Aspek Sosial</h3>
                        <p>Berperan aktif dalam pemberdayaan dan bantuan sosial umat.</p>
                    </div>
                </div>
                <div class="feature-item js-reveal">
                    <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                    <div>
                        <h3>Ekonomi & Pendidikan</h3>
                        <p>Mengembangkan potensi ekonomi dan kualitas pendidikan melalui masjid.</p>
                    </div>
                </div>
                <div class="feature-item js-reveal">
                    <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                    <div>
                        <h3>Persatuan Umat</h3>
                        <p>Menjadi kekuatan penggerak untuk memperkokoh persatuan di pelosok negeri.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection