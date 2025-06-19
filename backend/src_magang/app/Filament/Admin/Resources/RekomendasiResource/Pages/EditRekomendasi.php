<?php

namespace App\Filament\Admin\Resources\RekomendasiResource\Pages;

use App\Filament\Admin\Resources\RekomendasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRekomendasi extends EditRecord
{
    protected static string $resource = RekomendasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
