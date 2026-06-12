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

class ServiceYearliesRelationManager extends RelationManager
{
    protected static string $relationship = 'serviceYearlies';
    protected static ?string $title = 'Grafik Pengabdian Tahunan';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('tahun')->required(),
            TextInput::make('jumlah')->numeric()->default(0)->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('tahun')
            ->columns([
                TextColumn::make('tahun')->sortable(),
                TextColumn::make('jumlah')->label('Jumlah Pengabdian')->sortable(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}