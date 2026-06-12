<?php

namespace App\Filament\Resources\DetailDosens\Pages;

use App\Filament\Resources\DetailDosens\DetailDosenResource;
use Filament\Resources\Pages\ViewRecord;

// Import semua Relation Managers
use App\Filament\Resources\DetailDosens\RelationManagers\ResearchesRelationManager;
use App\Filament\Resources\DetailDosens\RelationManagers\ServicesRelationManager;
use App\Filament\Resources\DetailDosens\RelationManagers\BooksRelationManager;
use App\Filament\Resources\DetailDosens\RelationManagers\ScopusPublicationsRelationManager;
use App\Filament\Resources\DetailDosens\RelationManagers\ScholarPublicationsRelationManager;
use App\Filament\Resources\DetailDosens\RelationManagers\GarudaPublicationsRelationManager;

class ViewDetailDosen extends ViewRecord
{
    protected static string $resource = DetailDosenResource::class;

    // AKTIFKAN: Menyatukan view utama dengan data relasi menjadi sistem TAB
    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getRelationManagers(): array
    {
        return [
            \App\Filament\Resources\DetailDosens\RelationManagers\ResearchesRelationManager::class,
            \App\Filament\Resources\DetailDosens\RelationManagers\ServicesRelationManager::class,
            \App\Filament\Resources\DetailDosens\RelationManagers\BooksRelationManager::class,
            \App\Filament\Resources\DetailDosens\RelationManagers\ScopusPublicationsRelationManager::class,
            \App\Filament\Resources\DetailDosens\RelationManagers\ScholarPublicationsRelationManager::class,
            \App\Filament\Resources\DetailDosens\RelationManagers\GarudaPublicationsRelationManager::class,

            // Tambahkan di tingkat Halaman Penuh
            \App\Filament\Resources\DetailDosens\RelationManagers\ResearchYearliesRelationManager::class,
            \App\Filament\Resources\DetailDosens\RelationManagers\ServiceYearliesRelationManager::class,
            \App\Filament\Resources\DetailDosens\RelationManagers\GarudaYearlyStatsRelationManager::class,
            \App\Filament\Resources\DetailDosens\RelationManagers\ScholarYearlyStatsRelationManager::class,
            \App\Filament\Resources\DetailDosens\RelationManagers\ScopusYearlyStatsRelationManager::class,
        ];
    }
}
