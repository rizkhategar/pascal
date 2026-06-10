<?php

namespace App\Filament\Resources\DetailDosens\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select; // Import class Select
use Filament\Schemas\Schema;

class DetailDosenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->default(null),
                TextInput::make('institusi')
                    ->default(null),
                TextInput::make('program_studi')
                    ->default(null),
                
                // Tambahkan input Select untuk Jurusan di sini
                Select::make('jurusan')
                    ->label('Jurusan')
                    ->options([
                        'magister keperawatan' => 'Magister Keperawatan',
                        'magister kesehatan masyarakat' => 'Magister Kesehatan Masyarakat',
                        'magister manajemen pendidikan' => 'Magister Manajemen Pendidikan',
                        'magister hukum' => 'Magister Hukum',
                    ])
                    ->searchable() // Opsional: Memudahkan pencarian jika opsi nanti bertambah
                    ->default(null),

                Textarea::make('profile_photo')
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