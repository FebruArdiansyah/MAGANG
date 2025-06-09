<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Berita;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\BeritaResource\Pages;
use App\Filament\Admin\Resources\BeritaResource\RelationManagers;
use App\Filament\Admin\Resources\BeritaResource\Widgets\BeritaViewsChart;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationGroup = 'Manajemen Konten';

     protected static ?string $label = 'Berita';

     protected static ?string $pluralLabel = 'Berita';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('category_id')
                ->label('Kategori Liga')
                ->relationship('category', 'nama_liga')
                ->required(),

            Forms\Components\Select::make('user_id')
                ->label('Penulis')
                ->relationship('user', 'name')
                ->required(),

            Forms\Components\TextInput::make('judul')->required(),
            Forms\Components\TextInput::make('credit_foto')->label('Kredit Foto'),
            Forms\Components\FileUpload::make('gambar')
                ->image()
                ->directory('berita-images'),

            Forms\Components\Textarea::make('deskripsi')
                ->label('Deskripsi Berita')
                ->rows(5)
                ->required(),

            Forms\Components\Select::make('status')
                ->options([
                    'draft' => 'Draft',
                    'publikasi' => 'Publikasi',
                ])
                ->required(),

            Forms\Components\DateTimePicker::make('tanggal_publish')
                ->label('Tanggal Publish'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('gambar')
            ->label('Gambar')
            ->circular()
            ->height(50)
            ->width(50)
            ->disk('public') // pastikan kamu pakai penyimpanan public
            ->sortable(),
            Tables\Columns\TextColumn::make('judul')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('category.nama_liga')->label('Liga'),
            Tables\Columns\TextColumn::make('user.name')->label('Penulis'),
            Tables\Columns\BadgeColumn::make('status'),
            Tables\Columns\TextColumn::make('tanggal_publish')->dateTime('d M Y H:i'),
            Tables\Columns\TextColumn::make('views')
            ->label('Dilihat')
            ->sortable()
            ->alignRight(),
        ])
        ->defaultSort('tanggal_publish', 'desc')
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getWidgets(): array
    {
        return [
            \App\Filament\Admin\Resources\BeritaResource\Widgets\BeritaViewsChart::class,
        ];
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
