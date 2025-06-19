<?php

namespace App\Filament\Admin\Resources\KlasmenResource\Pages;

use App\Filament\Admin\Resources\KlasmenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlasmens extends ListRecords
{
    protected static string $resource = KlasmenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
