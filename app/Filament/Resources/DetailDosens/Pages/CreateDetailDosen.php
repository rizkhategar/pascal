<?php

namespace App\Filament\Resources\DetailDosens\Pages;

use App\Filament\Resources\DetailDosens\DetailDosenResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDetailDosen extends CreateRecord
{
    protected static string $resource = DetailDosenResource::class;
    
    // Jangan menimpa $view atau getViewData Scraper di sini!
}