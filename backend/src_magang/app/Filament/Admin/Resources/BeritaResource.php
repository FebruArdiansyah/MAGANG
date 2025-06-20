<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Berita;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\BeritaResource\Pages;
use App\Filament\Admin\Resources\BeritaResource\RelationManagers;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationIcon  = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int    $navigationSort  = 11;
    protected static ?string $label          = 'Berita';
    protected static ?string $pluralLabel    = 'Berita';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Tabs::make('Pengelolaan Berita')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Konten')
                            ->icon('heroicon-o-pencil-square')
                            ->schema([
                                Forms\Components\TextInput::make('judul')
                                    ->label('Judul Berita')
                                    ->placeholder('Contoh: Persib Juara Liga 1 2025')
                                    ->live(onBlur: true)
                                    ->required()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $set('slug', Str::slug($state));
                                    }),

                                Forms\Components\RichEditor::make('deskripsi')
                                    ->label('Isi Berita')
                                    ->toolbarButtons([
                                        'bold', 'italic', 'underline', 'strike', 'link', 'bulletList', 'orderedList',
                                        'blockquote', 'codeBlock', 'h2', 'h3', 'align', 'redo', 'undo', 'attachFiles',
                                    ])
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('berita-attachments')
                                    ->required(),

                                Forms\Components\FileUpload::make('gambar')
                                    ->label('Gambar Utama')
                                    ->directory('berita')
                                    ->image()
                                    ->imageResizeMode('cover')
                                    ->imagePreviewHeight('250')
                                    ->maxSize(2048)
                                    ->helperText('Rasio disarankan 16:9, maksimal 2\u00a0MB.'),

                                Forms\Components\TextInput::make('credit_foto')
                                    ->label('Kredit Foto')
                                    ->placeholder('Nama Fotografer / Sumber')
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Publikasi')
                            ->icon('heroicon-o-light-bulb')
                            ->schema([
                                Forms\Components\Select::make('category_id')
                                    ->label('Kategori Liga')
                                    ->relationship('category', 'nama_liga')
                                    ->required(),

                                Forms\Components\Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'draft'     => 'Draft',
                                        'publikasi' => 'Publikasi',
                                    ])
                                    ->default('draft')
                                    ->required(),

                                Forms\Components\DateTimePicker::make('tanggal_publish')
    ->label('Tanggal Publish')
    ->default(now()) // otomatis isi sekarang
    ->seconds(false)
                                    ->helperText('Isi jika ingin terbit otomatis di waktu tertentu.'),

                                Forms\Components\Toggle::make('is_utama')
                                    ->label('Tampilkan di Berita Utama (Carousel)')
                                    ->helperText('Maksimal 3 berita bisa ditandai sebagai utama.')
                                    ->default(false)
                                    ->afterStateUpdated(function ($state, callable $set, $get, ?\App\Models\Berita $record) {
                                        if ($state) {
                                            $count = \App\Models\Berita::where('is_utama', true)
                                                ->when($record, fn ($q) => $q->where('id', '!=', $record->id))
                                                ->count();
                                            if ($count >= 3) {
                                                $set('is_utama', false);
                                                notify()->error('Gagal: Maksimal 3 berita utama diperbolehkan.');
                                            }
                                        }
                                    }),

                                Forms\Components\Toggle::make('is_sorotan')
                                    ->label('Tampilkan di Sorotan (Sub Banner)')
                                    ->helperText('Maksimal 4 berita bisa ditandai sebagai sorotan.')
                                    ->default(false)
                                    ->afterStateUpdated(function ($state, callable $set, $get, ?\App\Models\Berita $record) {
                                        if ($state) {
                                            $count = \App\Models\Berita::where('is_sorotan', true)
                                                ->when($record, fn ($q) => $q->where('id', '!=', $record->id))
                                                ->count();
                                            if ($count >= 4) {
                                                $set('is_sorotan', false);
                                                notify()->error('Gagal: Maksimal 4 berita sorotan diperbolehkan.');
                                            }
                                        }
                                    }),

                                Forms\Components\Placeholder::make('views')
                                    ->label('Jumlah Views')
                                    ->content(fn($record) => $record?->views ?? 0),

                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Dibuat pada')
                                    ->content(fn($record) => $record ? $record->created_at->format('d M Y H:i') : '—'),
                            ]),
                    ])
                    ->columnSpanFull(),

                Forms\Components\Hidden::make('user_id')
                    ->default(fn() => auth()->id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->paginated([10, 25, 50])
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Foto')
                    ->square()
                    ->size(60)
                    ->extraImgAttributes(['class' => 'rounded-lg'])
                    ->toggleable(isToggledHiddenByDefault: false),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap(),

                Tables\Columns\TextColumn::make('category.nama_liga')
                    ->label('Kategori')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'gray'    => 'draft',
                        'success' => 'publikasi',
                    ])
                    ->icons([
                        'heroicon-o-pencil-square' => 'draft',
                        'heroicon-o-check-circle'  => 'publikasi',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_publish')
                    ->label('Publish')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('views')
                    ->label('👁️')
                    ->alignRight()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_utama')
                    ->label('Utama')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_sorotan')
                    ->label('Sorotan')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft'     => 'Draft',
                        'publikasi' => 'Publikasi',
                    ]),
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'nama_liga'),
                Tables\Filters\TernaryFilter::make('is_utama')
                    ->label('Berita Utama')
                    ->placeholder('Semua')
                    ->trueLabel('Ya')
                    ->falseLabel('Tidak'),
                Tables\Filters\TernaryFilter::make('is_sorotan')
                    ->label('Berita Sorotan')
                    ->placeholder('Semua')
                    ->trueLabel('Ya')
                    ->falseLabel('Tidak'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                ->label('Aksi'),
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
