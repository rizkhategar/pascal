<?php

namespace App\Filament\Resources\DetailDosens\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class DetailDosenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Tambahkan sinta_id sebagai input utama
                TextInput::make('sinta_id')
                    ->label('SINTA ID')
                    ->required()
                    ->disabled(fn ($context) => $context === 'edit'), // Opsional: disable saat edit data

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