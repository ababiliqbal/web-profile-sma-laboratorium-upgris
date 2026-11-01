<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PostPageController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\StaffPageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\StaffPageControlller;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\GalleryPageController;
use App\Http\Controllers\DocumentPageController;
use App\Http\Controllers\FacilityPageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\AchievementPageController;
use App\Http\Controllers\AcademicEventPageController;
use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\Admin\StudyProgramController;
use App\Http\Controllers\Admin\AcademicEventController;
use App\Http\Controllers\ExtracurricularPageController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ExtracurricularController;
use App\Http\Controllers\Admin\AlumniTestimonialController;
use App\Http\Controllers\StudentOrganizationPageController;
use App\Http\Controllers\Admin\StudentOrganizationController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\GraduationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Auth Controller
Route::get('/dashboard', function () {
    return view('dashboardAdmin');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::resource('pages', PageController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('posts', PostController::class);
    Route::resource('albums', AlbumController::class);
    Route::post('albums/{album}/photos', [PhotoController::class, 'store'])->name('photos.store');
    Route::put('photos/{photo}', [PhotoController::class, 'update'])->name('photos.update');
    Route::delete('photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');
    Route::resource('achievements', AchievementController::class);
    Route::resource('alumni-testimonials', AlumniTestimonialController::class);
    Route::resource('staffs', StaffController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('facilities', FacilityController::class);
    Route::resource('study-programs', StudyProgramController::class);
    Route::resource('extracurriculars', ExtracurricularController::class);
    Route::resource('student-organizations', StudentOrganizationController::class);
    Route::resource('academic-events', AcademicEventController::class);
    Route::resource('users', UserController::class);
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::get('contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
    Route::get('contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])->name('contact-messages.show');
    Route::delete('contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk menghapus satu dokumen spesifik
    Route::delete('documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
});

require __DIR__ . '/auth.php';

// Public Controller
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profil Sekolah
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/guru-dan-staf', [StaffPageController::class, 'index'])->name('staffs.index');
    Route::get('/{page:slug}', [StaticPageController::class, 'show'])->name('pages.show');
});

// Akademik
Route::prefix('akademik')->name('akademik.')->group(function () {
    Route::get('/prestasi', [AchievementPageController::class, 'index'])->name('achievements.index');
    Route::get('kalender-akademik', [AcademicEventPageController::class, 'index'])->name('academic-events.index');
});

// Kesiswaan
Route::prefix('kesiswaan')->name('kesiswaan.')->group(function () {
    Route::get('/organisasi', [StudentOrganizationPageController::class, 'index'])->name('student-organizations.index');
    Route::get('/ekstrakurikuler', [ExtracurricularPageController::class, 'index'])->name('extracurriculars.index');
});

Route::prefix('sarpras')->name('sarpras.')->group(function () {
    Route::get('/fasilitas', [FacilityPageController::class, 'index'])->name('facilities.index');
});

// Berita
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('', [PostPageController::class, 'index'])->name('posts.index');
    Route::get('/kategori/{category:slug}', [PostPageController::class, 'category'])->name('posts.category');
    Route::get('/tag/{tag:slug}', [PostPageController::class, 'tag'])->name('posts.tag');
    Route::get('/{post:slug}', [PostPageController::class, 'show'])->name('posts.show');
});

Route::prefix('galeri')->name('galeri.')->group(function () {
    Route::get('', [GalleryPageController::class, 'index'])->name('galleries.index');
    Route::get('/{album}', [GalleryPageController::class, 'show'])->name('galleries.show');
});

Route::prefix('kontak')->name('kontak.')->group(function () {
    Route::get('', [ContactFormController::class, 'create'])->name('contact.create');
    Route::post('', [ContactFormController::class, 'store'])->name('contact.store');
});

Route::get('/berkas', [DocumentPageController::class, 'index'])->name('documents.index');

Route::get('documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');

Route::get('/search', [SearchController::class, 'index'])->name('search.index');

// Route untuk Pengumuman Kelulusan
Route::get('/pengumuman-kelulusan', [GraduationController::class, 'index'])->name('kelulusan.index');
Route::post('/pengumuman-kelulusan/cek', [GraduationController::class, 'check'])->name('kelulusan.check');
