<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Placeholder::make('upload_info')
                ->label('Slider Settings')
                ->content('Use the create or edit page to manage slider images.'),

            TextInput::make('title')->label('Title')->disabled(),
            TextInput::make('subtitle')->label('Subtitle')->disabled(),
            TextInput::make('image_path')->label('Image Path')->disabled(),
            TextInput::make('sort_order')->label('Sort Order')->disabled(),
            TextInput::make('duration_ms')->label('Duration')->disabled(),
            Toggle::make('is_active')->label('Active')->disabled(),
        ]);
    }
}
