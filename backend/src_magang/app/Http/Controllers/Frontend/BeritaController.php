<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Berita;
use Illuminate\View\View;
use App\Models\Rekomendasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Tampilkan detail sebuah berita berdasarkan slug.
     *
     * Route-model binding otomatis menggunakan kolom `slug`.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\View\View
     */
    public function show(Berita $berita): View
{
    if (
        $berita->status !== 'publikasi' ||
        $berita->tanggal_publish === null ||
        $berita->tanggal_publish->isFuture()
    ) {
        abort(404);
    }

    $berita->increment('views');
    $berita->load('category', 'user');

    $beritaTerkait = Berita::published()
        ->where('category_id', $berita->category_id)
        ->where('id', '!=', $berita->id)
        ->latest()
        ->take(5)
        ->get();

    $rekomendasi = Rekomendasi::with(['berita.category', 'berita.user'])
        ->latest()
        ->take(6)
        ->get();

    $terpopuler = Berita::published()
        ->orderByDesc('views')
        ->take(5)
        ->get();

    return view('frontend.berita-show', [
        'berita' => $berita,
        'beritaTerkait' => $beritaTerkait,
        'rekomendasi' => $rekomendasi,
        'terpopuler' => $terpopuler,
    ]);
}

public function searchAjax(Request $request)
{
    $query = $request->input('q');

    $beritas = Berita::with('category')
        ->published()
        ->where('judul', 'like', "%{$query}%")
        ->orderByDesc('tanggal_publish')
        ->limit(5)
        ->get();

    return response()->json($beritas->map(function ($berita) {
        return [
            'judul'    => $berita->judul,
            'slug'     => $berita->slug,
            'category' => $berita->category->nama ?? '-',
        ];
    }));
}

}
