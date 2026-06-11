<?php

namespace App\Filament\Resources\Sliders\Tables;

use App\Filament\Resources\Sliders\SliderResource;
use App\Models\Slider;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class SlidersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Image')
                    ->getStateUsing(fn (Slider $record): ?string => $record->image_path && Storage::disk('public')->exists($record->image_path)
                        ? route('sliders.image', $record)
                        : null)
                    ->height(72)
                    ->width(128)
                    ->square(false),

                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->limit(42),

                TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->searchable()
                    ->limit(42),

                TextColumn::make('sort_order')
                    ->label('Sort Order')
                    ->sortable(),

                TextColumn::make('duration_ms')
                    ->label('Duration')
                    ->formatStateUsing(fn (?int $state): string => (($state ?? 3000) / 1000) . ' seconds')
                    ->sortable(),

                TextColumn::make('image_path')
                    ->label('Path')
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->recordActions([
                EditAction::make()
                    ->url(fn (Slider $record): string => SliderResource::getUrl('edit', ['record' => $record])),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
