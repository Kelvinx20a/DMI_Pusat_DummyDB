// =======================
// Navbar
// =======================

document.addEventListener("DOMContentLoaded", function() {
    const dropdowns = document.querySelectorAll('.dropdown');
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.getElementById('navMenu');

    // 1. Logika Klik Dropdown
    dropdowns.forEach(dropdown => {
        const link = dropdown.querySelector('a');

        link.addEventListener('click', function(e) {
            // Cek jika link memiliki dropdown (mencegah link biasa terblokir)
            if (this.nextElementSibling && this.nextElementSibling.classList.contains('dropdown-content')) {
                e.preventDefault();
                e.stopPropagation();

                const isActive = dropdown.classList.contains('is-active');

                // Tutup dropdown lain yang sedang terbuka
                dropdowns.forEach(d => d.classList.remove('is-active'));

                // Toggle class aktif
                if (!isActive) {
                    dropdown.classList.add('is-active');
                }
            }
        });
    });

    // 2. Klik di luar Navbar untuk menutup menu
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.navbar')) {
            dropdowns.forEach(d => d.classList.remove('is-active'));
            // Opsional: Tutup menu mobile juga jika klik luar
            navMenu.classList.remove('active');
            hamburger.classList.remove('active');
        }
    });

    // 3. Fungsi Hamburger Mobile
    window.toggleMenu = function() {
        hamburger.classList.toggle('active');
        navMenu.classList.toggle('active');
    };
});


//================//
// CAROUSEL HOME //
// =============//

document.addEventListener('DOMContentLoaded', function() {
    
    // --- 1. LOGIKA CAROUSEL ---
    const slides = document.querySelectorAll('.slide');
    const footerItems = document.querySelectorAll('.footer-item');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    let currentIdx = 0;
    let autoSlideInterval;

    function showSlide(n) {
        slides.forEach(s => s.classList.remove('active'));
        footerItems.forEach(f => f.classList.remove('active'));
        
        currentIdx = (n + slides.length) % slides.length;
        
        if(slides[currentIdx]) slides[currentIdx].classList.add('active');
        if(footerItems[currentIdx]) footerItems[currentIdx].classList.add('active');
        resetTimer();
    }

    if (prevBtn && nextBtn) {
        prevBtn.addEventListener('click', () => showSlide(currentIdx - 1));
        nextBtn.addEventListener('click', () => showSlide(currentIdx + 1));
        footerItems.forEach((item, idx) => {
            item.addEventListener('click', () => showSlide(idx));
        });
        startTimer();
    }

    function startTimer() {
        autoSlideInterval = setInterval(() => showSlide(currentIdx + 1), 8000);
    }
    function resetTimer() {
        clearInterval(autoSlideInterval);
        startTimer();
    }


    // --- 2. LOGIKA MAP CONTACT ---
    const mapPlaceholder = document.getElementById('mapPlaceholder');
    const mapContainer = document.getElementById('mapIframeContainer');
    if (mapPlaceholder) {
        mapPlaceholder.addEventListener('click', function() {
            const mapUrl = "https://www.google.com/maps/embed?pb=..."; // Ganti dengan URL embed asli
            mapContainer.innerHTML = `<iframe src="${mapUrl}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>`;
            mapPlaceholder.classList.add('fade-out');
        });
    }


    // --- 3. LOGIKA GLOBAL REVEAL ON SCROLL ---
    // Solusi agar tidak nabrak: Gunakan satu observer untuk SEMUA elemen .js-reveal
    const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            // Memberikan class aktif
            entry.target.classList.add('reveal-active');
            
            // Opsional: Berhenti memantau setelah muncul agar hemat resource
            revealObserver.unobserve(entry.target);
        }
    });
}, { 
    // threshold 0.2 berarti elemen muncul setelah 20% bagiannya terlihat di layar
    threshold: 0.2,
    rootMargin: "0px 0px -80px 0px" // Animasi terpicu 80px sebelum elemen benar-benar mentok bawah
});

document.querySelectorAll('.js-reveal').forEach(el => revealObserver.observe(el));

});

// =========================
// Contact Us
//==========================
document.addEventListener('DOMContentLoaded', function() {
    const mapPlaceholder = document.getElementById('mapPlaceholder');
    const mapContainer = document.getElementById('mapIframeContainer');
    
    // Alamat Google Maps
    const mapUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.81956135000001!3d-6.194741299999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTEnNDEuMSJTIDEwNsKwNDknMTAuNCJF!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid";

    if (mapPlaceholder) {
        mapPlaceholder.addEventListener('click', function() {
            // Tambahkan iframe secara dinamis saat diklik
            mapContainer.innerHTML = `<iframe src="${mapUrl}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>`;
            
            // Sembunyikan placeholder
            mapPlaceholder.classList.add('fade-out');
        });
    }

    // LOGIKA REVEAL UNTUK BAGIAN LAIN (Carousel, News, dll)
    // Pastikan class .js-reveal TIDAK ada di section contact agar tidak terpengaruh
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('reveal-active');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.js-reveal').forEach(el => observer.observe(el));
});

