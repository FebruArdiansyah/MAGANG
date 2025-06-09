<?php

namespace App\Livewire\Frontend;

use App\Models\Berita;
use App\Models\Klasmen;
use Livewire\Component;
use App\Models\Category;
use App\Models\Rekomendasi;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class IndexPage extends Component
{

    public $selectedLigaId;
    public $selectedLigaName;
    public $ligas;
    public $klasemen;

    public function mount()
{
    $this->ligas = Category::all();
    $this->selectedLigaId = $this->ligas->first()?->id;
    $this->selectedLigaName = $this->ligas->first()?->nama_liga;
    $this->loadKlasemen();
}

    public function selectLiga($id)
{
    $liga = Category::find($id);
    if ($liga) {
        $this->selectedLigaId = $id;
        $this->selectedLigaName = $liga->nama_liga;
        $this->loadKlasemen();
    }
}

public function loadKlasemen()
{
    $this->klasemen = Klasmen::where('category_id', $this->selectedLigaId)
        ->orderByDesc('poin')
        ->get();
}

    public function render()
    {
        return view('livewire.frontend.index-page', [
    'carousel' => Berita::latest('tanggal_publish')->where('status', 'publikasi')->take(4)->get(),
    'subBanners' => Berita::latest('tanggal_publish')->where('status', 'publikasi')->skip(4)->take(4)->get(),
    'klasemen' => Klasmen::orderByDesc('poin')->take(5)->get(),
    'rekomendasi' => Rekomendasi::with('berita.category', 'berita.user')->latest()->take(6)->get(),
    'terpopuler' => Berita::orderByDesc('views')->where('status', 'publikasi')->take(5)->get(),
    'ligas' => Category::all()
]);

    }
}
