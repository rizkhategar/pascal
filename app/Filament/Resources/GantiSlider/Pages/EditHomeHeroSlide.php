<?php

namespace App\Filament\Resources\HomeHeroSlideResource\Pages;

use App\Filament\Resources\HomeHeroSlideResource;
use App\Models\HomeHeroSlide;
use Filament\Resources\Pages\Page;

class EditHomeHeroSlide extends Page
{
    protected static string $resource = HomeHeroSlideResource::class;

    protected string $view = 'filament.resources.home-hero-slide-resource.pages.edit-home-hero-slide';

    public HomeHeroSlide $record;

    public function mount(HomeHeroSlide $record): void
    {
        $this->record = $record;
    }

    public function getTitle(): string
    {
        return 'Edit Hero Campus';
    }
}
