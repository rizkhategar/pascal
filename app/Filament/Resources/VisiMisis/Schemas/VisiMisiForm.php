<?php

namespace App\Filament\Resources\VisiMisis\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;

class VisiMisiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                // ==========================================
                // BAGIAN 1: VISI & MISI
                // ==========================================
                Section::make('Visi & Misi')
                    ->description('Pengaturan konten Visi dan Misi Pascasarjana.')
                    ->icon('heroicon-o-document-text')
                    ->columnSpanFull()
                    ->schema([
                        RichEditor::make('visi')
                            ->required()
                            ->label('Visi')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'bulletList', 'orderedList', 'redo', 'undo'
                            ]),
                        RichEditor::make('misi')
                            ->required()
                            ->label('Misi')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'bulletList', 'orderedList', 'redo', 'undo'
                            ]),
                    ]),

                // ==========================================
                // BAGIAN 2: TUJUAN
                // ==========================================
                Section::make('Tujuan')
                    ->description('Pengaturan judul dan konten Tujuan.')
                    ->icon('heroicon-o-academic-cap')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('judul_tujuan')
                            ->required()
                            ->default('Tujuan')
                            ->label('Judul Tujuan'),
                        RichEditor::make('tujuan')
                            ->required()
                            ->label('Konten Tujuan')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'bulletList', 'orderedList', 'redo', 'undo'
                            ]),
                    ]),

                // ==========================================
                // BAGIAN 3: TUJUAN BIDANG
                // ==========================================
                Section::make('Tujuan Dalam Bidang')
                    ->description('Pengaturan judul dan konten Tujuan dalam Bidang.')
                    ->icon('heroicon-o-briefcase')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('judul_tujuan_bidang')
                            ->required()
                            ->default('Tujuan UNW Dalam Bidang')
                            ->label('Judul Tujuan Bidang'),
                        RichEditor::make('tujuan_bidang')
                            ->required()
                            ->label('Konten Tujuan Bidang')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'bulletList', 'orderedList', 'redo', 'undo'
                            ]),
                    ]),

                // ==========================================
                // BAGIAN 4: SASARAN & TARGET
                // ==========================================
                Section::make('Sasaran & Target')
                    ->description('Pengaturan judul dan konten Sasaran serta Target.')
                    ->icon('heroicon-o-flag')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('judul_sasaran_target')
                            ->required()
                            ->default('Sasaran dan Target')
                            ->label('Judul Sasaran & Target'),
                        RichEditor::make('sasaran_target')
                            ->required()
                            ->label('Konten Sasaran & Target')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'bulletList', 'orderedList', 'redo', 'undo'
                            ]),
                    ]),
            ]);
    }
}