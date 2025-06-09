<?php

namespace App\Filament\Admin\Resources\KlasmenResource\Pages;

use App\Filament\Admin\Resources\KlasmenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlasmen extends EditRecord
{
    protected static string $resource = KlasmenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
