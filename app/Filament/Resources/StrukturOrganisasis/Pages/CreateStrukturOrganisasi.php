<?php

namespace App\Filament\Resources\StrukturOrganisasis\Pages;

use App\Filament\Resources\StrukturOrganisasis\StrukturOrganisasiResource;
use Filament\Resources\Pages\Page;

class CreateStrukturOrganisasi extends Page
{
    protected static string $resource = StrukturOrganisasiResource::class;

    protected string $view = 'filament.resources.struktur-organisasis.pages.create-struktur-organisasi';

    public function getTitle(): string
    {
        return 'Tambah Struktur Organisasi';
    }
}
