<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\GajiController;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Route;

// 1. Halaman Utama langsung ke Login
Route::get('/', function () {
    return view('auth.login');
});

// 2. Rute Dashboard dengan hitung total pegawai
Route::get('/dashboard', function () {
    $totalPegawai = Pegawai::count(); 
    return view('dashboard', compact('totalPegawai'));
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Rute yang membutuhkan Login (Auth)
Route::middleware('auth')->group(function () {
    // Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cukup gunakan Resource Route untuk semua data master
    // Ini otomatis mencakup: index, create, store, edit, update, destroy
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('pendidikan', PendidikanController::class);
    Route::resource('bagian', BagianController::class);
    Route::resource('gaji', GajiController::class);
});

// 4. Load rute bawaan Laravel Breeze
require __DIR__.'/auth.php';