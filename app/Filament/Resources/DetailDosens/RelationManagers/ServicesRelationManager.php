<?php

namespace App\Filament\Resources\DetailDosens\RelationManagers;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class ServicesRelationManager extends RelationManager
{
    protected static string $relationship = 'services';
    protected static ?string $title = 'Data Pengabdian';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Textarea::make('judul')->required()->columnSpanFull(),
            TextInput::make('leader'),
            TextInput::make('skema'),
            TextInput::make('tahun'),
            TextInput::make('dana'),
            TextInput::make('status'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('judul')
            ->columns([
                TextColumn::make('judul')->wrap()->searchable(),
                TextColumn::make('leader'),
                TextColumn::make('skema'),
                TextColumn::make('tahun'),
                TextColumn::make('dana'),
                TextColumn::make('status'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}