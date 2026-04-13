    <link rel="stylesheet" href="{{ asset('css/kegiatan.css') }}">


@extends('layouts.app')
    @section('content')


    <section class="cal-section">
    <section class="cal-section">
  <div class="cal-container">
    
    <header class="cal-header">
      <div class="cal-title-wrap">
        <span class="cal-label js-reveal">Jadwal Kegiatan</span>
        <h2 class="cal-main-title js-reveal">Kalender Event</h2>
      </div>
      
      <div class="cal-controls js-reveal">
        
        <div class="cal-month-selector">
          <button class="cal-nav-btn" id="prevMonth">
            <i class="fas fa-chevron-left"></i>
          </button>
          <div class="cal-month-display">
            <i class="far fa-calendar-alt"></i>
            <span class="cal-current-month" id="monthDisplay">Januari 2026</span>
          </div>
          <button class="cal-nav-btn" id="nextMonth">
            <i class="fas fa-chevron-right"></i>
          </button>
        </div>
      </div>
    </header>

    <div class="cal-layout-grid js-reveal">
      <div class="cal-main-card">
        <div class="cal-days-header">
          <span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span>
          <span>Jum</span><span>Sab</span><span>Min</span>
        </div>
        <div class="cal-date-grid" id="calendarGrid">
          <div class="cal-day muted">29</div>
          <div class="cal-day muted">30</div>
          <div class="cal-day">1</div>
          <div class="cal-day">2</div>
          <div class="cal-day">3</div>
          <div class="cal-day">4</div>
          <div class="cal-day">5</div>
          <div class="cal-day">6</div>
          <div class="cal-day has-event active">7 <span class="event-dot"></span></div>
          <div class="cal-day">8</div>
          <div class="cal-day">9</div>
          <div class="cal-day has-event">11 <span class="event-dot"></span></div>
          <div class="cal-day muted">12</div>
          <div class="cal-day muted">13</div>
          <div class="cal-day">14</div>
          <div class="cal-day">15</div>
          <div class="cal-day">16</div>
          <div class="cal-day">17</div>
          <div class="cal-day">18</div>
          <div class="cal-day">19</div>
          <div class="cal-day has-event active">20 <span class="event-dot"></span></div>
          <div class="cal-day">21</div>
          <div class="cal-day">22</div>
          <div class="cal-day has-event">23 <span class="event-dot"></span></div>
          <div class="cal-day">23</div>
          <div class="cal-day">24</div>
          <div class="cal-day">25</div>
          <div class="cal-day">26</div>
          <div class="cal-day">27</div>
          <div class="cal-day has-event">28 <span class="event-dot"></span></div>
          <div class="cal-day">29</div>
          <div class="cal-day">30</div>
          </div>
      </div>

        <aside class="cal-event-sidebar js-reveal">
            <div class="sidebar-sticky">
                <h3 class="sidebar-title">Kegiatan Terpilih</h3>
                <div class="selected-event-card" id="event-display-card">
                <div class="sel-tag" id="event-tag">Event Hari Ini</div>
                <div class="sel-date" id="event-date">07 Januari 2026</div>
                <div class="sel-info">
                    <h4 id="event-title">Grand Islamic Gathering</h4>
                    <div class="sel-meta">
                    <p><i class="far fa-clock"></i> <span id="event-time">11:59 WIB</span></p>
                    <p><i class="fas fa-map-marker-alt"></i> <span id="event-location">Gedung DMI Pusat</span></p>
                    </div>
                    <a href="{{ url('/kegiatan/detail-event?from=kalender-event') }}"><button class="btn-sel-detail">Lihat Detail Agenda</button></a>
                </div>
                </div>
            </div>
        </aside>
    </div>

  </div>
</section>

<script>

    document.addEventListener('DOMContentLoaded', () => {
    // 1. Data Dummy Event (Bisa diganti dengan data dari database/API)
    const eventData = {
        "7": {
            title: "Grand Islamic Gathering",
            tag: "Event Hari Ini",
            time: "11:59 WIB",
            location: "Gedung DMI Pusat",
            fullDate: "07 Januari 2026"
        },
        "11": {
            title: "Kajian Rutin Fiqh",
            tag: "Kajian",
            time: "16:00 WIB",
            location: "Masjid Istiqlal",
            fullDate: "11 Januari 2026"
        },
        "20": {
            title: "Rapat Pleno Pengurus",
            tag: "Rapat",
            time: "09:00 WIB",
            location: "Kantor Pusat DMI",
            fullDate: "20 Januari 2026"
        },
        "23": {
            title: "Bakti Sosial Jumat",
            tag: "Sosial",
            time: "13:30 WIB",
            location: "Area Jakarta Selatan",
            fullDate: "23 Januari 2026"
        },
        "28": {
            title: "Workshop Digital Masjid",
            tag: "Edukasi",
            time: "10:00 WIB",
            location: "Online (Zoom)",
            fullDate: "28 Januari 2026"
        }
    };

    const dayCells = document.querySelectorAll('.cal-day:not(.muted)');
    const eventCard = document.getElementById('event-display-card');

    dayCells.forEach(cell => {
        cell.addEventListener('click', () => {
            const dateNumber = cell.innerText.trim().split('\n')[0]; // Ambil angka tanggal saja

            // A. Update Visual Active State
            dayCells.forEach(c => c.classList.remove('active'));
            cell.classList.add('active');

            // B. Update Sidebar Content
            if (eventData[dateNumber]) {
                // Jika ada event
                document.getElementById('event-title').innerText = eventData[dateNumber].title;
                document.getElementById('event-tag').innerText = eventData[dateNumber].tag;
                document.getElementById('event-date').innerText = eventData[dateNumber].fullDate;
                document.getElementById('event-time').innerText = eventData[dateNumber].time;
                document.getElementById('event-location').innerText = eventData[dateNumber].location;
                eventCard.style.opacity = "1";
                eventCard.style.transform = "translateY(0)";
            } else {
                // Jika tidak ada event (Tampilan Default/Kosong)
                document.getElementById('event-title').innerText = "Tidak Ada Kegiatan";
                document.getElementById('event-tag').innerText = "Kosong";
                document.getElementById('event-date').innerText = dateNumber + " Januari 2026";
                document.getElementById('event-time').innerText = "-";
                document.getElementById('event-location').innerText = "-";
                eventCard.style.opacity = "0.7";
            }
        });
    });
});

</script>

    @endsection