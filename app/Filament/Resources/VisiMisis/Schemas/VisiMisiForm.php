<?php

namespace App\Filament\Resources\VisiMisis\Schemas;

use Filament\Schemas\Schema; 
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid; // Tambahan untuk membagi kolom

class VisiMisiForm
{
    public static function configure(Schema $schema): Schema
    {
        // Daftar tombol standar untuk menjaga tipografi tetap rapi
        $toolbar = ['bold', 'italic', 'underline', 'h2', 'h3', 'bulletList', 'orderedList', 'link', 'redo', 'undo'];

        return $schema
            ->components([
                
                // 1. KELOMPOK HERO (BANNER)
                Section::make('Banner Halaman (Hero Section)')
                    ->description('Pengaturan gambar latar belakang dan teks sambutan paling atas.')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Grid::make(2) // Membagi menjadi 2 kolom bersebelahan
                            ->schema([
                                TextInput::make('hero_title')
                                    ->label('Judul Utama')
                                    ->placeholder('Cth: Visi & Misi')
                                    ->default('Visi & Misi')
                                    ->helperText('Tampil dengan ukuran font paling besar.')
                                    ->required(),
                                
                                TextInput::make('hero_subtitle')
                                    ->label('Sub Judul')
                                    ->placeholder('Cth: Pascasarjana Universitas Ngudi Waluyo')
                                    ->default('Pascasarjana Universitas Ngudi Waluyo')
                                    ->helperText('Teks berukuran sedang di bawah judul utama.'),
                            ]),

                        FileUpload::make('hero_image')
                            ->label('Gambar Latar Belakang')
                            ->image()
                            ->imageEditor() // Memungkinkan user meng-crop gambar langsung di admin
                            ->disk('public')
                            ->directory('hero-images')
                            ->helperText('Disarankan menggunakan gambar resolusi tinggi (landscape).')
                            ->columnSpanFull(),
                    ])->collapsible(), // Bisa di-minimize

                // 2. KELOMPOK VISI & MISI
                Section::make('Visi & Misi')
                    ->description('Rumusan Visi dan Misi utama Pascasarjana.')
                    ->icon('heroicon-o-flag')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('judul_visi')->label('Label Judul Visi')->required()->default('Visi'),
                            TextInput::make('judul_misi')->label('Label Judul Misi')->required()->default('Misi'),
                        ]),
                        RichEditor::make('visi')->label('Konten Visi')->required()->toolbarButtons($toolbar)->columnSpanFull(),
                        RichEditor::make('misi')->label('Konten Misi')->required()->toolbarButtons($toolbar)->columnSpanFull(),
                    ])->collapsible(),

                // 3. KELOMPOK TUJUAN
                Section::make('Tujuan Institusi')
                    ->description('Tujuan umum dan tujuan khusus dalam berbagai bidang.')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('judul_tujuan')->label('Label Tujuan Umum')->required()->default('Tujuan'),
                            TextInput::make('judul_tujuan_bidang')->label('Label Tujuan Dalam Bidang')->required()->default('Tujuan UNW Dalam Bidang'),
                        ]),
                        RichEditor::make('tujuan')->label('Konten Tujuan')->required()->toolbarButtons($toolbar)->columnSpanFull(),
                        RichEditor::make('tujuan_bidang')->label('Konten Tujuan Bidang')->required()->toolbarButtons($toolbar)->columnSpanFull(),
                    ])->collapsible(),

                // 4. KELOMPOK SASARAN & TARGET
                Section::make('Sasaran & Target')
                    ->description('Indikator pencapaian dan target yang ingin diraih.')
                    ->icon('heroicon-o-chart-bar')
                    ->schema([
                        TextInput::make('judul_sasaran_target')
                            ->label('Label Sasaran & Target')
                            ->required()
                            ->default('Sasaran dan Target')
                            ->columnSpanFull(),
                        RichEditor::make('sasaran_target')
                            ->label('Konten Sasaran dan Target')
                            ->required()
                            ->toolbarButtons($toolbar)
                            ->columnSpanFull(),
                    ])->collapsible(),
            ]);
    }
}