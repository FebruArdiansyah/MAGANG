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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['jumlah_pertandingan'] = $data['menang'] + $data['seri'] + $data['kalah'];
        $data['poin'] = ($data['menang'] * 3) + $data['seri'];
        return $data;
    }
}
