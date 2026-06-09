<?php

namespace App\Filament\Resources\ProfilDosens\Pages;

use App\Filament\Resources\ProfilDosens\ProfilDosenResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProfilDosen extends EditRecord
{
    protected static string $resource = ProfilDosenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
