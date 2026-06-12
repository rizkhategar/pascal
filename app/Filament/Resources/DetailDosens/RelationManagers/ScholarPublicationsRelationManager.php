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

class ScholarPublicationsRelationManager extends RelationManager
{
    protected static string $relationship = 'scholarPublications';
    protected static ?string $title = 'Publikasi Google Scholar';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Textarea::make('judul')->required()->columnSpanFull(),
            TextInput::make('source'),
            TextInput::make('tahun'),
            TextInput::make('citation')->numeric(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('judul')
            ->columns([
                TextColumn::make('judul')->wrap()->searchable(),
                TextColumn::make('source'),
                TextColumn::make('tahun'),
                TextColumn::make('citation')->label('Sitasi'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}