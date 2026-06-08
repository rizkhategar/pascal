<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeHeroSlideResource\Pages;
use App\Models\HomeHeroSlide;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use UnitEnum;

class HomeHeroSlideResource extends Resource
{
    protected static ?string $model = HomeHeroSlide::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Hero Campus';

    protected static ?string $modelLabel = 'Hero Campus';

    protected static ?string $pluralModelLabel = 'Hero Campus';

    protected static string|UnitEnum|null $navigationGroup = 'Beranda';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Placeholder::make('upload_info')
                    ->label('Pengaturan Hero Campus')
                    ->content('Gunakan tombol Tambah/Edit dari tabel. Upload gambar memakai form biasa agar tidak stuck di Uploading 100%.'),

                TextInput::make('title')
                    ->label('Judul')
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('subtitle')
                    ->label('Subtitle')
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('image_path')
                    ->label('Path Gambar')
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->disabled()
                    ->dehydrated(false),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->disabled()
                    ->dehydrated(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Gambar')
                    ->getStateUsing(fn (HomeHeroSlide $record): ?string => $record->image_path && Storage::disk('public')->exists($record->image_path)
                        ? Storage::disk('public')->url($record->image_path)
                        : null)
                    ->height(72)
                    ->width(128)
                    ->square(false),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(42),

                TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->searchable()
                    ->limit(42),

                TextColumn::make('image_path')
                    ->label('Path')
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->recordActions([
                EditAction::make()
                    ->url(fn (HomeHeroSlide $record): string => route('admin.home-hero-slides.edit-custom', $record)),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomeHeroSlides::route('/'),
            'create' => Pages\CreateHomeHeroSlide::route('/create'),
            'edit' => Pages\EditHomeHeroSlide::route('/{record}/edit'),
        ];
    }
}
