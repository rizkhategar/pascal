<?php

namespace App\Filament\Resources\TentangPascasarjanas\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section; 
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;

class TentangPascasarjanaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)->schema([
                    Section::make('Teks Utama (Bagian Kiri)')
                        ->description('Atur judul dan deskripsi utama Tentang Kami.')
                        ->schema([
                            TextInput::make('subheading')
                                ->required()
                                ->default('Tentang Kami')
                                ->label('Sub Judul')
                                ->maxLength(255),
                            TextInput::make('heading')
                                ->required()
                                ->label('Judul Utama')
                                ->maxLength(255),
                            Textarea::make('description')
                                ->required()
                                ->label('Deskripsi')
                                ->rows(6),
                        ])->columnSpan(1),

                    Section::make('Poin-Poin Utama (Bagian Kanan)')
                        ->description('Tambahkan poin-poin keunggulan atau fitur.')
                        ->schema([
                            Repeater::make('points')
                                ->schema([
                                    FileUpload::make('icon')
                                        ->image()
                                        ->directory('tentang-icons')
                                        ->disk('public')
                                        ->label('Ikon (SVG/PNG transparan)'),
                                    TextInput::make('title')
                                        ->required()
                                        ->label('Judul Poin (Contoh: Keunggulan)'),
                                    Textarea::make('description')
                                        ->required()
                                        ->label('Deskripsi Singkat')
                                        ->rows(3),
                                ])
                                ->defaultItems(3)
                                ->columns(1)
                                ->reorderableWithButtons()
                        ])->columnSpan(1)
                ])
            ]);
    }
}