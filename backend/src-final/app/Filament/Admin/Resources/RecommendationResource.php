<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RecommendationResource\Pages;
use App\Filament\Admin\Resources\RecommendationResource\RelationManagers;
use App\Models\Recommendation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RecommendationResource extends Resource
{
    protected static ?string $model = Recommendation::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Manajemen Konten';
    protected static ?string $label = 'Rekomendasi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('berita_id')
                ->relationship('berita', 'judul')
                ->label('Judul Berita')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('category.nama_liga')->label('Liga')->sortable(),
            Tables\Columns\TextColumn::make('berita.judul')->label('Judul Berita')->searchable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('category_id')
                ->relationship('category', 'nama_liga')
                ->label('Filter Liga')
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecommendations::route('/'),
            'create' => Pages\CreateRecommendation::route('/create'),
            'edit' => Pages\EditRecommendation::route('/{record}/edit'),
        ];
    }
}
