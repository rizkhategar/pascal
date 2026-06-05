<?php

namespace App\Filament\Resources\VisiMisis\Tables;

use Filament\Tables\Table;
// Perbaikan Import Namespace untuk Filament v4
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class VisiMisisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Pastikan untuk mengembalikan konfigurasi kolom kamu di sini jika sebelumnya ada
            ])
            ->filters([
                //
            ])
            // Perubahan nama fungsi baris (row) menjadi recordActions
            ->recordActions([
                EditAction::make(),
            ])
            // Perubahan nama fungsi atas menjadi toolbarActions
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}