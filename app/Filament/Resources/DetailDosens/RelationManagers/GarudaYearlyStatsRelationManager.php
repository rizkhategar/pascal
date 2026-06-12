<?php

namespace App\Filament\Resources\DetailDosens\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class GarudaYearlyStatsRelationManager extends RelationManager
{
    protected static string $relationship = 'garudaYearlyStats';
    protected static ?string $title = 'Statistik Tahunan Garuda';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('tahun')->required(),
            TextInput::make('articles')->numeric()->label('Artikel')->default(0)->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('tahun')
            ->columns([
                TextColumn::make('tahun')->sortable(),
                TextColumn::make('articles')->label('Jumlah Artikel')->sortable(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}