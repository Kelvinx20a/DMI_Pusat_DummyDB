@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/berita.css') }}">

<section class="all-news-section">
    <div class="container">
        <div class="news-page-header js-reveal">
            <div class="header-left js-reveal">
                <h1 class="main-title" style="margin-bottom: 10px;">Eksplorasi <span>Berita</span></h1>
            </div>
            
            <div class="header-right js-reveal">
                <form class="search-box js-reveal">
                    <input type="text" placeholder="Cari topik berita..." aria-label="Search">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        <hr class="divider js-reveal">

        <div class="all-news-grid">
            
            <article class="compact-card js-reveal">
                <a href="{{ url('/redaksi/berita/detail-berita?from=semua-berita') }}" class="card-link js-reveal">
                    <div class="card-img js-reveal">
                        <img src="https://picsum.photos/id/1/400/250" alt="News">
                        <span class="card-tag">Nasional</span>
                    </div>
                    <div class="card-body js-reveal">
                        <div class="meta-info">
                            <span><i class="far fa-calendar-alt"></i> 10 Apr 2026</span>
                            <span><i class="far fa-clock"></i> 5 mnt</span>
                        </div>
                        <h3>Dampak Strategis Kebijakan Baru Sektor Digital Indonesia</h3>
                        <p>Pemerintah baru saja meresmikan regulasi yang akan mempercepat adopsi teknologi AI di sektor pelayanan publik.</p>
                        <span class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </article>

            <article class="compact-card js-reveal">
                <a href="{{ url('/redaksi/berita/detail-berita?from=semua-berita') }}" class="card-link js-reveal">
                    <div class="card-img js-reveal">
                        <img src="https://picsum.photos/id/20/400/250" alt="News">
                        <span class="card-tag">Ekonomi</span>
                    </div>
                    <div class="card-body js-reveal">
                        <div class="meta-info">
                            <span><i class="far fa-calendar-alt"></i> 10 Apr 2026</span>
                            <span><i class="far fa-clock"></i> 4 mnt</span>
                        </div>
                        <h3>Rupiah Menguat Tajam Pasca Kesepakatan Damai Global</h3>
                        <p>Nilai tukar Rupiah menunjukkan performa terbaiknya dalam dua tahun terakhir menyusul stabilitas politik internasional.</p>
                        <span class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </article>

            <article class="compact-card js-reveal">
                <a href="{{ url('/redaksi/berita/detail-berita?from=semua-berita') }}" class="card-link js-reveal">
                    <div class="card-img js-reveal">
                        <img src="https://picsum.photos/id/26/400/250" alt="News">
                        <span class="card-tag">Internasional</span>
                    </div>
                    <div class="card-body js-reveal">
                        <div class="meta-info">
                            <span><i class="far fa-calendar-alt"></i> 09 Apr 2026</span>
                            <span><i class="far fa-clock"></i> 6 mnt</span>
                        </div>
                        <h3>Protokol Baru Gencatan Senjata Mulai Diberlakukan</h3>
                        <p>Pasukan perdamaian mulai dikerahkan ke titik-titik krusial guna memastikan keamanan warga sipil di zona konflik.</p>
                        <span class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </article>

            <article class="compact-card js-reveal">
                <a href="{{ url('/redaksi/berita/detail-berita?from=semua-berita') }}" class="card-link js-reveal">
                    <div class="card-img js-reveal">
                        <img src="https://picsum.photos/id/30/400/250" alt="News">
                        <span class="card-tag">Teknologi</span>
                    </div>
                    <div class="card-body js-reveal">
                        <div class="meta-info">
                            <span><i class="far fa-calendar-alt"></i> 09 Apr 2026</span>
                            <span><i class="far fa-clock"></i> 3 mnt</span>
                        </div>
                        <h3>Peluncuran Satelit Generasi Keenam Sukses Dilakukan</h3>
                        <p>Infrastruktur internet global akan segera mendapatkan peningkatan kecepatan berkat teknologi satelit terbaru.</p>
                        <span class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </article>

            <article class="compact-card js-reveal">
                <a href="{{ url('/redaksi/berita/detail-berita?from=semua-berita') }}" class="card-link js-reveal">
                    <div class="card-img js-reveal">
                        <img src="https://picsum.photos/id/42/400/250" alt="News">
                        <span class="card-tag">Regional</span>
                    </div>
                    <div class="card-body js-reveal">
                        <div class="meta-info">
                            <span><i class="far fa-calendar-alt"></i> 08 Apr 2026</span>
                            <span><i class="far fa-clock"></i> 4 mnt</span>
                        </div>
                        <h3>Revitalisasi Kawasan Wisata Jabar Masuki Tahap Akhir</h3>
                        <p>Gubernur memastikan pembangunan infrastruktur penunjang pariwisata akan selesai sebelum libur panjang mendatang.</p>
                        <span class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </article>

            <article class="compact-card js-reveal">
                <a href="{{ url('/redaksi/berita/detail-berita?from=semua-berita') }}" class="card-link js-reveal">
                    <div class="card-img js-reveal">
                        <img src="https://picsum.photos/id/48/400/250" alt="News">
                        <span class="card-tag">Kesehatan</span>
                    </div>
                    <div class="card-body js-reveal">
                        <div class="meta-info">
                            <span><i class="far fa-calendar-alt"></i> 08 Apr 2026</span>
                            <span><i class="far fa-clock"></i> 5 mnt</span>
                        </div>
                        <h3>Inovasi Terapi Genetik Berikan Harapan Baru Pasien Rare Disease</h3>
                        <p>Peneliti mengumumkan hasil klinis positif terhadap metode pengobatan terbaru untuk penyakit langka.</p>
                        <span class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </article>

            <article class="compact-card js-reveal">
                <a href="{{ url('/redaksi/berita/detail-berita?from=semua-berita') }}" class="card-link js-reveal">
                    <div class="card-img js-reveal">
                        <img src="https://picsum.photos/id/60/400/250" alt="News">
                        <span class="card-tag">Olahraga</span>
                    </div>
                    <div class="card-body js-reveal">
                        <div class="meta-info">
                            <span><i class="far fa-calendar-alt"></i> 07 Apr 2026</span>
                            <span><i class="far fa-clock"></i> 3 mnt</span>
                        </div>
                        <h3>Tim Nasional U-23 Resmi Masuk Babak Kualifikasi Utama</h3>
                        <p>Kemenangan telak semalam memastikan posisi Indonesia di panggung bergengsi tingkat Asia.</p>
                        <span class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </article>

            <article class="compact-card js-reveal">
                <a href="{{ url('/redaksi/berita/detail-berita?from=semua-berita') }}" class="card-link js-reveal">
                    <div class="card-img js-reveal">
                        <img src="https://picsum.photos/id/50/400/250" alt="News">
                        <span class="card-tag">Edukasi</span>
                    </div>
                    <div class="card-body js-reveal">
                        <div class="meta-info">
                            <span><i class="far fa-calendar-alt"></i> 07 Apr 2026</span>
                            <span><i class="far fa-clock"></i> 7 mnt</span>
                        </div>
                        <h3>Transformasi Kurikulum Digital di Sekolah Pedesaan</h3>
                        <p>Upaya pemerataan kualitas pendidikan mulai menunjukkan hasil nyata melalui program literasi digital nasional.</p>
                        <span class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </article>

            <article class="compact-card js-reveal">
                <a href="{{ url('/redaksi/berita/detail-berita?from=semua-berita') }}" class="card-link js-reveal">
                    <div class="card-img js-reveal">
                        <img src="https://picsum.photos/id/55/400/250" alt="News">
                        <span class="card-tag">Gaya Hidup</span>
                    </div>
                    <div class="card-body js-reveal">
                        <div class="meta-info">
                            <span><i class="far fa-calendar-alt"></i> 06 Apr 2026</span>
                            <span><i class="far fa-clock"></i> 4 mnt</span>
                        </div>
                        <h3>Tren Slow Living di Tengah Kesibukan Kota Metropolitan</h3>
                        <p>Melihat fenomena masyarakat urban yang mulai beralih ke gaya hidup minimalis dan berkelanjutan.</p>
                        <span class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </article>

        </div>

            <nav class="pagination-wrapper js-reveal">
                    <div class="pagination-container js-reveal">
                        <a href="#" class="page-nav prev disabled" title="Previous">
                            <i class="fas fa-arrow-left"></i>
                        </a>
            
                    <div class="page-numbers js-reveal">
                        <a href="#" class="page-num active">1</a>
                        <a href="#" class="page-num">2</a>
                        <a href="#" class="page-num">3</a>
                        <span class="page-dots">...</span>
                        <a href="#" class="page-num">12</a>
                    </div>

                    <a href="#" class="page-nav next js-reveal" title="Next">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </nav>
    </div>
</section>
@endsection