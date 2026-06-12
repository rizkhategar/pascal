<?php

namespace App\Filament\Resources\DetailDosens\Pages;

use App\Filament\Resources\DetailDosens\DetailDosenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetailDosens extends ListRecords
{
    protected static string $resource = DetailDosenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            // PERBAIKAN: Mengarahkan URL langsung ke halaman Create kustom milik Resource ini
            Actions\Action::make('openImportPage')
                ->label('Import / Scraping SINTA')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('warning')
                ->url(DetailDosenResource::getUrl('import')), // Menggunakan rute otomatis Filament
        ];
    }
}