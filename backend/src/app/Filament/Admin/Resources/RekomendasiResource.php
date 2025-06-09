<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RekomendasiResource\Pages;
use App\Filament\Admin\Resources\RekomendasiResource\RelationManagers;
use App\Models\Rekomendasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RekomendasiResource extends Resource
{
    protected static ?string $model = Rekomendasi::class;

    protected static ?string $navigationGroup = 'Manajemen Konten';

    protected static ?string $label = 'Rekomendasi';

    protected static ?string $pluralLabel = 'Rekomendasi';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('berita_id')
                ->relationship('berita', 'judul')
                ->label('Judul Berita')
                ->required(),
                Forms\Components\Select::make('category_id')
                ->label('Kategori Liga')
                ->relationship('category', 'nama_liga')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('berita_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListRekomendasis::route('/'),
            'create' => Pages\CreateRekomendasi::route('/create'),
            'edit' => Pages\EditRekomendasi::route('/{record}/edit'),
        ];
    }
}
