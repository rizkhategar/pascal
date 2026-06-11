<?php

namespace App\Filament\Resources\OrganizationStructures\Pages;

use App\Filament\Resources\OrganizationStructures\OrganizationStructureResource;
use Filament\Resources\Pages\Page;

class CreateOrganizationStructure extends Page
{
    protected static string $resource = OrganizationStructureResource::class;
    protected string $view = 'filament.resources.organization-structures.pages.create-organization-structure';

    public function getTitle(): string
    {
        return 'Create Organization Structure';
    }
}
