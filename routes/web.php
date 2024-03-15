<?php

use App\Http\Controllers\Peserta\DaftarController;
use App\Http\Controllers\Peserta\DashboardController;
use App\Http\Controllers\Peserta\DataPesertaController;
use App\Http\Controllers\Peserta\DataPrestasiController;
use App\Http\Controllers\Peserta\DetailPesertaController;
use App\Http\Controllers\Peserta\LoginController;
use App\Http\Controllers\Peserta\PendaftaranController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('guest')->group(function () {
   Route::get('/login', LoginController::class)->name('peserta.login');
   Route::post('/login', [LoginController::class, 'authenticate'])->name('peserta.login');
   Route::get('/daftar', DaftarController::class)->name('peserta.daftar');
   Route::post('/daftar', [DaftarController::class, 'store'])->name('peserta.daftar.simpan');
});


Route::prefix('peserta')->name('peserta.')->middleware('auth')->group(function () {
   Route::get('/', DashboardController::class)->name('index');
   Route::get('/detail', DetailPesertaController::class)->name('detail');
   /**
    * Controller data peserta
    */
   Route::controller(App\Http\Controllers\Peserta\DataPesertaController::class)->group(function () {
      Route::get('data-peserta/edit', 'edit')->name('data-peserta.edit');
      Route::patch('data-peserta/simpan', 'simpan')->name('data-peserta.simpan');
   });
   /**
    * Data orang tua
    */
   Route::controller(App\Http\Controllers\Peserta\DataOrangTuaController::class)->group(function () {
      Route::get('data-orang-tua/edit', 'edit')->name('data-orang-tua.edit');
      Route::patch('data-orang-tua/simpan', 'simpan')->name('data-orang-tua.simpan');
   });
   Route::get('/data-prestasi', [App\Http\Controllers\Peserta\DataPrestasiController::class, 'index'])->name('data-prestasi.index');
   Route::controller(App\Http\Controllers\Peserta\DataPrestasiController::class)->group(function () {
      Route::get('/data-prestasi/tambah','create')->name('data-prestasi.tambah');
      Route::post('/data-prestasi/tambah','store')->name('data-prestasi.simpan');
      Route::delete('/data-prestasi/{id}/delete','destroy')->name('data-prestasi.delete');
      Route::patch('/data-prestasi/{id}/edit','update')->name('data-prestasi.update');
   });
});
