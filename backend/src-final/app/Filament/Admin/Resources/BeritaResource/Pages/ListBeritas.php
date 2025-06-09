<?php

namespace App\Filament\Admin\Resources\BeritaResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Admin\Resources\BeritaResource;
use App\Filament\Admin\Resources\BeritaResource\Widgets\BeritaViewsChart;

class ListBeritas extends ListRecords
{
    protected static string $resource = BeritaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
        \App\Filament\Admin\Resources\BeritaResource\Widgets\BeritaViewsChart::class,
    ];
    }
}
