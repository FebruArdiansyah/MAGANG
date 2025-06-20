<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Rekomendasi;
use Filament\Resources\Resource;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Admin\Resources\RekomendasiResource\Pages;

class RekomendasiResource extends Resource
{
    protected static ?string $model = Rekomendasi::class;

    protected static ?string $navigationIcon  = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int    $navigationSort  = 12;
    protected static ?string $label           = 'Rekomendasi';
    protected static ?string $pluralLabel     = 'Daftar Rekomendasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('berita_id')
                            ->label('Berita')
                            ->options(function (callable $get) {
                                $kategoriId = $get('category_id');

                                return \App\Models\Berita::published()
                                    ->where('is_utama', false)
                                    ->where('is_sorotan', false)
                                    ->whereDoesntHave('rekomendasis', function ($query) use ($kategoriId) {
                                        if ($kategoriId) {
                                            $query->where('category_id', $kategoriId);
                                        }
                                    })
                                    ->when($kategoriId, function ($query) use ($kategoriId) {
                                        $query->where('category_id', $kategoriId);
                                    })
                                    ->pluck('judul', 'id');
                            })
                            ->searchable()
                            ->preload()
                            ->required()
                            ->hint('Hanya berita “publikasi”, belum direkomendasikan, dan bukan headline/sorotan')
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->columnSpanFull()
                    ->compact(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->paginated([10, 25, 50])
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('berita.gambar')
                    ->label('Foto')
                    ->disk('public')
                    ->size(50)
                    ->extraImgAttributes(['class' => 'rounded-md'])
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('berita.judul')
                    ->label('Judul Berita')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->weight('semibold'),

                Tables\Columns\BadgeColumn::make('category.nama_liga')
                    ->label('Kategori')
                    ->colors(['primary' => fn ($state) => true]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'nama_liga'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->label('Aksi'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['berita', 'category']);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListRekomendasis::route('/'),
            'create' => Pages\CreateRekomendasi::route('/create'),
            'edit'   => Pages\EditRekomendasi::route('/{record}/edit'),
        ];
    }
}
