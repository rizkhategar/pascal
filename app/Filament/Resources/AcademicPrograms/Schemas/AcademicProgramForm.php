<?php

namespace App\Filament\Resources\AcademicPrograms\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AcademicProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('slug')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('degree')
                    ->required(),
                TextInput::make('hero_title')
                    ->required(),
                Textarea::make('hero_desc')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('hero_image')
                    ->image(),
                TextInput::make('overview_title')
                    ->required(),
                Textarea::make('overview_content')
                    ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('overview_image')
                    ->image(),
            ]);
    }
}
