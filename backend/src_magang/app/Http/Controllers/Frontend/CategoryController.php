<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Berita;
use App\Models\Category;
use App\Models\Rekomendasi;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(string $slug): View
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $beritaUtama = Berita::published()
            ->where('category_id', $category->id)
            ->latest('tanggal_publish')
            ->first();

        $beritaPendamping = Berita::published()
            ->where('category_id', $category->id)
            ->where('id', '!=', optional($beritaUtama)->id)
            ->latest('tanggal_publish')
            ->take(4)
            ->get();

        $subBanners = Berita::published()
            ->where('category_id', $category->id)
            ->latest('tanggal_publish')
            ->skip(5)
            ->take(4)
            ->get();

        $rekomendasis = Rekomendasi::with('berita')
            ->where('category_id', $category->id)
            ->take(6)
            ->get();

        $terpopuler = Berita::published()
            ->where('category_id', $category->id)
            ->orderByDesc('views')
            ->take(5)
            ->get();

        return view('frontend.liga-show', [
            'category' => $category,
            'beritaUtama' => $beritaUtama,
            'beritaPendamping' => $beritaPendamping,
            'subBanners' => $subBanners,
            'rekomendasis' => $rekomendasis,
            'terpopuler' => $terpopuler,
        ]);
    }
}
