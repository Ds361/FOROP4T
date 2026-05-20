<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;

Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');

// Dashboard Utama (Daftar Kelas)
Route::get('/', [KelasController::class, 'index'])->name('dashboard');

// Dashboard Detail Kelas
Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('kelas.show');

Route::delete('/absensi/hapus', [AbsensiController::class, 'hapus'])->name('absensi.hapus');
Route::get('/absensi', [AbsensiController::class, 'index']);
Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
Route::post('/absensi/update', [AbsensiController::class, 'updateSingle']);

Route::post('/kelas/check-password', [KelasController::class, 'checkPassword'])->name('kelas.check-password');

Route::get('/cek-server', function () {
    return 'INI LARAVEL';
});
