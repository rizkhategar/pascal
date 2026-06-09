<?php

namespace App\Filament\Resources\DetailDosens;

use App\Filament\Resources\DetailDosens\Pages\CreateDetailDosen;
use App\Filament\Resources\DetailDosens\Pages\EditDetailDosen;
use App\Filament\Resources\DetailDosens\Pages\ListDetailDosens;
use App\Models\DetailDosen;
use BackedEnum;
use UnitEnum;

// Import Form Elemen
use Filament\Forms\Components\TextInput;

// Import Filament Core
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

// Import Kolom Tabel (Tetap di dalam Tables)
use Filament\Tables\Columns\TextColumn;

// PERBAIKAN TOTAL NAMESPACE ACTIONS (Filament v3)
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;   // <-- Pindah ke sini
use Filament\Actions\DeleteBulkAction; // <-- Pindah ke sini

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
        return $schema
            ->schema([
                TextInput::make('sinta_id')->required()->maxLength(255),
                TextInput::make('nama')->maxLength(255),
                TextInput::make('institusi')->maxLength(255),
                TextInput::make('program_studi')->maxLength(255),
                TextInput::make('sinta_score_overall')->numeric(),
                TextInput::make('sinta_score_3yr')->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Memanggil langsung TextColumn (tanpa awalan Tables\Columns\)
                TextColumn::make('sinta_id')->label('SINTA ID')->searchable()->sortable(),
                TextColumn::make('nama')->searchable(),
                TextColumn::make('institusi')->searchable(),
                TextColumn::make('program_studi')->searchable(),
                TextColumn::make('sinta_score_overall')->label('Score Overall')->numeric()->sortable(),
                TextColumn::make('sinta_score_3yr')->label('Score 3Yr')->numeric()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Memanggil langsung Action (tanpa awalan Tables\Actions\)
                EditAction::make(),
                ViewAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
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
            // Kunci penamaan rute indeks di sini agar sesuai dengan pendaftaran otomatis Filament
            'index' => Pages\ListDetailDosens::route('/'),
            'create' => Pages\CreateDetailDosen::route('/create'),
            'edit' => Pages\EditDetailDosen::route('/{record}/edit'),
        ];
    }
}