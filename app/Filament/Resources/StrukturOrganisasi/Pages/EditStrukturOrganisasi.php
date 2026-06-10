<?php

namespace App\Filament\Resources\StrukturOrganisasiResource\Pages;

use App\Filament\Resources\StrukturOrganisasiResource;
use App\Models\StrukturOrganisasi;
use Filament\Resources\Pages\Page;

class EditStrukturOrganisasi extends Page
{
    protected static string $resource = StrukturOrganisasiResource::class;

    protected string $view = 'filament.resources.struktur-organisasi-resource.pages.edit-struktur-organisasi';

    public StrukturOrganisasi $record;

    public function mount(StrukturOrganisasi $record): void
    {
        $this->record = $record;
    }

    public function getTitle(): string
    {
        return 'Edit Struktur Organisasi';
    }
}
