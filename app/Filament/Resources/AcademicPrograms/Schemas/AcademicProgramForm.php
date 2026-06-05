<?php

namespace App\Filament\Resources\AcademicPrograms\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater; // Pastikan ini di-import
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AcademicProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // --- DATA UTAMA ACADEMIC PROGRAM ---
                TextInput::make('name')
                    ->label('Nama Program')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($operation, $state, $set) => 
                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                    ),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('degree')
                    ->label('Gelar Lulusan')
                    ->required(),
                TextInput::make('hero_title')
                    ->label('Judul Hero Banner')
                    ->required(),
                Textarea::make('hero_desc')
                    ->label('Deskripsi Hero Banner')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('hero_image')
                    ->label('File Gambar Hero')
                    ->image(),
                TextInput::make('overview_title')
                    ->label('Judul Overview')
                    ->required(),
                
                // Menggunakan components() untuk isi dalam Repeater kolom JSON
                Repeater::make('overview_content')
                    ->label('Paragraf Deskripsi Overview')
                    ->components([
                        Textarea::make('paragraph')
                            ->label('Isi Paragraf')
                            ->required()
                    ])
                    ->columnSpanFull(),
                    
                FileUpload::make('overview_image')
                    ->label('File Gambar Overview')
                    ->image(),

                // --- 3 TABEL RELASI YANG BELUM INCLUDE ---
                
                // Relasi 1: Prasyarat Pendaftaran
                Repeater::make('requirements')
                    ->label('Prasyarat Pendaftaran (Tabel Relasi)')
                    ->relationship('requirements') // Menunjuk nama relasi di Model
                    ->components([
                        TextInput::make('requirement_text')
                            ->label('Teks Syarat')
                            ->required(),
                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columnSpanFull(),

                // Relasi 2: Alur Pendaftaran
                Repeater::make('steps')
                    ->label('Alur Pendaftaran / Timeline (Tabel Relasi)')
                    ->relationship('steps')
                    ->components([
                        TextInput::make('step_number')
                            ->label('Langkah Ke-')
                            ->numeric()
                            ->required(),
                        TextInput::make('title')
                            ->label('Nama Langkah')
                            ->required(),
                        Textarea::make('description')
                            ->label('Penjelasan Langkah')
                            ->required(),
                    ])
                    ->columnSpanFull(),

                // Relasi 3: Konsentrasi Peminatan (Jika-Maka)
                Repeater::make('concentrations')
                    ->label('Konsentrasi Peminatan Jika-Maka (Tabel Relasi)')
                    ->relationship('concentrations')
                    ->components([
                        TextInput::make('name')
                            ->label('Nama Konsentrasi')
                            ->required(),
                        Textarea::make('if_condition')
                            ->label('Kondisi JIKA')
                            ->required(),
                        Textarea::make('then_outcome')
                            ->label('Kondisi MAKA')
                            ->required(),
                        TextInput::make('curriculum_link')
                            ->label('Link PDF Kurikulum (Opsional)'),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}