<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AboutController;

Route::get('/', function () {
    return redirect()->route('surat.index');
});

Route::prefix('surat')->name('surat.')->group(function () {
    Route::get('/', [SuratController::class, 'index'])->name('index');
    Route::get('/create', [SuratController::class, 'create'])->name('create');
    Route::post('/', [SuratController::class, 'store'])->name('store');
    Route::get('/{surat}/view', [SuratController::class, 'show'])->name('show');
    Route::get('/edit/{surat}', [SuratController::class, 'edit'])->name('edit');
    Route::put('/update/{surat}', [SuratController::class, 'update'])->name('update');
    Route::delete('/{surat}', [SuratController::class, 'destroy'])->name('destroy');

    // Route khusus download file surat
    Route::get('/unduh/{surat}', [SuratController::class, 'download'])->name('download');
});

Route::prefix('kategori')->name('kategori.')->group(function () {
    Route::get('/', [KategoriController::class, 'index'])->name('index');
    Route::get('/create', [KategoriController::class, 'create'])->name('create');
    Route::post('/', [KategoriController::class, 'store'])->name('store');
    Route::get('/{kategori}/edit', [KategoriController::class, 'edit'])->name('edit');
    Route::put('/{kategori}', [KategoriController::class, 'update'])->name('update');
    Route::delete('/{kategori}', [KategoriController::class, 'destroy'])->name('destroy');
});

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
