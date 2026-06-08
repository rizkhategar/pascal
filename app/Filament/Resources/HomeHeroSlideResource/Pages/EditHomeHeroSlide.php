<?php

namespace App\Filament\Resources\HomeHeroSlideResource\Pages;

use App\Filament\Resources\HomeHeroSlideResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHomeHeroSlide extends EditRecord
{
    protected static string $resource = HomeHeroSlideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
