<?php

namespace App\Filament\Resources\TentangPascasarjanas\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section; 
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;

class TentangPascasarjanaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ==========================================
                // BAGIAN ATAS: TEKS UTAMA
                // ==========================================
                Section::make('Teks Utama Halaman')
                    ->description('Atur sub-judul, judul, dan deskripsi utama profil.')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('subheading')
                                ->required()
                                ->default('Tentang Kami')
                                ->label('Sub Judul')
                                ->placeholder('Cth: Tentang Kami'),
                                
                            TextInput::make('heading')
                                ->required()
                                ->label('Judul Utama')
                                ->placeholder('Cth: Mewujudkan Generasi Unggul'),
                        ]),
                        
                        Textarea::make('description')
                            ->required()
                            ->label('Deskripsi Panjang')
                            ->placeholder('Masukkan penjelasan lengkap tentang pascasarjana di sini...')
                            ->rows(5),
                    ]),

                // ==========================================
                // BAGIAN BAWAH: POIN FITUR (Super Lega)
                // ==========================================
                Section::make('Poin-Poin Fitur & Keunggulan')
                    ->description('Daftar fitur yang akan berjajar di sisi kanan halaman.')
                    ->icon('heroicon-o-star')
                    ->schema([
                        Repeater::make('points')
                            ->hiddenLabel()
                            ->schema([
                                // Membagi rasio menjadi 1:3 agar kotak teks sangat panjang
                                Grid::make(4)->schema([
                                    
                                    // Porsi 1/4 untuk Gambar (Kiri)
                                    FileUpload::make('icon')
                                        ->image()
                                        ->imageEditor()
                                        ->directory('tentang-icons')
                                        ->disk('public')
                                        ->label('Upload Ikon')
                                        ->columnSpan(['default' => 4, 'md' => 1]),
                                        
                                    // Porsi 3/4 untuk Teks (Kanan)
                                    Grid::make(1)->schema([
                                        TextInput::make('title')
                                            ->required()
                                            ->label('Judul Poin')
                                            ->placeholder('Cth: Fasilitas Lengkap'),
                                        
                                        Textarea::make('description')
                                            ->required()
                                            ->label('Deskripsi Singkat')
                                            ->rows(3),
                                    ])->columnSpan(['default' => 4, 'md' => 3]),
                                    
                                ])
                            ])
                            ->defaultItems(3)
                            ->addActionLabel('➕ Tambah Poin Baru')
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->cloneable()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Poin Baru')
                            // Tidak memakai ->grid() agar layout menyamping 1 baris utuh
                    ])
            ]);
    }
}