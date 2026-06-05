<?php

namespace App\Filament\Resources\VisiMisis\Pages;

use App\Filament\Resources\VisiMisis\VisiMisiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Models\VisiMisi; // Tambahan untuk memanggil model

class ListVisiMisis extends ListRecords
{
    protected static string $resource = VisiMisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                // Tombol akan disembunyikan (hidden) jika jumlah data VisiMisi lebih dari 0
                ->hidden(fn () => VisiMisi::count() > 0),
        ];
    }
}