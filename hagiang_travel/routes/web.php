<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DestinationAdminController;
use App\Http\Controllers\Admin\HouseholdAdminController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\BookingAdminController;

// ===================== TRANG CÔNG KHAI =====================
Route::get('/', [DestinationController::class, 'index'])->name('home');
Route::get('/destinations/{destination}', [DestinationController::class, 'show'])->name('destinations.show');
Route::get('/tour', [DestinationController::class, 'tourList'])->name('tour');

// ===================== AUTH =====================
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ===================== NGƯỜI DÙNG (cần đăng nhập) =====================
Route::middleware('auth')->group(function () {
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/history', [BookingController::class, 'history'])->name('booking.history');
});

// ===================== ADMIN =====================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Quản lý điểm du lịch
    Route::resource('destinations', DestinationAdminController::class);

    // Quản lý hộ dân
    Route::resource('households', HouseholdAdminController::class);

    // Quản lý dịch vụ
    Route::resource('services', ServiceAdminController::class);

    // Quản lý đơn đặt tour
    Route::get('/bookings', [BookingAdminController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingAdminController::class, 'show'])->name('bookings.show');
    Route::patch('/bookings/{booking}/confirm', [BookingAdminController::class, 'confirm'])->name('bookings.confirm');
    Route::patch('/bookings/{booking}/cancel', [BookingAdminController::class, 'cancel'])->name('bookings.cancel');
    Route::delete('/bookings/{booking}', [BookingAdminController::class, 'destroy'])->name('bookings.destroy');
});
