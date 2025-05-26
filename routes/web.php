<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PickupRequestController;
use App\Http\Controllers\WasteReportController;
use App\Http\Controllers\WasteCollectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminPickupRequestController;
use App\Http\Controllers\DelayReportController;
use App\Http\Controllers\TpsTpaController;
use App\Http\Controllers\WasteRecordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserDashboardController;

// Halaman utama & dashboard
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Artikel & Peta
Route::get('/articles', [ArticleController::class, 'listArticles']);
Route::get('/article/{id}', [ArticleController::class, 'showArticle'])->name('article.show');
Route::get('/map', [MapController::class, 'index'])->name('map');
Route::get('/facilities', [MapController::class, 'index'])->name('peta.index');

// 🔐 Admin Middleware
Route::middleware('checkRole:admin')->group(function () {
    Route::get('/admin/home', [ArticleController::class, 'index'])->name('admin.home');
    Route::get('/admin/sampah', [PickupRequestController::class, 'sampah'])->name('admin.sampah');

    // CRUD Artikel
    Route::post('/articles', [ArticleController::class, 'store']);
    Route::put('/articles/{id}', [ArticleController::class, 'update']);
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);
    Route::get('/admin/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

    // Admin Pickup Request
    Route::get('/admin/pickup-requests', [AdminPickupRequestController::class, 'index'])->name('admin.pickup-requests');
    Route::get('/admin/pickup-requests/{pickupRequest}', [AdminPickupRequestController::class, 'show'])->name('admin.pickup-requests.show');
    Route::put('/admin/pickup-requests/{pickupRequest}', [AdminPickupRequestController::class, 'update'])->name('admin.pickup-requests.update');

    // TPS/TPA
    Route::prefix('admin/tps-tpa')->group(function () {
        Route::get('/', [TpsTpaController::class, 'index'])->name('tps-tpa.index');
        Route::get('/create', [TpsTpaController::class, 'create'])->name('tps-tpa.create');
        Route::post('/', [TpsTpaController::class, 'store'])->name('tps-tpa.store');
        Route::get('/{tpsTpa}/edit', [TpsTpaController::class, 'edit'])->name('tps-tpa.edit');
        Route::put('/{tpsTpa}', [TpsTpaController::class, 'update'])->name('tps-tpa.update');
        Route::delete('/{tpsTpa}', [TpsTpaController::class, 'destroy'])->name('tps-tpa.destroy');
        Route::get('/map', [TpsTpaController::class, 'map'])->name('tps-tpa.map');
    });

    // ✅ Jadwal Pengangkutan
    Route::resource('/admin/jadwal-pengangkutan', \App\Http\Controllers\JadwalPengangkutanController::class);

    // Report Delay
    Route::get('/admin/report-delay', [DelayReportController::class, 'adminIndex'])->name('admin.report-delay.index');

    // Dashboard laporan
    Route::get('/admin/waste-report-dashboard', [DashboardController::class, 'wasteReportDashboard'])->name('admin.waste-report.dashboard');
});

// Logout
Route::match(['get', 'post'], '/admin/logout', [AdminController::class, 'logout'])->name('auth.admin.logout');
Route::match(['get', 'post'], '/user/logout', [LoginController::class, 'logout'])->name('auth.user.logout');
Route::match(['get', 'post'], '/pengelola/logout', [LoginController::class, 'logout'])->name('auth.pengelola.logout');

// 👤 Guest
Route::middleware('checkRole:guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('auth.admin.login');
    Route::post('/admin/login', [AdminController::class, 'login']);

    Route::get('/admin/register', [AdminController::class, 'showRegister'])->name('auth.admin.register');
    Route::post('/admin/register', [AdminController::class, 'register']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// 🔐 Pickup Request User
Route::middleware(['auth'])->group(function () {
    Route::prefix('pickup')->group(function () {
        Route::get('/', [PickupRequestController::class, 'index'])->name('pickup.index');
        Route::get('/request', [PickupRequestController::class, 'requestPage'])->name('pickup.request-page');
        Route::get('/create', [PickupRequestController::class, 'create'])->name('pickup.create');
        Route::post('/', [PickupRequestController::class, 'store'])->name('pickup.store');
        Route::get('/history', [PickupRequestController::class, 'history'])->name('pickup.history');
        Route::get('/{pickupRequest}', [PickupRequestController::class, 'show'])->name('pickup.show');
    });
});

// 🔐 Pengelola
Route::middleware('checkRole:pengelola')->group(function () {
    Route::get('/laporan', [WasteReportController::class, 'laporan'])->name('laporan');
    Route::put('/laporan/{id}', [WasteReportController::class, 'laporanUpdate'])->name('laporan.update');
    Route::get('/laporan/report-delay', [WasteReportController::class, 'laporanReportDelay'])->name('laporan.report-delay');
    Route::put('/laporan/report-delay/{id}', [WasteReportController::class, 'laporanReportDelayUpdate'])->name('laporan.report-delay.update');

    Route::get('/pengelola/profile', [ProfileController::class, 'show'])->name('profile');

    Route::get('/waste-collection', [WasteCollectionController::class, 'index'])->name('waste-collection');
    Route::put('/waste-collection/{id}', [WasteCollectionController::class, 'update'])->name('waste-collection.update');
    Route::get('/waste-collection/{id}', [WasteCollectionController::class, 'show'])->name('waste-collection.show');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('waste-reports')->group(function () {
        Route::get('/', [WasteReportController::class, 'index'])->name('waste-reports.index');
        Route::get('/create', [WasteReportController::class, 'create'])->name('waste-reports.create');
        Route::post('/', [WasteReportController::class, 'store'])->name('waste-reports.store');
        Route::get('/{wasteReport}', [WasteReportController::class, 'show'])->name('waste-reports.show');
        Route::get('/{wasteReport}/edit', [WasteReportController::class, 'edit'])->name('waste-reports.edit');
        Route::put('/{wasteReport}', [WasteReportController::class, 'update'])->name('waste-reports.update');
        Route::delete('/{wasteReport}', [WasteReportController::class, 'destroy'])->name('waste-reports.destroy');
        // Add new route for updating with collection
        Route::post('/{wasteReport}/update-with-collection', [WasteReportController::class, 'updateWithCollection'])->name('waste-reports.update-with-collection');
        Route::post('/waste-reports/{wasteReport}/update-with-collection', 
            [App\Http\Controllers\WasteReportController::class, 'updateWithCollection'])
            ->name('waste-reports.update-with-collection');
    });

    //user dashboard routes - moved inside auth middleware
    Route::get('/dashboard-user', [UserDashboardController::class, 'index'])->name('user.dashboard');

    // fitur pencatatan sampah
    Route::resource('waste-record', WasteRecordController::class);
});

// API Routes for waste reports
Route::get('/api/waste-reports/{id}', [WasteReportController::class, 'apiGetReport']);

Route::prefix('delay-reports')->group(function () {
    Route::get('/', [DelayReportController::class, 'index'])->name('delay-reports.index');
    Route::get('/create', [DelayReportController::class, 'create'])->name('delay-reports.create');
    Route::post('/', [DelayReportController::class, 'store'])->name('delay-reports.store');
    Route::get('/history', [DelayReportController::class, 'history'])->name('delay-reports.history');
    Route::get('/{delayReport}', [DelayReportController::class, 'show'])->name('delay-reports.show');
    });

