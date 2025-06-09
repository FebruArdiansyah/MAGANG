<?php

namespace App\Livewire;

use App\Models\Berita;
use App\Models\Klasmen;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')] // ✅ Tambahkan ini
class BeritaIndex extends Component
{
    public function render()
    {
        return view('livewire.berita-index', [
            'beritas' => Berita::latest()->take(4)->get(),             // Carousel
            'subBanners' => Berita::latest()->skip(4)->take(4)->get(), // Sub Banner
            'rekomendasis' => Berita::latest()->skip(8)->take(6)->get(), // Rekomendasi
            'populers' => Berita::orderBy('views', 'desc')->take(5)->get(), // Terpopuler
            'klasemens' => Klasmen::with('team')->where('category_id', 1)->orderByDesc('poin')->take(5)->get()
        ]);
    }
}
