<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Rekomendasi;
use App\Models\Klasmen;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman beranda.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(): View
    {
        // 1) Carousel: 4 berita terbaru
        $beritaCarousel = Cache::remember(
            'home:carousel',
            now()->addMinutes(5),
            fn () => Berita::published()
                          ->latestFirst()
                          ->with('category', 'user')
                          ->limit(4)
                          ->get()
        );

        // 2) Sub-banner: 4 berita berikutnya
        $subBanner = Cache::remember(
            'home:subBanner',
            now()->addMinutes(5),
            fn () => Berita::published()
                          ->latestFirst()
                          ->with('category', 'user')
                          ->skip(4)
                          ->limit(4)
                          ->get()
        );

        // 3) Rekomendasi: 6 entri dari tabel rekomendasis
        $rekomendasi = Cache::remember(
            'home:rekomendasi',
            now()->addMinutes(10),
            fn () => Rekomendasi::with([
                                'berita.category',
                                'berita.user',
                                'category',
                            ])
                            ->latest()
                            ->limit(6)
                            ->get()
        );

        // 4) Terpopuler: 5 berita dengan views terbanyak
        $terpopuler = Cache::remember(
            'home:terpopuler',
            now()->addMinutes(10),
            fn () => Berita::published()
                          ->with('category')
                          ->orderByDesc('views')
                          ->limit(5)
                          ->get()
        );

        // 5) Klasemen Top-5 untuk Liga Nasional (category_id = 1)
        $klasmenTop5 = Cache::remember(
            'home:klasmenTop5',
            now()->addMinutes(30),
            fn () => Klasmen::where('category_id', 1)
                            ->orderByDesc('poin')
                            ->orderByDesc('selisih_gol')
                            ->limit(5)
                            ->get()
        );

        return view('frontend.home', compact(
            'beritaCarousel',
            'subBanner',
            'rekomendasi',
            'terpopuler',
            'klasmenTop5'
        ));
    }
}
