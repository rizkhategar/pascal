<?php

namespace App\Filament\Resources\Sliders\Pages;

use App\Filament\Resources\Sliders\SliderResource;
use Filament\Resources\Pages\Page;

class CreateSlider extends Page
{
    protected static string $resource = SliderResource::class;
    protected string $view = 'filament.resources.sliders.pages.create-slider';

    public function getTitle(): string
    {
        return 'Create Slider';
    }
}
