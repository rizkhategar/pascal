<?php

namespace App\Filament\Resources\DetailDosens;

use App\Filament\Resources\DetailDosens\Pages\CreateDetailDosen;
use App\Filament\Resources\DetailDosens\Pages\EditDetailDosen;
use App\Filament\Resources\DetailDosens\Pages\ListDetailDosens;
use App\Filament\Resources\DetailDosens\Pages\ImportDetailDosen;
use App\Filament\Resources\DetailDosens\Schemas\DetailDosenForm; // Import Skema Form
use App\Filament\Resources\DetailDosens\Tables\DetailDosensTable; // Import Skema Table
use App\Filament\Resources\DetailDosens\RelationManagers\ResearchYearliesRelationManager;
use App\Filament\Resources\DetailDosens\RelationManagers\ServiceYearliesRelationManager;
use App\Filament\Resources\DetailDosens\RelationManagers\GarudaYearlyStatsRelationManager;
use App\Filament\Resources\DetailDosens\RelationManagers\ScholarYearlyStatsRelationManager;
use App\Filament\Resources\DetailDosens\RelationManagers\ScopusYearlyStatsRelationManager;
use App\Models\DetailDosen;
use BackedEnum;
use UnitEnum;

// Import Filament Core
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class DetailDosenResource extends Resource
{
    protected static ?string $model = DetailDosen::class;

    protected static ?string $slug = 'detail-dosens';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Manage Dosen';
    protected static ?string $modelLabel = 'Detail Dosen';
    protected static ?string $pluralModelLabel = 'Manage Dosen';

    protected static string|UnitEnum|null $navigationGroup = 'SINTA Integration';

    public static function form(Schema $schema): Schema
    {
        // Memanggil konfigurasi form lengkap dari DetailDosenForm
        return DetailDosenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // Memanggil konfigurasi tabel lengkap dari DetailDosensTable
        return DetailDosensTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ResearchesRelationManager::class,
            RelationManagers\ServicesRelationManager::class,
            RelationManagers\BooksRelationManager::class,
            RelationManagers\ScopusPublicationsRelationManager::class,
            RelationManagers\ScholarPublicationsRelationManager::class,
            RelationManagers\GarudaPublicationsRelationManager::class,

            // Data Statistik Tahunan (Yearly Stats)
            ResearchYearliesRelationManager::class,
            ServiceYearliesRelationManager::class,
            GarudaYearlyStatsRelationManager::class,
            ScholarYearlyStatsRelationManager::class,
            ScopusYearlyStatsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDetailDosens::route('/'),
            'import' => Pages\ImportDetailDosen::route('/import'),
            'view' => Pages\ViewDetailDosen::route('/{record}'), // <-- TAMBAHKAN INI
            'edit' => Pages\EditDetailDosen::route('/{record}/edit'),
        ];
    }
}
