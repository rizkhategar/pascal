<?php

namespace App\Filament\Resources\TentangPascasarjanas\Pages;

use App\Filament\Resources\TentangPascasarjanas\TentangPascasarjanaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Models\TentangPascasarjana;

class ListTentangPascasarjanas extends ListRecords
{
    protected static string $resource = TentangPascasarjanaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->hidden(fn () => TentangPascasarjana::count() > 0),
        ];
    }
}