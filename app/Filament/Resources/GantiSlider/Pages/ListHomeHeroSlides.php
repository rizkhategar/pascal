<?php

namespace App\Filament\Resources\HomeHeroSlideResource\Pages;

use App\Filament\Resources\HomeHeroSlideResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHomeHeroSlides extends ListRecords
{
    protected static string $resource = HomeHeroSlideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Hero Campus')
                ->url(HomeHeroSlideResource::getUrl('create')),
        ];
    }
}
