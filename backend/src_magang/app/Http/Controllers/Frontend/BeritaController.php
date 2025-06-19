<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\View\View;

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

    // Berita terkait dari kategori yang sama, selain berita ini
    $beritaTerkait = Berita::published()
        ->where('category_id', $berita->category_id)
        ->where('id', '!=', $berita->id)
        ->latest()
        ->take(5)
        ->get();

    return view('frontend.berita-show', [
        'berita' => $berita,
        'beritaTerkait' => $beritaTerkait,
    ]);
}
}
