<?php

namespace App\Filament\Resources\Sliders\Pages;

use App\Filament\Resources\Sliders\SliderResource;
use App\Models\Slider;
use Filament\Resources\Pages\Page;

class EditSlider extends Page
{
    protected static string $resource = SliderResource::class;
    protected string $view = 'filament.resources.sliders.pages.edit-slider';

    public Slider $record;

    public function mount(Slider $record): void
    {
        $this->record = $record;
    }

    public function getTitle(): string
    {
        return 'Edit Slider';
    }
}
