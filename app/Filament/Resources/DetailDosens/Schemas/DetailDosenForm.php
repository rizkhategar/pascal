<?php

namespace App\Filament\Resources\DetailDosens\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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
