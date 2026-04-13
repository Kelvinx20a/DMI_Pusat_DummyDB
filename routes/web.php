<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProkerDMIController;
use App\Http\Controllers\HasilRapatKerjaController;
use App\Http\Controllers\AkustikMasjidController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\RedaksiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PenataanOrganisasiController;


Route::get('/',[HomeController::class, 'index']);

Route::get('/program-kerja/program-kerja-dewan-masjid-indonesia',[ProkerDMIController::class, 'index']);
Route::get('/program-kerja/pengembangan-ekonomi-dan-sosial',[ProkerDMIController::class, 'index2']);
Route::get('/program-kerja/pelatihan-fungsi-ke-masjidan',[ProkerDMIController::class, 'index3']);
Route::get('/program-kerja/lingkungan-hijau',[ProkerDMIController::class, 'index4']);

Route::get('/program-kerja/sertifikat-tanah-wakaf',[ProkerDMIController::class, 'index5']);
Route::get('/program-kerja/masjid-ramah-jamaah',[ProkerDMIController::class, 'index6']);
Route::get('/program-kerja/masjid-bersih-dan-sehat',[ProkerDMIController::class, 'index7']);
Route::get('/program-kerja/pendidikan-dan-dakwah',[ProkerDMIController::class, 'index8']);
Route::get('/program-kerja/arsitektur-masjid',[ProkerDMIController::class, 'index9']);
Route::get('/program-kerja/wisata-religi',[ProkerDMIController::class, 'index10']);

Route::get('/program-kerja/hasil-rapat-kerja-nasional-2025',[HasilRapatKerjaController::class, 'index']);
Route::get('/program-kerja/akustik-masjid',[AkustikMasjidController::class, 'index']);
Route::get('/program-kerja/penataan-organisasi',[PenataanOrganisasiController::class, 'index']);

Route::get('/tentang-kami/pengurus',[PengurusController::class, 'index']);
Route::get('/tentang-kami/profil',[PengurusController::class, 'profil']);


Route::get('/kegiatan/event-bulan-ini',[KegiatanController::class, 'event']);
Route::get('/kegiatan/kalender-event',[KegiatanController::class, 'kalender']);
Route::get('/kegiatan/detail-event',[KegiatanController::class, 'detail']);


Route::get('/redaksi/berita',[BeritaController::class, 'berita']); 
Route::get('/redaksi/berita/detail-berita',[BeritaController::class, 'berita2']);
Route::get('/redaksi/berita/semua-berita',[BeritaController::class, 'berita3']);
Route::get('/redaksi/susunan-redaksi',[RedaksiController::class, 'susunanredaksi']); 