<?php

namespace App\Filament\Resources\StrukturOrganisasis\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class StrukturOrganisasiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul')
                    ->default('Struktur Organisasi')
                    ->required()
                    ->maxLength(255),

                Placeholder::make('upload_info')
                    ->label('Upload Gambar Struktur Organisasi')
                    ->content('Gunakan tombol Tambah/Edit dari tabel. Upload file diproses saat tombol simpan ditekan.'),

                TextInput::make('image_path')
                    ->label('Path Gambar')
                    ->helperText('Field ini akan diisi otomatis setelah upload berhasil.')
                    ->disabled()
                    ->dehydrated(false),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}
