<?php

namespace App\Filament\Resources\AcademicPrograms\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AcademicProgramInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('slug'),
                TextEntry::make('name'),
                TextEntry::make('degree'),
                TextEntry::make('hero_title'),
                TextEntry::make('hero_desc')
                    ->columnSpanFull(),
                ImageEntry::make('hero_image')
                    ->placeholder('-'),
                TextEntry::make('overview_title'),
                TextEntry::make('overview_content')
                    ->placeholder('-')
                    ->columnSpanFull(),
                ImageEntry::make('overview_image')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
