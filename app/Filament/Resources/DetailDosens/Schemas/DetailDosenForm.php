<?php

namespace App\Filament\Resources\DetailDosens\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Placeholder; // Import Placeholder
use Filament\Forms\Components\FileUpload;  // Import FileUpload
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class DetailDosenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('sinta_id')
                    ->label('SINTA ID')
                    ->required()
                    ->disabled(fn ($context) => $context === 'edit'),

                TextInput::make('nama')
                    ->default(null),
                TextInput::make('institusi')
                    ->default(null),
                TextInput::make('program_studi')
                    ->default(null),
                
                Select::make('jurusan')
                    ->label('Jurusan')
                    ->options([
                        'magister keperawatan' => 'Magister Keperawatan',
                        'magister kesehatan masyarakat' => 'Magister Kesehatan Masyarakat',
                        'magister manajemen pendidikan' => 'Magister Manajemen Pendidikan',
                        'magister hukum' => 'Magister Hukum',
                    ])
                    ->searchable()
                    ->default(null),

                // PERBAIKAN 1: Tampilkan Pratinjau Gambar Lokal dari folder public
                Placeholder::make('local_image_preview')
                    ->label('Foto Profil Saat Ini')
                    ->content(function ($record, $get) {
                        $sintaId = $record?->sinta_id ?? $get('sinta_id');
                        if (! $sintaId) {
                            return new HtmlString('<span class="text-gray-500 text-sm">SINTA ID belum diisi</span>');
                        }

                        $imagePath = public_path("assets/images/{$sintaId}.jpg");
                        
                        // Cek apakah file foto sinta_id.jpg benar-scale ada di folder public
                        if (file_exists($imagePath)) {
                            return new HtmlString("
                                <div class='flex items-center gap-4 py-2'>
                                    <img src='/assets/images/{$sintaId}.jpg?v=" . time() . "' 
                                         class='w-32 h-32 rounded-xl object-cover shadow-sm border border-gray-300 dark:border-gray-700' 
                                         alt='Foto Dosen' />
                                </div>
                            ");
                        }

                        return new HtmlString('<span class="text-danger-600 dark:text-danger-400 text-sm">Foto lokal tidak ditemukan di public/assets/images/' . $sintaId . '.jpg</span>');
                    })
                    ->columnSpanFull(),

                // PERBAIKAN 2: Tempat Upload Gambar Baru khusus di mode Edit/Create (Sembunyi di mode View)
                FileUpload::make('image_upload')
                    ->label('Upload / Ganti Foto Profil (.jpg)')
                    ->image()
                    ->directory('assets/images')
                    ->dehydrated(false) // Jangan simpan path string temporary Livewire ke DB
                    ->columnSpanFull()
                    ->visible(fn ($context) => $context !== 'view')
                    ->saveUploadedFileUsing(function (TemporaryUploadedFile $file, $record, $get) {
                        $sintaId = $record?->sinta_id ?? $get('sinta_id');
                        if (! $sintaId) {
                            return null;
                        }

                        $targetDirectory = public_path('assets/images');
                        if (!file_exists($targetDirectory)) {
                            mkdir($targetDirectory, 0755, true);
                        }

                        $filename = "{$sintaId}.jpg";
                        
                        // Timpa file lama jika sudah ada
                        if (file_exists($targetDirectory . '/' . $filename)) {
                            @unlink($targetDirectory . '/' . $filename);
                        }

                        // Pindahkan langsung ke public/assets/images/{sinta_id}.jpg
                        $file->move($targetDirectory, $filename);

                        return $filename;
                    }),

                // Teks input URL bawaan SINTA/Scholar tetap dipertahankan untuk referensi data scraping
                TextInput::make('profile_photo')
                    ->label('Original Scraped Photo URL')
                    ->default(null)
                    ->columnSpanFull(),

                TextInput::make('bidang_minat')
                    ->default(null),
                TextInput::make('sinta_score_overall')
                    ->numeric()
                    ->default(null),
                TextInput::make('sinta_score_3yr')
                    ->numeric()
                    ->default(null),
                TextInput::make('affil_score')
                    ->numeric()
                    ->default(null),
                TextInput::make('affil_score_3yr')
                    ->numeric()
                    ->default(null),
            ]);
    }
}