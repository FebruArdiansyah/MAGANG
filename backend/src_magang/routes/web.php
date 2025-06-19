<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Frontend\KlasmenController;
use App\Http\Controllers\Frontend\KategoriController;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
Route::get('/', HomeController::class)
    ->name('home');

// Detail Berita (SEO-friendly slug)
Route::get('/berita/{slug}', [BeritaController::class, 'show'])
    ->name('berita.show');

    Route::get('/liga/{slug}', [KategoriController::class, 'show'])->name('kategori.show');

Route::get('/klasmen', [KlasmenController::class, 'index'])->name('klasmen.index');
