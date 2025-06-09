<?php

namespace App\Livewire\Frontend;

use App\Models\Berita;
use App\Models\Rekomendasi;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class DetailBerita extends Component
{
    public $id;

    public function render()
    {
        $berita = Berita::with('user', 'category')->findOrFail($this->id);

        $beritaTerkait = Berita::where('category_id', $berita->category_id)
            ->where('id', '!=', $berita->id)
            ->where('status', 'publikasi')
            ->latest('tanggal_publish')
            ->take(5)
            ->get();

        $rekomendasi = Rekomendasi::with('berita.category', 'berita.user')
            ->latest()
            ->take(6)
            ->get();

        $terpopuler = Berita::where('status', 'publikasi')
            ->orderByDesc('views')
            ->take(5)
            ->get();

        return view('livewire.frontend.detail-berita', [
            'berita' => $berita,
            'beritaTerkait' => $beritaTerkait,
            'rekomendasi' => $rekomendasi,
            'terpopuler' => $terpopuler,
        ]);
    }
}
