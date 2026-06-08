<?php

namespace App\Filament\Resources\TentangPascasarjanas\Pages;

use App\Filament\Resources\TentangPascasarjanas\TentangPascasarjanaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTentangPascasarjanas extends ListRecords
{
    protected static string $resource = TentangPascasarjanaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
