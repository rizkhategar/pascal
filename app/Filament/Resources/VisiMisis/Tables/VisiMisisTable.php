<?php

namespace App\Filament\Resources\VisiMisis\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class VisiMisisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('hero_image')
                    ->label('Banner Latar')
                    ->disk('public')
                    ->square()
                    ->size(50), 

                TextColumn::make('hero_title')
                    ->label('Judul Halaman')
                    ->weight('bold'), // Menghapus ->searchable() di sini

                TextColumn::make('visi')
                    ->label('Preview Visi')
                    ->html()
                    ->limit(60)
                    ->color('gray')
                    ->wrap(),

                TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime('d M Y, H:i')
                    ->sortable(), // Menghapus ->toggleable(...) di sini
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->button()
                    ->color('primary'),
                    
                DeleteAction::make()
                    ->button()
                    ->color('danger'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->paginated(false);
    }
}