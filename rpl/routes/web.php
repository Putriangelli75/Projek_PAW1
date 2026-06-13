<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LapanganController as AdminLapanganController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

use App\Http\Controllers\Pelanggan\DashboardController as PelangganDashboardController;
use App\Http\Controllers\Pelanggan\AkunController;
use App\Http\Controllers\Pelanggan\BookingController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Pelanggan\LapanganController;

/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.post');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Register
|--------------------------------------------------------------------------
*/

Route::get('/register', [RegisterController::class, 'showRegisterForm'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('register.post');

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (!Auth::check()) {
        return redirect('/login');
    }

    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('pelanggan.dashboard');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get(
        '/dashboard',
        [AdminDashboardController::class, 'index']
    )
        ->name('admin.dashboard');

    Route::resource(
        'lapangan',
        AdminLapanganController::class
    )->names('admin.lapangan');

    Route::resource(
        'booking',
        AdminBookingController::class
    )->names('admin.booking');

    Route::get(
        '/booking/{id}/status/{status}',
        [AdminBookingController::class, 'updateStatus']
    )->name('admin.booking.status');
});

/*
|--------------------------------------------------------------------------
| Pelanggan
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('pelanggan')->group(function () {

    Route::get(
        '/dashboard',
        [PelangganDashboardController::class, 'index']
    )
        ->name('pelanggan.dashboard');

    Route::get(
        '/akun',
        [AkunController::class, 'index']
    )
        ->name('pelanggan.akun');

    Route::get(
        '/akun/edit',
        [AkunController::class, 'edit']
    )
        ->name('pelanggan.edit-akun');

    Route::put(
        '/akun/update',
        [AkunController::class, 'update']
    )
        ->name('pelanggan.update-akun');

    Route::get(
        '/booking/{id}',
        [BookingController::class, 'create']
    )
        ->name('pelanggan.booking.create');

    Route::post(
        '/booking/{id}',
        [BookingController::class, 'store']
    )
        ->name('pelanggan.booking.store');


    ## Riwayat Booking
    Route::middleware(['auth'])->group(function () {
        Route::get('/riwayat-booking', [BookingController::class, 'riwayat']);
    });

    ## Batal Booking
    Route::middleware(['auth'])->group(function () {
        Route::get('/booking/batal/{id}', [BookingController::class, 'batal']);
    });

    ## Ubah Password
    Route::middleware(['auth'])->group(function () {
        Route::get('/akun/password', [AkunController::class, 'editPassword']);
        Route::post('/akun/password', [AkunController::class, 'updatePassword']);
    });

    ## Pembayaran
    Route::middleware(['auth'])->group(function () {
        Route::get('/pembayaran/{id}', [BookingController::class, 'formPembayaran']);
        Route::post('/pembayaran/{id}', [BookingController::class, 'uploadPembayaran']);
    });

    ## Lapangan
    Route::prefix('pelanggan')->middleware('auth')->group(function () {
        Route::get('/lapangan', [LapanganController::class, 'index'])
            ->name('pelanggan.lapangan.index');
    });
});