// =========================
// KALENDER
//==========================
document.addEventListener('DOMContentLoaded', () => {
    // 1. Deklarasi Elemen
    const monthDisplay = document.getElementById('monthDisplay');
    const calendarGrid = document.getElementById('calendarGrid');
    const prevBtn = document.getElementById('prevMonth');
    const nextBtn = document.getElementById('nextMonth');

    // 2. State Data
    let currentDate = new Date(); // Default ke hari ini

    const monthNames = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    const eventDatabase = {
        // Januari 2026 (00)
        "2026-00-07": { title: "Grand Islamic Gathering", tag: "Event", time: "11:59 WIB", loc: "Gedung DMI Pusat" },
        "2026-00-15": { title: "Pelatihan Manajemen Masjid", tag: "Edukasi", time: "09:00 WIB", loc: "Aula Utama" },
        "2026-00-28": { title: "Rapat Pleno Awal Tahun", tag: "Rapat", time: "13:00 WIB", loc: "Ruang Rapat Lt.3" },

        // Februari 2026 (01)
        "2026-01-05": { title: "Kajian Ekonomi Syariah", tag: "Kajian", time: "16:00 WIB", loc: "Masjid Agung" },
        "2026-01-12": { title: "Bakti Sosial Nasional", tag: "Sosial", time: "08:00 WIB", loc: "Area Jabodetabek" },
        "2026-01-20": { title: "Workshop Digital Dakwah", tag: "Edukasi", time: "10:00 WIB", loc: "Zoom Meeting" },
        "2026-01-25": { title: "Silaturahmi Pengurus Daerah", tag: "Rapat", time: "19:30 WIB", loc: "Hotel Sultan" },

        // Maret 2026 (02)
        "2026-02-03": { title: "Persiapan Tarhib Ramadhan", tag: "Event", time: "10:00 WIB", loc: "Gedung DMI Pusat" }
    };

    // 3. Fungsi Utama Render Kalender
    function renderCalendar() {
        calendarGrid.innerHTML = '';
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        // Tampilkan Nama Bulan
        monthDisplay.innerText = `${monthNames[month]} ${year}`;

        // Kalkulasi Hari
        let firstDay = new Date(year, month, 1).getDay();
        firstDay = (firstDay === 0) ? 6 : firstDay - 1; 

        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const daysInPrevMonth = new Date(year, month, 0).getDate();

        // Render Tanggal Muted (Bulan Lalu)
        for (let i = firstDay; i > 0; i--) {
            const dayDiv = document.createElement('div');
            dayDiv.className = 'cal-day muted';
            dayDiv.innerText = daysInPrevMonth - i + 1;
            calendarGrid.appendChild(dayDiv);
        }

        // Render Tanggal Aktif
        for (let d = 1; d <= daysInMonth; d++) {
            const dayDiv = document.createElement('div');
            dayDiv.className = 'cal-day';
            dayDiv.innerText = d;

            const dateKey = `${year}-${String(month).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
            
            if (eventDatabase[dateKey]) {
                dayDiv.classList.add('has-event');
                dayDiv.innerHTML = `${d} <span class="event-dot"></span>`;
            }

            // Highlight Hari Ini
            const today = new Date();
            if (d === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                dayDiv.classList.add('active');
                updateSidebar(eventDatabase[dateKey] || null, d, month, year);
            }

            dayDiv.addEventListener('click', () => {
                document.querySelectorAll('.cal-day').forEach(el => el.classList.remove('active'));
                dayDiv.classList.add('active');
                updateSidebar(eventDatabase[dateKey] || null, d, month, year, true); // True untuk animasi
            });

            calendarGrid.appendChild(dayDiv);
        }
    }

    // 4. Fungsi Update Sidebar dengan Animasi
    function updateSidebar(data, d, m, y, animate = false) {
        const eventCard = document.querySelector('.selected-event-card');
        const sidebarTitle = document.querySelector('.sel-info h4');
        const sidebarDate = document.querySelector('.sel-date');
        const sidebarTag = document.querySelector('.sel-tag');
        const sidebarTime = document.querySelector('.sel-meta p:nth-child(1)');
        const sidebarLoc = document.querySelector('.sel-meta p:nth-child(2)');

        const updateContent = () => {
            if (data) {
                sidebarTitle.innerText = data.title;
                sidebarTag.innerText = data.tag;
                sidebarTag.style.display = "inline-block";
                sidebarDate.innerText = `${String(d).padStart(2, '0')} ${monthNames[m]} ${y}`;
                sidebarTime.innerHTML = `<i class="far fa-clock"></i> ${data.time}`;
                sidebarLoc.innerHTML = `<i class="fas fa-map-marker-alt"></i> ${data.loc}`;
            } else {
                sidebarTitle.innerText = "Tidak Ada Kegiatan";
                sidebarTag.style.display = "none";
                sidebarDate.innerText = `${String(d).padStart(2, '0')} ${monthNames[m]} ${y}`;
                sidebarTime.innerHTML = `<i class="far fa-clock"></i> --:--`;
                sidebarLoc.innerHTML = `<i class="fas fa-map-marker-alt"></i> -`;
            }
        };

        if (animate) {
            eventCard.style.opacity = "0";
            eventCard.style.transform = "translateY(10px)";
            setTimeout(() => {
                updateContent();
                eventCard.style.opacity = "1";
                eventCard.style.transform = "translateY(0)";
            }, 200);
        } else {
            updateContent();
        }
    }

    // 5. Event Listeners Navigasi dengan Animasi Slide
    prevBtn.addEventListener('click', () => {
        calendarGrid.classList.remove('cal-slide-next', 'cal-slide-prev');
        void calendarGrid.offsetWidth; 
        calendarGrid.classList.add('cal-slide-prev');

        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextBtn.addEventListener('click', () => {
        calendarGrid.classList.remove('cal-slide-next', 'cal-slide-prev');
        void calendarGrid.offsetWidth; 
        calendarGrid.classList.add('cal-slide-next');

        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    // Jalankan pertama kali
    renderCalendar();
});


// redaksi (Detail Berita)

