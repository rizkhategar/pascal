<?php

namespace App\Filament\Resources\VisiMisis\Schemas;

use Filament\Schemas\Schema; 
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput; // Tambahkan import TextInput
use Filament\Schemas\Components\Section;

class VisiMisiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Manajemen Konten Visi dan Misi')
                    ->schema([
                        // Input untuk Judul Visi
                        TextInput::make('judul_visi')
                            ->label('Judul Bagian Visi')
                            ->required()
                            ->default('Visi')
                            ->columnSpanFull(),

                        // Editor untuk Konten Visi
                        RichEditor::make('visi')
                            ->label('Konten Visi')
                            ->required()
                            ->toolbarButtons([
                                'bold', 'italic', 'bulletList', 'orderedList', 'redo', 'undo',
                            ])
                            ->columnSpanFull(),

                        // Input untuk Judul Misi
                        TextInput::make('judul_misi')
                            ->label('Judul Bagian Misi')
                            ->required()
                            ->default('Misi')
                            ->columnSpanFull(),

                        // Editor untuk Konten Misi
                        RichEditor::make('misi')
                            ->label('Konten Misi')
                            ->required()
                            ->toolbarButtons([
                                'bold', 'italic', 'bulletList', 'orderedList', 'redo', 'undo',
                            ])
                            ->columnSpanFull(),
                    ])
            ]);
    }
}