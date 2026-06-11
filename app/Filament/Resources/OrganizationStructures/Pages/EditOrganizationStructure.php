<?php

namespace App\Filament\Resources\OrganizationStructures\Pages;

use App\Filament\Resources\OrganizationStructures\OrganizationStructureResource;
use App\Models\OrganizationStructure;
use Filament\Resources\Pages\Page;

class EditOrganizationStructure extends Page
{
    protected static string $resource = OrganizationStructureResource::class;
    protected string $view = 'filament.resources.organization-structures.pages.edit-organization-structure';

    public OrganizationStructure $record;

    public function mount(OrganizationStructure $record): void
    {
        $this->record = $record;
    }

    public function getTitle(): string
    {
        return 'Edit Organization Structure';
    }
}
