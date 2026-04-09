document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper('.headline-slider', {
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        speed: 1000,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        // Tambahan fitur agar stabil di mobile:
        observer: true,
        observeParents: true,
        resizeObserver: true,
        on: {
            init: function () {
                // Memaksa swiper menghitung ulang setelah 100ms
                setTimeout(() => {
                    this.update();
                }, 100);
            },
        },
    });
});