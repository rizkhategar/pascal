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

class BooksRelationManager extends RelationManager
{
    protected static string $relationship = 'books';
    protected static ?string $title = 'Data Buku';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Textarea::make('judul')->required()->columnSpanFull(),
            TextInput::make('kategori'),
            TextInput::make('penerbit'),
            TextInput::make('tahun'),
            TextInput::make('isbn')->label('ISBN'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('judul')
            ->columns([
                TextColumn::make('judul')->wrap()->searchable(),
                TextColumn::make('kategori'),
                TextColumn::make('penerbit'),
                TextColumn::make('tahun'),
                TextColumn::make('isbn')->label('ISBN'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}