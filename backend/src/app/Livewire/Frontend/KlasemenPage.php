<?php

namespace App\Livewire\Frontend;

use App\Models\Klasmen;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class KlasemenPage extends Component
{
    public $activeTab = 'liga-nasional';
    public $categories = [];
    public $klasemens = [];

    public function mount()
    {
        $this->categories = Category::all();
        $this->updateKlasemen($this->activeTab);
    }

    public function updateTab($tab)
    {
        $this->activeTab = $tab;
        $this->updateKlasemen($tab);
    }

    public function updateKlasemen($tab)
{
    // Langsung cocokkan 'liga-nasional', 'liga-jerman' dengan nama liga
    $category = Category::get()->first(function ($cat) use ($tab) {
        return Str::slug('liga ' . $cat->nama_liga) === $tab;
    });

    $this->klasemens = $category
        ? Klasmen::where('category_id', $category->id)->orderByDesc('poin')->get()
        : [];

    $this->selectedTab = $tab;
}

    public function render()
    {
        return view('livewire.frontend.klasemen-page');
    }
}
