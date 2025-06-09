<?php

namespace App\Filament\Admin\Resources\BeritaResource\Widgets;

use App\Models\Berita;
use Filament\Widgets\ChartWidget;

class BeritaViewsChart extends ChartWidget
{
    protected static ?string $heading = 'Top 5 Berita Terpopuler';

    protected function getData(): array
    {
        $data = Berita::where('status', 'publikasi')
            ->orderByDesc('views')
            ->take(5)
            ->get(['judul', 'views']);

        return [
            'datasets' => [
                [
                    'label' => 'Views',
                    'data' => $data->pluck('views'),
                ]
            ],
            'labels' => $data->pluck('judul'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
