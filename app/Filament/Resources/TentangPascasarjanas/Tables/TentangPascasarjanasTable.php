<?php

namespace App\Filament\Resources\TentangPascasarjanas\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class TentangPascasarjanasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subheading')
                    ->label('Sub Judul')
                    ->weight('bold'),
                    
                TextColumn::make('heading')
                    ->label('Judul Utama')
                    ->limit(40),
                    
                TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()->button()->color('primary'),
                DeleteAction::make()->button()->color('danger'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->paginated(false); // Karena datanya cuma 1
    }
}