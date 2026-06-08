<?php

namespace App\Filament\Resources\TentangPascasarjanas\Pages;

use App\Filament\Resources\TentangPascasarjanas\TentangPascasarjanaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTentangPascasarjana extends EditRecord
{
    protected static string $resource = TentangPascasarjanaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
