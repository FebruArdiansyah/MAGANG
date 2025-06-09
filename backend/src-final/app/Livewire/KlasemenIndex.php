<?php

namespace App\Livewire;

use App\Models\Klasmen;
use Livewire\Component;
use App\Models\Category;

class KlasemenIndex extends Component
{
    public $kategori = 'Liga Nasional';
    public $kategoriList = [];

    public function mount()
    {
        $this->kategoriList = Category::pluck('nama', 'id')->toArray();
        $this->kategori = collect($this->kategoriList)->first(); // default ke yang pertama
    }

    public function render()
    {
        $selectedCategory = Category::where('nama', $this->kategori)->first();

        $klasemen = $selectedCategory
            ? Klasmen::with(['team'])
                ->where('category_id', $selectedCategory->id)
                ->orderByDesc('poin')
                ->get()
            : collect();

        return view('livewire.klasmen-index', [
            'klasemen' => $klasemen,
        ]);
    }
}
