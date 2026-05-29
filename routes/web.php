<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProkerDMIController;
use App\Http\Controllers\HasilRapatKerjaController;
use App\Http\Controllers\AkustikMasjidController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\RedaksiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PenataanOrganisasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\WpPostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TrixUploadController;
use App\Http\Controllers\Admin\SettingsController;
use App\Models\Notification;


Route::get('/robots.txt', function () {
    return response("User-agent: *\nAllow: /\nSitemap: " . url('/sitemap.xml') . "\n", 200, ['Content-Type' => 'text/plain']);
});

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

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
Route::get('/kegiatan/detail-event/{slug}',[KegiatanController::class, 'detail'])->name('kegiatan.event.detail');
Route::get('/kegiatan/detail-event',[KegiatanController::class, 'detail']);


Route::get('/redaksi/berita', [BeritaController::class, 'berita'])->name('redaksi.berita');
Route::get('/redaksi/berita/detail-berita/{postSlug?}', [BeritaController::class, 'berita2'])->name('redaksi.berita.detail');
Route::get('/redaksi/berita/semua-berita', [BeritaController::class, 'berita3'])->name('redaksi.berita.semua');
Route::get('/redaksi/susunan-redaksi',[RedaksiController::class, 'susunanredaksi']); 

Route::get('/forgot-password', function () {
    return redirect()->route('login');
})->name('password.request');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home.home');

    Route::controller(WpPostController::class)->group(function () {
        Route::get('/wp-posts', 'index')->name('posts.index');
        Route::get('/wp-posts/create', 'create')->name('posts.create');
        Route::post('/wp-posts/store', 'store')->name('posts.store');
        Route::post('/wp-posts/publish-scheduled-due', 'publishScheduledDue')->name('posts.publishScheduledDue');
        Route::get('/wp-posts/edit/{id}', 'edit')->name('posts.edit');
        Route::post('/wp-posts/update/{id}', 'update')->name('posts.update');
        Route::delete('/wp-posts/delete/{id}', 'destroy')->name('posts.delete');
        Route::delete('/wp-posts/bulk-delete', 'bulkDestroy')->name('posts.bulkDelete');
    });

    Route::controller(EventController::class)->group(function () {
        Route::get('/events', 'index')->name('events.index');
        Route::get('/events/{id}/edit', 'edit')->name('events.edit');
        Route::post('/events/store', 'store')->name('events.store');
        Route::put('/events/{id}', 'update')->name('events.update');
        Route::delete('/events/{id}', 'destroy')->name('events.destroy');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('user.user');
        Route::get('/users/create', 'create')->name('user.create');
        Route::post('/users', 'store')->name('user.store');
        Route::get('/users/{id}/edit', 'edit')->name('user.edit');
        Route::get('/users/{id}', 'show')->name('user.show');
        Route::put('/users/{id}', 'update')->name('user.update');
        Route::delete('/users/{id}', 'destroy')->name('user.destroy');
    });

    Route::controller(SettingsController::class)->group(function () {
        Route::get('/settings', 'index')->name('settings.index');
        Route::post('/settings', 'update')->name('settings.update');
    });

    Route::post('/notifications/read-all', function () {
        Notification::where('is_read', false)->update(['is_read' => true]);

        return response()->json(['success' => true]);
    })->name('notifications.readAll');

    Route::post('/trix-upload', [TrixUploadController::class, 'store'])->name('trix.upload');
});
