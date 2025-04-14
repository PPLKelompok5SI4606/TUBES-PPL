<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PickupRequestController;
use App\Http\Controllers\WasteReportController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;


// Redirect ke /home
Route::get('/', function () {
    return view('usermain');
})->name('home');

Route::get('/articles', [ArticleController::class, 'listArticles']);
Route::get('/article/{id}', [ArticleController::class, 'showArticle'])->name('article.show');



// 🔐 Hanya untuk user yang sudah login
Route::middleware('checkRole:admin')->group(function () {
    Route::get('/admin/home', [ArticleController::class, 'index'])->name('admin.home');

    Route::post('/articles', [ArticleController::class, 'store']);

    Route::put('/articles/{id}', [ArticleController::class, 'update']);

    Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);

    Route::get('/admin/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('auth.admin.logout');
});

Route::middleware('checkRole:user')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// 👤 Hanya untuk tamu (belum login)
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

// Pickup Request Routes
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


// Laporan Sampah
Route::get('/laporan', [WasteReportController::class, 'laporan'])->name('laporan');


// Waste Reports Routes
Route::middleware(['auth'])->group(function () {
    Route::prefix('waste-reports')->group(function () {
        Route::get('/', [WasteReportController::class, 'index'])->name('waste-reports.index');
        Route::get('/create', [WasteReportController::class, 'create'])->name('waste-reports.create');
        Route::post('/', [WasteReportController::class, 'store'])->name('waste-reports.store');
        Route::get('/{wasteReport}', [WasteReportController::class, 'show'])->name('waste-reports.show');
        Route::get('/{wasteReport}/edit', [WasteReportController::class, 'edit'])->name('waste-reports.edit');
        Route::put('/{wasteReport}', [WasteReportController::class, 'update'])->name('waste-reports.update');
        Route::delete('/{wasteReport}', [WasteReportController::class, 'destroy'])->name('waste-reports.destroy');
    });

});