<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Klasmen;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Validation\Rule;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\KlasmenResource\Pages;
use App\Filament\Admin\Resources\KlasmenResource\RelationManagers;

class KlasmenResource extends Resource
{
    protected static ?string $model = Klasmen::class;

     protected static ?string $navigationIcon  = 'heroicon-o-list-bullet';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int    $navigationSort  = 13;
    protected static ?string $label          = 'Klasemen';
    protected static ?string $pluralLabel    = 'Klasemen';

     protected static function syncMainPoin(callable $set, callable $get): void
    {
        $w = (int) $get('menang');
        $d = (int) $get('seri');
        $l = (int) $get('kalah');

        $main = $w + $d + $l;
        $poin = ($w * 3) + $d;

        $set('jumlah_pertandingan', $main);
        $set('poin', $poin);
    }

    /* --------------------------------------------------------------
     | FORM
     |-------------------------------------------------------------- */
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Card::make()->schema([
                Forms\Components\Select::make('category_id')
                    ->label('Liga')
                    ->relationship('category', 'nama_liga')
                    ->required(),

                Forms\Components\TextInput::make('nama_tim')
                    ->label('Nama Tim')
                    ->required()
                    ->rules([
                        fn(Get $get, ?Klasmen $record = null) => Rule::unique('klasmens', 'nama_tim')
                            ->where(fn($q) => $q->where('category_id', $get('category_id')))
                            ->ignore($record?->id),
                    ]),

                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\TextInput::make('menang')
                        ->numeric()->minValue(0)->default(0)->label('Menang')
                        ->reactive()
                        ->afterStateUpdated(fn($state,$set,$get)=>static::syncMainPoin($set,$get)),
                    Forms\Components\TextInput::make('seri')
                        ->numeric()->minValue(0)->default(0)->label('Seri')
                        ->reactive()
                        ->afterStateUpdated(fn($state,$set,$get)=>static::syncMainPoin($set,$get)),
                    Forms\Components\TextInput::make('kalah')
                        ->numeric()->minValue(0)->default(0)->label('Kalah')
                        ->reactive()
                        ->afterStateUpdated(fn($state,$set,$get)=>static::syncMainPoin($set,$get)),

                    Forms\Components\TextInput::make('jumlah_pertandingan')
                        ->numeric()->disabled()->dehydrated()->label('Main'),
                    Forms\Components\TextInput::make('selisih_gol')
                        ->numeric()->default(0)->label('Selisih Gol')->reactive(),
                    Forms\Components\TextInput::make('poin')
                        ->numeric()->disabled()->dehydrated()->label('Poin'),
                ])->columnSpanFull(),
            ])->columnSpanFull()->compact(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('poin', 'desc')
            ->defaultSort('selisih_gol', 'desc')
            ->defaultSort('menang', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('rank')
                    ->label('#')
                    ->state(fn ($record, $rowLoop) => $rowLoop->iteration),

                Tables\Columns\TextColumn::make('nama_tim')
                    ->label('Tim')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('jumlah_pertandingan')->label('M')->sortable(),
                Tables\Columns\TextColumn::make('menang')->label('W')->sortable(),
                Tables\Columns\TextColumn::make('seri')->label('D')->sortable(),
                Tables\Columns\TextColumn::make('kalah')->label('L')->sortable(),

                Tables\Columns\TextColumn::make('selisih_gol')->label('SG')->sortable(),

                Tables\Columns\BadgeColumn::make('poin')
                    ->label('Pts')
                    ->colors([
                        'success' => fn($state) => $state >= 70,
                        'warning' => fn($state) => $state < 70 && $state >= 40,
                        'danger'  => fn($state) => $state < 40,
                    ])
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Liga')
                    ->relationship('category', 'nama_liga'),
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
