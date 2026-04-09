 @extends('layouts.app')
    @section('content')

    <section class="eco-simple-v5">
    <div class="container-lite">
        <div class="eco-head js-reveal">
            <span class="tag-hijau">ENVIRONMENTAL</span>
            <h2 class="title-main">Program Masjid Hijau</h2>
            <div class="line-short"></div>
        </div>

        <div class="eco-hero js-reveal">
            <img src="../img/proker/lingkungan/2.jpg" 
                alt="Visi" 
                loading="lazy" 
                decoding="async"
                width="1200" 
                height="350">
            <div class="floating-badge">Visi 2026</div>
        </div>

        <div class="eco-grid-v5">
            <div class="eco-card js-reveal">
                <div class="eco-img">
                    <img src="https://picsum.photos/id/1016/400/300" alt="Energi" loading="lazy">
                </div>
                <div class="eco-info">
                    <span class="label">Energi</span>
                    <h3>Pembangkit Surya</h3>
                    <div class="bar-bg"><div class="bar-fill" style="width: 85%;"></div></div>
                    <div class="bar-val"><span>Status</span> <strong>85%</strong></div>
                </div>
            </div>

            <div class="eco-card js-reveal">
                <div class="eco-img">
                    <img src="https://picsum.photos/id/1015/400/300" alt="Air" loading="lazy">
                </div>
                <div class="eco-info">
                    <span class="label">Air</span>
                    <h3>Konservasi Wudhu</h3>
                    <div class="bar-bg"><div class="bar-fill" style="width: 60%;"></div></div>
                    <div class="bar-val"><span>Status</span> <strong>60%</strong></div>
                </div>
            </div>

            <div class="eco-card js-reveal">
                <div class="eco-img">
                    <img src="https://picsum.photos/id/1043/400/300" alt="Limbah" loading="lazy">
                </div>
                <div class="eco-info">
                    <span class="label">Limbah</span>
                    <h3>Pengelolaan Sampah</h3>
                    <div class="bar-bg"><div class="bar-fill" style="width: 35%;"></div></div>
                    <div class="bar-val"><span>Status</span> <strong>35%</strong></div>
                </div>
            </div>
        </div>
    </div>
</section>
    @endsection