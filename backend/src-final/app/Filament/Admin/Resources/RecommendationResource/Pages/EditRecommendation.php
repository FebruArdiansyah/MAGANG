<?php

namespace App\Filament\Admin\Resources\RecommendationResource\Pages;

use App\Filament\Admin\Resources\RecommendationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRecommendation extends EditRecord
{
    protected static string $resource = RecommendationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
