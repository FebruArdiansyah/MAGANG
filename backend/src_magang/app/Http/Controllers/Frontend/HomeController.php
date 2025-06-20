<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Rekomendasi;
use App\Models\Category;

class HomeController extends Controller
{
    public function __invoke()
    {
        // Ambil berita utama (maks 3) → is_utama = true
        $beritaCarousel = Berita::published()
            ->where('is_utama', true)
            ->latestFirst()
            ->take(3)
            ->get();

        // Ambil ID berita utama
        $utamaIds = $beritaCarousel->pluck('id')->toArray();

        // Ambil berita sorotan (maks 4) → is_sorotan = true & tidak termasuk yang utama
        $subBanner = Berita::published()
            ->where('is_sorotan', true)
            ->when(count($utamaIds), function ($query) use ($utamaIds) {
                return $query->whereNotIn('id', $utamaIds);
            })
            ->latestFirst()
            ->take(4)
            ->get();

        // Ambil berita rekomendasi (dari relasi Rekomendasi)
        $rekomendasi = Rekomendasi::with(['berita.category', 'berita.user'])
            ->latest()
            ->take(6)
            ->get();

        // Ambil berita terpopuler berdasarkan views
        $terpopuler = Berita::published()
            ->orderByDesc('views')
            ->take(5)
            ->get();

        // Ambil klasemen untuk 5 liga
        $kategoriList = Category::whereIn('nama_liga', [
            'Liga Indonesia',
            'Liga Inggris',
            'Liga Italia',
            'Liga Spanyol',
            'Liga Jerman'
        ])
        ->with(['klasmen' => function ($q) {
            $q->orderByDesc('poin')->take(5);
        }])
        ->get();

        return view('frontend.home', compact(
            'beritaCarousel',
            'subBanner',
            'rekomendasi',
            'terpopuler',
            'kategoriList'
        ));
    }
}
