<?php

namespace App\Filament\Resources\TentangPascasarjanas;

use App\Filament\Resources\TentangPascasarjanas\Pages;
use App\Filament\Resources\TentangPascasarjanas\Schemas\TentangPascasarjanaForm;
use App\Filament\Resources\TentangPascasarjanas\Tables\TentangPascasarjanasTable;
use App\Models\TentangPascasarjana;
use BackedEnum; 
use UnitEnum;   
use Filament\Resources\Resource;
use Filament\Schemas\Schema; 
use Filament\Tables\Table;

class TentangPascasarjanaResource extends Resource
{
    protected static ?string $model = TentangPascasarjana::class;
    
    // Perbaikan tipe data untuk PHP 8 strict typing
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-information-circle';
    
    protected static ?string $navigationLabel = 'Tentang Pascasarjana';
    protected static ?string $pluralModelLabel = 'Tentang Pascasarjana';
    
    // Perbaikan tipe data untuk PHP 8 strict typing
    protected static string|UnitEnum|null $navigationGroup = 'Profil';

    public static function form(Schema $schema): Schema
    {
        return TentangPascasarjanaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TentangPascasarjanasTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTentangPascasarjanas::route('/'),
            'create' => Pages\CreateTentangPascasarjana::route('/create'),
            'edit' => Pages\EditTentangPascasarjana::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return TentangPascasarjana::count() === 0;
    }
}