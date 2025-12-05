<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarManagementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index'])->name('home');

// صفحات السيارات (عامة)
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/{id}', [CarController::class, 'show'])->name('cars.show');
Route::get('/compare', [CarController::class, 'compare'])->name('cars.compare');

// صفحة اتصل بنا
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// المفضلة (للمستخدمين المسجلين)
Route::middleware('auth')->group(function () {
    Route::get('/favorites', [\App\Http\Controllers\FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/toggle', [\App\Http\Controllers\FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/api/check-favorite/{carId}', [\App\Http\Controllers\FavoriteController::class, 'check']);
});

// مسارات المصادقة (Breeze)
require __DIR__ . '/auth.php';

// مسارات البروفايل (للمستخدمين المسجلين)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// مسارات لوحة التحكم للمدير
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // لوحة التحكم الرئيسية
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // إدارة السيارات
    Route::resource('cars', CarManagementController::class);

    // إدارة الرسائل
    Route::get('/contacts', [\App\Http\Controllers\Admin\ContactManagementController::class, 'index'])->name('contacts.index');
    Route::patch('/contacts/{id}/read', [\App\Http\Controllers\Admin\ContactManagementController::class, 'read'])->name('contacts.read');
});
