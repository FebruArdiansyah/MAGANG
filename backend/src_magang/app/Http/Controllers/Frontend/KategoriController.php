<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar berita berdasarkan kategori (liga)
     * Route: /liga/{slug}
     */
    public function show($slug)
    {
        // Ambil kategori berdasarkan slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Ambil semua berita yang terpublikasi dan milik kategori ini
        $beritas = $category->beritas()
                    ->published()
                    ->latestFirst()
                    ->with('user')
                    ->paginate(8);

        return view('frontend.liga.index', compact('category', 'beritas'));
    }
}
