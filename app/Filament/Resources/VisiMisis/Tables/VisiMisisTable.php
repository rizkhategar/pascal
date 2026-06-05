<?php

namespace App\Filament\Resources\VisiMisis\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn; // Tambahkan import TextColumn
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class VisiMisisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('visi')
                    ->label('Visi')
                    ->html() // Mengubah tag HTML dari RichEditor menjadi teks normal
                    ->limit(50), // Membatasi jumlah karakter yang tampil di tabel
                    
                TextColumn::make('misi')
                    ->label('Misi')
                    ->html()
                    ->limit(50),
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