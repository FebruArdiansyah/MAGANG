<?php

use Livewire\Livewire;
use App\Livewire\Frontend\IndexPage;
use Illuminate\Support\Facades\Route;
use App\Livewire\Frontend\DetailBerita;

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

// Update route utama ke komponen Livewire
Route::get('/', IndexPage::class)->name('home');
Route::get('/berita/{id}', DetailBerita::class)->name('berita.detail');
Route::get('/klasmen', \App\Livewire\Frontend\KlasemenPage::class);
