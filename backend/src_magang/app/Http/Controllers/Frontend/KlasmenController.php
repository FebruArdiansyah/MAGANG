<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class KlasmenController extends Controller
{
    public function index()
    {
        // Ambil semua kategori liga beserta relasi klasemennya (sorted by poin descending)
        $kategoriList = Category::with(['klasmen' => function($query) {
            $query->orderByDesc('poin');
        }])->get();

        return view('frontend.klasmen', compact('kategoriList'));
    }
}
