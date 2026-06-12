<?php

namespace App\Filament\Resources\DetailDosens\Tables;

// Import Resource utama agar bisa membaca rute URL panel
use App\Filament\Resources\DetailDosens\DetailDosenResource; 

use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DetailDosensTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sinta_id')->searchable()->sortable(),
                TextColumn::make('nama')->searchable(),
                TextColumn::make('institusi')->searchable(),
                TextColumn::make('program_studi')->searchable(),
                TextColumn::make('jurusan')->searchable(),
                TextColumn::make('bidang_minat')->searchable(),
                TextColumn::make('sinta_score_overall')->numeric()->sortable(),
                TextColumn::make('sinta_score_3yr')->numeric()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // PERBAIKAN: Paksa mengarah ke rute halaman penuh via getUrl()
                ViewAction::make()
                    ->url(fn ($record) => DetailDosenResource::getUrl('view', ['record' => $record])),
                
                EditAction::make()
                    ->url(fn ($record) => DetailDosenResource::getUrl('edit', ['record' => $record])),
                
                DeleteAction::make(), 
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}