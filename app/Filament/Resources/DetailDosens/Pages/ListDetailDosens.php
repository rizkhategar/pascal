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
            // PERBAIKAN: Mengarahkan URL langsung ke halaman Create kustom milik Resource ini
            Actions\Action::make('tarik_data_sinta')
                ->label('Tarik Data SINTA')
                ->icon('heroicon-o-cloud-arrow-down')
                ->color('success')
                ->url(static::getResource()::getUrl('create')), // Menggunakan rute otomatis Filament
        ];
    }
}