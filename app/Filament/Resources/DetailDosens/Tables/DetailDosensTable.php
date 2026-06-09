<?php

namespace App\Filament\Resources\DetailDosens\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DetailDosensTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sinta_id')
                    ->searchable(),
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('institusi')
                    ->searchable(),
                TextColumn::make('program_studi')
                    ->searchable(),
                TextColumn::make('bidang_minat')
                    ->searchable(),
                TextColumn::make('sinta_score_overall')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sinta_score_3yr')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('affil_score')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('affil_score_3yr')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
