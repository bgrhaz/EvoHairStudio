<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController\Analytics;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;

use App\Http\Controllers\pelangganController\pelangganController;
use App\Http\Controllers\pelangganController\reservasiController;

use App\Http\Controllers\barbermanController\BarbermanController;
use App\Http\Controllers\adminController\BuatAkunBarberman;
use App\Http\Controllers\adminController\BuatAkunAdmin;
use App\Http\Controllers\adminController\jadwalBarberman;
use App\Http\Controllers\adminController\PengaturanAkun;
use App\Http\Controllers\FotoController\fotoController;
use App\Http\Controllers\barbermanController\PengaturanAkunBarberman;

Route::middleware('guest')->group(function () {
  Route::get('/', [LoginBasic::class, 'index'])->name('login');
  Route::post('/auth/login-user', [LoginBasic::class, 'authenticate'])->name('auth-login-user');
  Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
  Route::post('/auth/register-user', [RegisterBasic::class, 'store'])->name('auth-register-user');
  Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
});

Route::middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
  // Main Page Route
  Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard');
  Route::get('/akunBarberman', [Analytics::class, 'akunBarberman'])->name('akunBarberman');
  Route::get('/akunAdmin', [Analytics::class, 'akunAdmin'])->name('akunAdmin');
  Route::get('/halamanTransaksi', [Analytics::class, 'halamanTransaksi'])->name('halamanTransaksi');
  Route::get('/PengaturanAkun', [PengaturanAkun::class, 'index'])->name('PengaturanAkun');


  Route::get('/TambahAkunBarberman', [BuatAkunBarberman::class, 'index'])->name('TambahAkunBarberman');
  Route::post('/BuatAkunBarberman', [BuatAkunBarberman::class, 'store'])->name('BuatAkunBarberman');

  Route::get('/TambahAkunAdmin', [BuatAkunAdmin::class, 'index'])->name('TambahAkunAdmin');
  Route::post('/BuatAkunAdmin', [BuatAkunAdmin::class, 'store'])->name('BuatAkunAdmin');
  Route::get('JadwalBarberman/{id}', [jadwalBarberman::class, 'index'])->name('JadwalBarberman');
  Route::post('JadwalBarberman/{id}/simpan', [jadwalBarberman::class, 'store'])->name('SimpanJadwalBarberman');
  Route::post('/UbahAkun', [PengaturanAkun::class, 'store'])->name('UbahAKun');

  Route::get('/dashboard/{id}', [Analytics::class, 'cekJadwal'])->name('cekJadwal');
  Route::post('/Dashboard/AjukanReservasiOffline',  [Analytics::class, 'store'])->name('AjukanReservasiOffline');
  Route::post('/Dashboard/transaksi', [Analytics::class, 'transaksi'])->name('transaksi');
});

Route::middleware(['auth', 'role:user'])->prefix('pelanggan')->group(function () {
  Route::get('/HalamanUtama', [pelangganController::class, 'index'])->name('halamanPelanggan');
  Route::get('/HalamanReservasi/{id}', [reservasiController::class, 'index'])->name('HalamanReservasi');
  Route::post('/HalamanReservasi/mengajukan', [reservasiController::class, 'store'])->name('AjukanReservasi');
  Route::get(
    '/reservasi/{id}/cek-jadwal',
    [reservasiController::class, 'cekJadwal']
  )->name('reservasi.cekJadwal');
});

Route::middleware(['auth', 'role:barberman'])->prefix('barberman')->group(function () {
  Route::get('/index', [BarbermanController::class, 'index'])->name('barberman.dashboard');
  Route::get('/foto', [fotoController::class, 'index'])->name('barberman.foto');
  Route::post('/foto/upload', [fotoController::class, 'store'])->name('barberman.foto.upload');
  // Route::delete('/foto/{id}', [fotoController::class, 'destroy'])
  //   ->name('barberman.foto.destroy');
  Route::get('PengaturanAkun', [PengaturanAkunBarberman::class, 'index'])->name('barberman.PengaturanAkun');
  Route::post('PengaturanAkun/UbahAKun', [PengaturanAkunBarberman::class, 'store'])->name('barberman.UbahAKun');
});

Route::middleware(['auth'])->group(function () {
  Route::get('/auth/logout-basic', [LoginBasic::class, 'logout'])->name('auth-logout-basic');
});
 //Logout
