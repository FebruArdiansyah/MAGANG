<?php

use Livewire\Livewire;
use App\Livewire\BeritaIndex;
use App\Livewire\KlasemenIndex;
use Illuminate\Support\Facades\Route;

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
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', BeritaIndex::class);
Route::get('/klasmen/{kategori?}', KlasemenIndex::class)->name('klasmen');