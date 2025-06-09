<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\KlasmenResource\Pages;
use App\Filament\Admin\Resources\KlasmenResource\RelationManagers;
use App\Models\Klasmen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KlasmenResource extends Resource
{
    protected static ?string $model = Klasmen::class;
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';
    protected static ?string $navigationGroup = 'Manajemen Klasmen';
    protected static ?string $label = 'Klasmen';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('category_id')
                ->relationship('category', 'nama_liga')->required(),
            Forms\Components\TextInput::make('nama_tim')->required(),
            Forms\Components\TextInput::make('jumlah_pertandingan')->numeric()->required(),
            Forms\Components\TextInput::make('menang')->numeric()->required(),
            Forms\Components\TextInput::make('seri')->numeric()->required(),
            Forms\Components\TextInput::make('kalah')->numeric()->required(),
            Forms\Components\TextInput::make('selisih_gol')->numeric()->required(),
            Forms\Components\TextInput::make('poin')->numeric()->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('category.nama_liga')->label('Liga'),
            Tables\Columns\TextColumn::make('nama_tim')->label('Tim'),
            Tables\Columns\TextColumn::make('jumlah_pertandingan'),
            Tables\Columns\TextColumn::make('menang'),
            Tables\Columns\TextColumn::make('seri'),
            Tables\Columns\TextColumn::make('kalah'),
            Tables\Columns\TextColumn::make('selisih_gol'),
            Tables\Columns\TextColumn::make('poin')->sortable(),
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
            'index' => Pages\ListKlasmens::route('/'),
            'create' => Pages\CreateKlasmen::route('/create'),
            'edit' => Pages\EditKlasmen::route('/{record}/edit'),
        ];
    }
}
