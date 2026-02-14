<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\TransaksiController;
use App\Models\Pegawai;
use App\Models\Gaji; // Tambahkan import model di sini agar lebih rapi
use Illuminate\Support\Facades\Route;

// 1. Halaman Utama langsung ke Login
Route::get('/', function () {
    return view('auth.login');
});

// 2. Rute Dashboard
Route::get('/dashboard', function () {
    $totalPegawai = Pegawai::count(); 
    $totalGaji = Gaji::sum('total_diterima') ?? 0; 

    return view('dashboard', compact('totalPegawai', 'totalGaji'));
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Rute yang membutuhkan Login (Auth)
Route::middleware('auth')->group(function () {
    // Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Master Data Pegawai, Pendidikan, & Bagian
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('pendidikan', PendidikanController::class);
    Route::resource('bagian', BagianController::class);

    // RUTE KHUSUS GAJI
    // Penting: Taruh custom route (export-pdf) SEBELUM resource route
    Route::get('/gaji/export-pdf', [GajiController::class, 'exportPdf'])->name('gaji.exportPdf');
    Route::resource('gaji', GajiController::class);

    Route::get('/gaji/{id}/slip', [GajiController::class, 'downloadSlip'])->name('gaji.slip');


    //TRANSAKSI 
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');

});

// 4. Load rute bawaan Laravel Breeze
require __DIR__.'/auth.php';