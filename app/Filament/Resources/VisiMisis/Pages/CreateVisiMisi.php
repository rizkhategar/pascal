<?php

namespace App\Filament\Resources\VisiMisis\Pages;

use App\Filament\Resources\VisiMisis\VisiMisiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVisiMisi extends CreateRecord
{
    protected static string $resource = VisiMisiResource::class;

    protected static bool $canCreateAnother = false;
}