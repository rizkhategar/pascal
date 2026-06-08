<?php

namespace App\Filament\Resources\HomeHeroSlideResource\Pages;

use App\Filament\Resources\HomeHeroSlideResource;
use Filament\Resources\Pages\Page;

class CreateHomeHeroSlide extends Page
{
    protected static string $resource = HomeHeroSlideResource::class;

    protected string $view = 'filament.resources.home-hero-slide-resource.pages.create-home-hero-slide';

    public function getTitle(): string
    {
        return 'Tambah Hero Campus';
    }
}
