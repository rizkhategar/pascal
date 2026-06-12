<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Title')
                ->required(),
                
            TextInput::make('subtitle')
                ->label('Subtitle')
                ->required(),
                
            FileUpload::make('image_path')
                ->label('Slider Image')
                ->image()
                ->directory('sliders')
                ->required()
                ->maxSize(8192)
                ->helperText('Gunakan gambar berformat JPG, PNG, atau WEBP.'),
                
            TextInput::make('sort_order')
                ->label('Sort Order (Urutan)')
                ->numeric()
                ->default(0),
                
            TextInput::make('duration_ms')
                ->label('Duration / Durasi (Milidetik)')
                ->numeric()
                ->default(3000)
                ->minValue(1000)
                ->maxValue(30000)
                ->helperText('Contoh: 3000 ms = 3 detik transisi.'),
                
            Toggle::make('is_active')
                ->label('Status Aktif')
                ->default(true),
        ]);
    }
}