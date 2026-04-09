import './bootstrap';
let lastScrollY = window.scrollY;
const navbar = document.getElementById('navbar');

window.addEventListener('scroll', () => {
  if (lastScrollY < window.scrollY) {
    // Jika scroll ke bawah, tambahkan class untuk sembunyi
    navbar.classList.add('nav-hidden');
  } else {
    // Jika scroll ke atas, hapus class untuk memunculkan kembali
    navbar.classList.remove('nav-hidden');
  }
  
  // Update posisi scroll terakhir
  lastScrollY = window.scrollY;
});