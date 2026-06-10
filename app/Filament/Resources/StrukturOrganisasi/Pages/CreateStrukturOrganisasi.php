<?php

namespace App\Filament\Resources\StrukturOrganisasiResource\Pages;

use App\Filament\Resources\StrukturOrganisasiResource;
use Filament\Resources\Pages\Page;

class CreateStrukturOrganisasi extends Page
{
    protected static string $resource = StrukturOrganisasiResource::class;

    protected string $view = 'filament.resources.struktur-organisasi-resource.pages.create-struktur-organisasi';

    public function getTitle(): string
    {
        return 'Tambah Struktur Organisasi';
    }
}
