<?php

namespace App\Filament\Resources\TentangPascasarjanas\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section; 
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor; // Tambahan untuk format teks sambutan
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;

class TentangPascasarjanaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ==========================================
                // BAGIAN 1: TEKS UTAMA Halaman
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
                // BAGIAN 2: POIN FITUR (Super Lega)
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
                    ]),

                // ==========================================
                // BAGIAN 3: SAMBUTAN DIREKTUR
                // ==========================================
                Section::make('Sambutan Direktur Pascasarjana')
                    ->description('Tampilkan foto dan pesan sambutan pimpinan di bawah Tentang Kami.')
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        Grid::make(4)->schema([
                            
                            // Kotak Kiri: Porsi 1/4 untuk Upload Foto Direktur
                            FileUpload::make('direktur_image')
                                ->image()
                                ->imageEditor()
                                ->directory('direktur-images')
                                ->disk('public')
                                ->label('Foto Direktur (Potret/Berdiri)')
                                ->columnSpan(['default' => 4, 'md' => 1]),

                            // Kotak Kanan: Porsi 3/4 untuk Informasi & Pesan Direktur
                            Grid::make(1)->schema([
                                TextInput::make('direktur_name')
                                    ->label('Nama Lengkap (Beserta Gelar)')
                                    ->placeholder('Cth: Dr. H. Fulan, M.Pd.'),
                                    
                                TextInput::make('direktur_title')
                                    ->label('Jabatan')
                                    ->default('Direktur Pascasarjana Universitas Ngudi Waluyo'),

                                RichEditor::make('direktur_message')
                                    ->label('Isi Pesan / Sambutan')
                                    ->toolbarButtons(['bold', 'italic', 'underline', 'bulletList', 'orderedList', 'redo', 'undo'])
                            ])->columnSpan(['default' => 4, 'md' => 3])
                            
                        ])
                    ])->collapsible() // Bisa dilipat agar admin tidak terlalu panjang
            ]);
    }
}