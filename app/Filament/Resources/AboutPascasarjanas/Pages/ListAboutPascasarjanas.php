<?php

namespace App\Filament\Resources\AboutPascasarjanas\Pages;

use App\Filament\Resources\AboutPascasarjanas\AboutPascasarjanaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Models\AboutPascasarjana;

class ListAboutPascasarjanas extends ListRecords
{
    protected static string $resource = AboutPascasarjanaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->hidden(fn () => AboutPascasarjana::count() > 0),
        ];
    }
}