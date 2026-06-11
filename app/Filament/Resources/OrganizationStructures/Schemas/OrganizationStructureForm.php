<?php

namespace App\Filament\Resources\OrganizationStructures\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class OrganizationStructureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Title')
                ->default('Organization Structure')
                ->required()
                ->maxLength(255),

            Placeholder::make('upload_info')
                ->label('Upload Organization Structure Image')
                ->content('Use the create or edit page to manage the image.'),

            TextInput::make('image_path')
                ->label('Image Path')
                ->helperText('This field is filled automatically after a successful upload.')
                ->disabled()
                ->dehydrated(false),

            Toggle::make('is_active')
                ->label('Active')
                ->default(true),
        ]);
    }
}
