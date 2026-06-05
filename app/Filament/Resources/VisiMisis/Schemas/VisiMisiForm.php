<?php

namespace App\Filament\Resources\VisiMisis\Schemas;

use Filament\Schemas\Schema; // Menggunakan Schema kembali
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;

class VisiMisiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Manajemen Konten Visi dan Misi')
                    ->schema([
                        RichEditor::make('visi')
                            ->label('Visi')
                            ->required()
                            ->toolbarButtons([
                                'bold', 'italic', 'bulletList', 'orderedList', 'redo', 'undo',
                            ])
                            ->columnSpanFull(),

                        RichEditor::make('misi')
                            ->label('Misi')
                            ->required()
                            ->toolbarButtons([
                                'bold', 'italic', 'bulletList', 'orderedList', 'redo', 'undo',
                            ])
                            ->columnSpanFull(),
                    ])
            ]);
    }
}