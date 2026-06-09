<?php

namespace App\Filament\Resources\ProfilDosens;

use App\Filament\Resources\ProfilDosens\Pages\CreateProfilDosen;
use App\Filament\Resources\ProfilDosens\Pages\EditProfilDosen;
use App\Filament\Resources\ProfilDosens\Pages\ListProfilDosens;
use App\Filament\Resources\ProfilDosens\Schemas\ProfilDosenForm;
use App\Filament\Resources\ProfilDosens\Tables\ProfilDosensTable;
use App\Models\ProfilDosen;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProfilDosenResource extends Resource
{
    protected static ?string $model = ProfilDosen::class;

    // Anda bisa mengubah icon ini ke Heroicon::OutlinedUser jika ingin ikon profil/orang
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // 1. Mengubah nama menu di sidebar menjadi "Profil Dosen"
    protected static ?string $navigationLabel = 'Profil Dosen';

    // 2. Mengarahkan URL klik menu sidebar langsung ke route scrap.index
    public static function getNavigationUrl(): string
    {
        return route('scrap.index');
    }

    public static function form(Schema $schema): Schema
    {
        return ProfilDosenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProfilDosensTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProfilDosens::route('/'),
            'create' => CreateProfilDosen::route('/create'),
            'edit' => EditProfilDosen::route('/{record}/edit'),
        ];
    }
}